<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Loan;
use App\Models\MonthlyPlan;
use Carbon\Carbon;
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

	public static function getMonthlyPlan($loan, $initialDeposit){
		$monthlyPlan = $loan->monthlyPlan;
		$monthlyPlanStr = array();
		$sn = 1;
		$beginningBalance = $loan->loan_amount - $initialDeposit;
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
					$penalty = MonthlyPlanController::calculatePenalty(Carbon::parse($temp->due_date), $loan->monthly_payment);
				}
			}
			$tempJSON = new stdClass();
			$tempJSON->sn = $sn++;
			$tempJSON->id = $temp->id;
			$tempJSON->note = $temp->tenant_note;
			$tempJSON->due_date = FunctionController::formatDate($temp->due_date);
			$tempJSON->payment_status = $paymentStatus;
			$tempJSON->payment_date = ($temp->payment_date == null) ? $temp->payment_date : FunctionController::formatDate($temp->payment_date);
			$tempJSON->beginning_balance = FunctionController::formatCurrencyView($beginningBalance);
			$tempJSON->payment = FunctionController::formatCurrencyView($loan->monthly_payment);
			$tempJSON->paymentAmount = FunctionController::formatCurrency($loan->monthly_payment);
			$tempJSON->penaltyAmount = FunctionController::formatCurrency($penalty);
			$tempJSON->penalty = FunctionController::formatCurrencyView($penalty);
			$tempJSON->principal = FunctionController::formatCurrencyView($monthlyPrincipalAmt);
			$tempJSON->interest = FunctionController::formatCurrencyView($monthlyInterestAmt);
			$tempJSON->ending_balance = FunctionController::formatCurrencyView($endingBalance);
			$monthlyPlanStr[] = $tempJSON;

			$beginningBalance = $endingBalance;
		}
		return (object)$monthlyPlanStr;
	}

	public static function generate(Loan $loan, $totalInstallments){
		for ($i = 1; $i <= $totalInstallments; $i++) {
			MonthlyPlan::create([
				'loan_id' => $loan->id,
				'due_date' => date("Y-m-d", strtotime("+$i month", strtotime($loan->starting_date))),
			]);
		}
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
		$penalty = MonthlyPlanController::calculatePenalty(Carbon::parse($monthlyPlan->due_date), $loan->monthly_payment);
		$tempJSON->id = $monthlyPlan->id;
		$tempJSON->account_type = $accomodationData->property_type;
		$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
		$tempJSON->due_date = FunctionController::formatDate($monthlyPlan->due_date);
		$tempJSON->days_over = Carbon::parse($monthlyPlan->due_date)->diffInDays(Carbon::now(), false);
		$tempJSON->penalty = $penalty == 0 ? 'NO' : 'YES';
		$tempJSON->payment_amount = FunctionController::formatCurrencyView($loan->monthly_payment);
		$tempJSON->payment_amount_db = FunctionController::formatCurrency($loan->monthly_payment);
		$tempJSON->total_amount = FunctionController::formatCurrencyView($loan->monthly_payment + $penalty);
		$tempJSON->total_amount_db = FunctionController::formatCurrency($loan->monthly_payment + $penalty);
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
