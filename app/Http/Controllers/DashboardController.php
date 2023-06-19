<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use Illuminate\Http\Request;
use stdClass;

class DashboardController extends Controller
{
	public function index(){
		$approvedStatusApplication = ApplicationStatusController::getTotalApplicationByStatus('APPROVED', 'year');
		$allStatusApplication = ApplicationStatusController::getTotalApplicationByStatus();
		$data = array(
			'weeksApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('week'), 0),
			'monthsApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('month'), 0),
			'quartersApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('quarter'), 0),
			'yearsApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('year'), 0),
			'yearsRegistrationFees' => FunctionController::formatCurrencyView(RegistrationFeeController::getTotalFees('year')),
			'yearsRentDisbursement' => FunctionController::formatCurrencyView(LoanController::getTotalDisbursement('year')),
			'yearsRepayments' => FunctionController::formatCurrencyView(PaymentController::getTotalRepayments('year')),
			'yearsApprovedApplication' => FunctionController::formatCurrencyView($approvedStatusApplication, 0),
			'applicationStatusPieChart' => (object)array(
				'pending' => $allStatusApplication - $approvedStatusApplication,
				'rejected' => ApplicationStatusController::getTotalApplicationByStatus('REJECTED', 'year'),
				'approved' => $approvedStatusApplication,
			),
			'genderPieChart' => (object)array(
				'male' => 0,
				'female' => 0,
			),
			''
		);
		return view('dashboard', $data);
	}
}
