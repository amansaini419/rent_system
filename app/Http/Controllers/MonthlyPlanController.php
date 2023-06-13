<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Loan;
use App\Models\MonthlyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class MonthlyPlanController extends Controller
{
	public static function getMonthlyPlan($loan, $initialDeposit){
		$monthlyPlan = $loan->monthlyPlan;
		$monthlyPlanStr = array();
		$sn = 1;
		$beginningBalance = $loan->loan_amount - $initialDeposit;
		foreach($monthlyPlan as $temp){
			$monthlyInterestAmt = LoanController::calculateSI($beginningBalance, $loan->interest_rate, 1 / 12);
			$monthlyPrincipalAmt = $loan->monthly_payment - $monthlyInterestAmt;
			$endingBalance = $beginningBalance - $monthlyPrincipalAmt;
			$tempJSON = new stdClass();
			$tempJSON->sn = $sn++;
			$tempJSON->due_date = FunctionController::formatDate($temp->due_date);
			$tempJSON->payment_date = $temp->payment_date;
			$tempJSON->beginning_balance = FunctionController::formatCurrencyView($beginningBalance);
			$tempJSON->payment = $loan->monthly_payment;
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
		MonthlyPlan::insert($monthlyPlanStr);
	}
}
