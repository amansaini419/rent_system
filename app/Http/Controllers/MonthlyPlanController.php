<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\MonthlyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonthlyPlanController extends Controller
{
	public static function generate(Loan $loan, $totalInstallments){
		$monthlyPlanStr = array();
		for ($i = 1; $i <= $totalInstallments; $i++) {
			$tempStr = array(
				'loan_id' => $loan->id,
				'payment_date' => date("Y-m-d", strtotime("+$i month", strtotime($loan->starting_date))),
			);
			$monthlyPlanStr[] = $tempStr;
		}
		MonthlyPlan::insert($monthlyPlanStr);
	}
}
