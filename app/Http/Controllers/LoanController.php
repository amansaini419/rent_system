<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use stdClass;

class LoanController extends Controller
{
	public static function calculateMonthlyPayment($loanAmount, $monthlyInterest, $totalInstallments){
		$adj = pow((1 + $monthlyInterest), $totalInstallments);
		return $loanAmount * $monthlyInterest * $adj / ($adj - 1);
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
		if(Auth::user()->user_type != "TENANT"){
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
			$currentApplicationStatus = $application->currentStatus->application_status;
			if($currentApplicationStatus === 'APPROVED'){
				ApplicationStatus::create([
					'application_id' => $application->id,
					'application_status' => 'LOAN_STARTED',
				]);
			}

			return redirect()->back()->with([
				'success' => true,
				'title' => 'Loan Created',
				'message' => 'You have successfully created the loan for the application.',
				'alert' => 'success'
			]);
		}
	}
}
