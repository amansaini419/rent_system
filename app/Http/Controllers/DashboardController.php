<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\MonthlyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{
	public function index(){
		$last50Applications = Application::orderBy('id', 'desc')->limit(50)->get();
		/* $last50RentPayment = DB::table('invoices AS I')
			->join('payments AS P', 'I.id', '=', 'P.invoice_id')
			->select('P.*')
			->where('I.invoice_type', 'RENT')
			->orderBy('P.created_at', 'desc')
			->limit(50)
			->get(); */
		$last50RentPayment = PaymentController::getUserPayments(Auth::user()->user_type, 50);
		$monthlyPlans = MonthlyPlan::where('due_date', '<=', date("Y-m-d"))->orderBy('created_at', 'desc')->get();
		$last50OutstandingRent = PaymentController::getOutstandingRent($monthlyPlans);
		$approvedStatusApplication = ApplicationStatusController::getTotalApplicationByStatus('APPROVED', '', 0);
		$totalApprovedStatusApplication = count($approvedStatusApplication);
		$allStatusApplication = ApplicationStatusController::getTotalApplicationByStatus();
		$data = array(
			'weeksApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('today'), 0),
			'weeksApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('week'), 0),
			'monthsApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('month'), 0),
			'quartersApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('quarter'), 0),
			'yearsApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('year'), 0),
			'yearsRegistrationFees' => FunctionController::formatCurrencyView(RegistrationFeeController::getTotalFees('year')),
			'yearsRentDisbursement' => FunctionController::formatCurrencyView(LoanController::getTotalDisbursement('year')),
			'yearsRepayments' => FunctionController::formatCurrencyView(PaymentController::getTotalRepayments('year')),
			'yearsApprovedApplication' => FunctionController::formatCurrencyView(ApplicationStatusController::getTotalApplicationByStatus('APPROVED', 'year'), 0),
			'applicationStatusPieChart' => (object)array(
				'pending' => $allStatusApplication - $totalApprovedStatusApplication,
				'rejected' => ApplicationStatusController::getTotalApplicationByStatus('REJECTED', 'year'),
				'approved' => $totalApprovedStatusApplication,
			),
			'genderPieChart' => ApplicationStatusController::getTotalApprovedApplicationGenderWise($approvedStatusApplication),
			'monthRentPayment' => (object)PaymentController::getNumberOfRents('month'),
			'last50Registration' => ApplicationController::getApplications($last50Applications),
			'applicationStatusLast50PieChart' => ApplicationStatusController::getTotalApplicationStatusWise($last50Applications),
			'last50RentPayment' => PaymentController::getPayments($last50RentPayment, 'RENT'),
			'paymentChannelPieChart' => PaymentController::getTotalPaymentChannelWise(),
			'last50OutstandingPayment' => MonthlyPlanController::getMonthlyPlans($last50OutstandingRent),
		);
		return view('dashboard', $data);
	}
}
