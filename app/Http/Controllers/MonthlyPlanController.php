<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Loan;
use App\Models\MonthlyPlan;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use stdClass;

class MonthlyPlanController extends Controller
{
	public static function calculatePenalty($dueDate, $payment){
		$penalty = 0;
		$now = Carbon::now();
		$diff = $dueDate->diffInDays($now, false);
		if($diff >= SettingController::getValue('FIRST_PENALTY_DAY')){
			$penaltyPer = SettingController::getValue('FIRST_PENALTY_PER') / 100;
			if($diff >= SettingController::getValue('SECOND_PENALTY_DAY')){
				$penaltyPer = SettingController::getValue('SECOND_PENALTY_PER') / 100;
			}
			$penalty = $payment * $penaltyPer;
		}
		return $penalty;
	}

	public static function getMonthlyPlan($loan){
		$monthlyPlan = $loan->monthlyPlan;
		$monthlyPlanStr = array();
		$sn = 1;
		$beginningBalance = $loan->loan_amount;
		foreach($monthlyPlan as $temp){
			$monthlyInterestAmt = LoanController::calculateSI($beginningBalance, $loan->interest_rate, 1 / 12);
			$monthlyPrincipalAmt = $loan->monthly_payment - $monthlyInterestAmt;
			$endingBalance = $beginningBalance - $monthlyPrincipalAmt;
			$paymentStatus = "PAID";
			$penalty = $temp->penalty;
			if($temp->invoice_id == 0){
				$paymentStatus = "NOT PAID";
				if(strtotime($temp->due_date) < strtotime(date("Y-m-d"))){
					$paymentStatus = "DUE";
					$penalty = MonthlyPlanController::calculatePenalty(Carbon::parse($temp->due_date), $temp->payment_amount);
				}
			}
			$tempJSON = new stdClass();
			$tempJSON->sn = $sn++;
			$tempJSON->id = $temp->id;
			$tempJSON->note = $temp->tenant_note;
			$tempJSON->payment_status = $paymentStatus;
			$tempJSON->payment_date = ($temp->payment_date == null) ? $temp->payment_date : FunctionController::formatDate($temp->payment_date);
			$tempJSON->paymentAmountDb = FunctionController::formatCurrency($temp->payment_amount);
			$tempJSON->paymentAmount = FunctionController::formatCurrencyView($temp->payment_amount);
			$tempJSON->penaltyAmount = FunctionController::formatCurrencyView($penalty);
			$tempJSON->penaltyAmountDb = FunctionController::formatCurrency($penalty);
			$tempJSON->totalAmountDb = FunctionController::formatCurrency($temp->payment_amount + $penalty);
			$tempJSON->totalAmount = FunctionController::formatCurrencyView($temp->payment_amount + $penalty);

			/* FOR MONTHLY PLAN TABLE */
			$tempJSON->due_date = FunctionController::formatDate($temp->due_date);
			$tempJSON->beginning_balance = FunctionController::formatCurrencyView($beginningBalance);
			$tempJSON->payment = FunctionController::formatCurrencyView($loan->monthly_payment);
			$tempJSON->paymentDb = FunctionController::formatCurrency($loan->monthly_payment);
			$tempJSON->principal = FunctionController::formatCurrencyView($monthlyPrincipalAmt);
			$tempJSON->interest = FunctionController::formatCurrencyView($monthlyInterestAmt);
			$tempJSON->ending_balance = FunctionController::formatCurrencyView($endingBalance);
			$beginningBalance = $endingBalance;
			/* FOR MONTHLY PLAN TABLE */

			$monthlyPlanStr[] = $tempJSON;
		}
		return (object)$monthlyPlanStr;
	}

	public static function generate(Loan $loan, $totalInstallments){
		$paymentDate = Carbon::parse($loan->starting_date);
		for ($i = 1; $i <= $totalInstallments; $i++) {
			$paymentAmount = ($i == 1) ? ($loan->monthly_payment + $loan->initial_deposit) : $loan->monthly_payment;
			MonthlyPlan::create([
				'loan_id' => $loan->id,
				'payment_amount' => FunctionController::formatCurrency($paymentAmount),
				'due_date' => $paymentDate->format('Y-m-d'),
			]);
			//echo $paymentDate->format('Y-m-d');
			$paymentDate = $paymentDate->startOfMonth()->add(CarbonInterval::months(1));
			//echo "<br>";
		}
		//die();
	}

	public static function getByHashId($id){
		return MonthlyPlan::where(DB::raw('md5(id)'), $id)->first();
	}

	public static function getTotalDues($loanId){
		return MonthlyPlan::where('loan_id', $loanId)
			->where('invoice_id', 0)
			->count();
	}

	public static function getMonthlyPlanDetails($monthlyPlan){
		$tempJSON = new stdClass();
		$loan = $monthlyPlan->loan;
		$userData = $loan->userData;
		$applicationData = $userData->applicationData;
		$accomodationData = $userData->accomodationData;
		$penalty = MonthlyPlanController::calculatePenalty(Carbon::parse($monthlyPlan->due_date), $monthlyPlan->payment_amount);
		$tempJSON->id = $monthlyPlan->id;
		$tempJSON->account_type = $accomodationData->property_type;
		$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
		$tempJSON->due_date = FunctionController::formatDate($monthlyPlan->due_date);
		$tempJSON->days_over = Carbon::parse($monthlyPlan->due_date)->diffInDays(Carbon::now(), false);
		$tempJSON->penalty = $penalty == 0 ? 'NO' : 'YES';
		$tempJSON->payment_amount = FunctionController::formatCurrencyView($monthlyPlan->payment_amount);
		$tempJSON->payment_amount_db = FunctionController::formatCurrency($monthlyPlan->payment_amount);
		$tempJSON->total_amount = FunctionController::formatCurrencyView($monthlyPlan->payment_amount + $penalty);
		$tempJSON->total_amount_db = FunctionController::formatCurrency($monthlyPlan->payment_amount + $penalty);
		$tempJSON->penalty_amount = FunctionController::formatCurrencyView($penalty);
		$tempJSON->penalty_amount_db = FunctionController::formatCurrency($penalty);
		return $tempJSON;
	}

	public static function getMonthlyPlans($monthlyPlans){
		$monthlyPlanStr = array();
		foreach($monthlyPlans as $monthlyPlan){
			$monthlyPlanStr[] = MonthlyPlanController::getMonthlyPlanDetails($monthlyPlan);
		}
		return $monthlyPlanStr;
	}
}
