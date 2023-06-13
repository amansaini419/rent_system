<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Loan;
use App\Models\MonthlyPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class MonthlyPlanController extends Controller
{
	public static function calculatePenalty($dueDate, $payment){
		$penalty = 0;
		$now = Carbon::now();
		$diff = $dueDate->diffInDays($now, false);
		//dd($diff);
		if($diff >= SettingController::getValue('FIRST_PENALTY_DAY')){
			$penaltyPer = SettingController::getValue('FIRST_PENALTY_PER') / 100;
			if($diff >= SettingController::getValue('SECOND_PENALTY_DAY')){
				$penaltyPer = SettingController::getValue('SECOND_PENALTY_PER') / 100;
			}
			$penalty = $payment * $penaltyPer;
		}
		//dd($penalty);
		return FunctionController::formatCurrency($penalty);
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
			$tempJSON->due_date = FunctionController::formatDate($temp->due_date);
			$tempJSON->payment_status = $paymentStatus;
			$tempJSON->payment_date = ($temp->payment_date == null) ? $temp->payment_date : FunctionController::formatDate($temp->payment_date);
			$tempJSON->beginning_balance = FunctionController::formatCurrencyView($beginningBalance);
			$tempJSON->payment = FunctionController::formatCurrencyView($loan->monthly_payment);
			$tempJSON->paymentAmount = $loan->monthly_payment;
			$tempJSON->penaltyAmount = $penalty;
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
		$monthlyPlanStr = array();
		for ($i = 1; $i <= $totalInstallments; $i++) {
			$tempStr = array(
				'loan_id' => $loan->id,
				'due_date' => date("Y-m-d", strtotime("+$i month", strtotime($loan->starting_date))),
			);
			$monthlyPlanStr[] = $tempStr;
		}
		MonthlyPlan::create($monthlyPlanStr);
	}

	public static function getByHashId($id){
		return MonthlyPlan::where(DB::raw('md5(id)'), $id)->first();
	}

	public static function getTotalDues($loanId){
		return MonthlyPlan::where('loan_id', $loanId)
			->where('invoice_id', 0)
			->count();
	}
}
