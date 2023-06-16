<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class LoanController extends Controller
{
	public static function calculateMonthlyPayment($loanAmount, $monthlyInterest, $totalInstallments){
		$adj = pow((1 + $monthlyInterest), $totalInstallments);
		return $loanAmount * $monthlyInterest * $adj / ($adj - 1);
	}

	public static function getLoans($applications, $status = "ALL"){
		$loanStr = array();
		foreach($applications as $application){
			$tempJSON = new stdClass();
			$loan = $application->loan;
			if($loan){
				$tempJSON->id = $loan->id;
				$applicationData = $application->userData->applicationData;
				$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
				$tempJSON->starting_date = FunctionController::formatDate($loan->starting_date);
				$tempJSON->required_amount = FunctionController::formatCurrencyView($loan->loan_amount);
				$initialDeposit = ApplicationController::getTotalDeposit($application);
				$tempJSON->initial_deposit = FunctionController::formatCurrencyView($initialDeposit);
				$tempJSON->loan_amount = FunctionController::formatCurrencyView($loan->loan_amount - $initialDeposit);
				$tempJSON->interest_rate = $loan->interest_rate;
				$tempJSON->loan_period = $loan->loan_period;
				$tempJSON->monthly_payment = FunctionController::formatCurrencyView($loan->monthly_payment);
				$tempJSON->loan_code = $loan->loan_code;
				$tempJSON->loan_status = $loan->loan_status;
				if($loan->loan_status == $status || $status == 'ALL'){
					$loanStr[] = $tempJSON;
				}
			}
		}
		return $loanStr;
	}

	public static function getLoanCalculation($loanAmount, $interestRate, $loanPeriod, $initialDeposit){
		$balanceAmount = $loanAmount - $initialDeposit;
		$monthlyInterest = $interestRate / 12 / 100;
		$totalInstallments = $loanPeriod * 12;
		$monthlyPayment = LoanController::calculateMonthlyPayment($balanceAmount, $monthlyInterest, $totalInstallments);
		$totalLoanCost = $monthlyPayment * $totalInstallments;
		$totalInterest = $totalLoanCost - $balanceAmount;

		return (object) array(
			'totalInstallments' => $totalInstallments,
			'monthlyPayment' => $monthlyPayment,
			'totalLoanCost' => $totalLoanCost,
			'totalInterest' => $totalInterest,
		);
	}

	public static function calculateSI($principal, $rate, $time){
		return ($principal * $rate * $time) / 100;
	}

	public static function checkLoanCode(string $code){
		return Loan::where('loan_code', $code)->first();
	}

	public static function createLoanCode(int $length = 10){
		$code = FunctionController::generateCode($length);
		if(!LoanController::checkLoanCode($code)){
			return $code;
		}
		return LoanController::createLoanCode();
	}

	protected function new(Request $request)
	{
		try{
			$validator = Validator::make($request->all(), [
				'applicationId' => 'required|integer',
				'startingDate' => 'required|date',
				'loanAmount' => 'required|decimal:0',
				'interestRate' => 'required',
				'loanPeriod' => 'required',
			]);

			if ($validator->fails()) {
				return back()->with([
					'success' => false,
					'title' => 'Input Error',
					'errors' => $validator->messages(),
					'alert' => 'warning'
				]);
			}
			$application = Application::find($request->applicationId);
			if(Auth::user()->user_type == "ADMIN" || $application->subadmin_id == Auth::id()){
				if(!$application){
					return back()->with([
						'success' => false,
						'title' => 'Error',
						'error' => 'Wrong application.',
						'alert' => 'error'
					]);
				}
				// check loan is created on this application or not
				$loan = Loan::where('application_id', $application->id)->first();
				if($loan){
					return back()->with([
						'success' => false,
						'title' => 'Error',
						'error' => 'Loan is already created for this application.',
						'alert' => 'warning'
					]);
				}
				
				DB::beginTransaction();
				// create loan
				$initialDeposit = ApplicationController::getTotalDeposit($application);
				$loanCalculation = LoanController::getLoanCalculation($request->loanAmount, $request->interestRate, $request->loanPeriod, $initialDeposit);
				
				$loan = Loan::create([
					'application_id' => $request->applicationId,
					'starting_date' => $request->startingDate,
					'loan_amount' => $request->loanAmount,
					'interest_rate' => $request->interestRate,
					'loan_period' => $request->loanPeriod,
					'monthly_payment' => FunctionController::formatCurrency($loanCalculation->monthlyPayment),
					'loan_code' => LoanController::createLoanCode(),
				]);
				
				// create monthly plan
				MonthlyPlanController::generate($loan, $loanCalculation->totalInstallments);

				// create LOAN_STARTED status
				if(ApplicationStatusController::getCurrentApplicationStatus($application) === 'APPROVED'){
					ApplicationStatus::create([
						'application_id' => $application->id,
						'application_status' => 'LOAN_STARTED',
					]);
				}
				DB::commit();
				return redirect()->back()->with([
					'success' => true,
					'title' => 'Loan Created',
					'message' => 'You have successfully created the loan for the application.',
					'alert' => 'success'
				]);
			}
		} catch (\PDOException $e) {
			// Woopsy
			DB::rollBack();
		}
	}

	protected function index(string $status = 'ALL'){
		$applications = ApplicationController::getUserApplications(Auth::user()->user_type);
		return view('loan.list', [
			'loanStr' => LoanController::getLoans($applications, $status),
		]);
	}

	protected function view(string $id){
		$loan = LoanController::checkLoanCode($id);
		if(!$loan){
			return redirect()->route('dashboard');
		}
		$userData = $loan->userData;
		if(!$userData){
			return redirect()->route('dashboard');
		}
		if(Auth::user()->user_type == 'TENANT'){
			if($userData->users_id != Auth::user()->id){
				return redirect()->route('dashboard');
			}
			$initialDeposit = ApplicationController::getTotalDeposit($loan->application);
			$loanCalculation = LoanController::getLoanCalculation($loan->loan_amount, $loan->interest_rate, $loan->loan_period, $initialDeposit);

			$monthlyPlanStr = MonthlyPlanController::getMonthlyPlan($loan, $initialDeposit);
			
			return view('loan.view', [
				'loan' => $loan,
				//'application' => $loan->application,
				'initialDeposit' => $initialDeposit,
				'loanCalculation' => $loanCalculation,
				'monthlyPlanStr' => $monthlyPlanStr,
			]);
		}
		else{
			$application = $loan->application;
			if(!$application){
				return redirect()->route('dashboard');
			}
			if( (Auth::user()->user_type == 'ADMIN') || ($application->subadmin_id == Auth::user()->id) ){
				$initialDeposit = ApplicationController::getTotalDeposit($loan->application);
				$loanCalculation = LoanController::getLoanCalculation($loan->loan_amount, $loan->interest_rate, $loan->loan_period, $initialDeposit);
				$monthlyPlanStr = MonthlyPlanController::getMonthlyPlan($loan, $initialDeposit);
				$applicationData = $userData->applicationData;

				return view('loan.view', [
					'loan' => $loan,
					'tenantName' => $applicationData->first_name . ' ' . $applicationData->surname,
					'initialDeposit' => $initialDeposit,
					'loanCalculation' => $loanCalculation,
					'monthlyPlanStr' => $monthlyPlanStr,
				]);
			}
			return redirect()->route('dashboard');
		}
	}

	public static function checkLoanClosed($loan){
		$totalDue = MonthlyPlanController::getTotalDues($loan->id);
		
		if($totalDue == 0){
			LoanController::close($loan);
		}
	}

	public static function close($loan){
		$loan->loan_status = 'CLOSED';
		$loan->save();

		$application = $loan->application;
		if($application && ApplicationStatusController::getCurrentApplicationStatus($application) == 'LOAN_STARTED'){
			ApplicationStatusController::new($application->id, 'LOAN_CLOSED');
		}
	}
}
