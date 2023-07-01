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
		if(Auth::user()->user_type == 'TENANT'){
			$application = Auth::user()->latestApplications->first();
			//dd($application);
			$loan = $application->loan;
			//dd($loan);
			//$loanStr = LoanController::getLoanDetails($loan, $application);
			//$loanCalculation = LoanController::getLoanCalculation($loan->loan_amount, $loan->interest_rate, $loan->loan_period, $loanStr->initial_deposit_db);
			//$monthlyPlanStr = MonthlyPlanController::getMonthlyPlan($loan, $loanStr->initial_deposit_db);
			//dd($monthlyPlanStr);
			/* $applications = ApplicationController::getUserApplications(Auth::user()->user_type, Auth::id());
			$loans = LoanController::getLoans($applications); */
			//$last6RecentPayments = PaymentController::getUserPayments(Auth::user()->user_type, 6);

			$data = array(
				'paymentDetails' => PaymentController::getTenantpaymentDetails($loan, $application),
				'loan' => $loan,
				//'loanCalculation' => $loanCalculation,
				'paymentChannelPieChart' => PaymentController::getTotalPaymentChannelWise(),
				//'recentPayments' => PaymentController::getPayments($last6RecentPayments),
			);
		}
		elseif(Auth::user()->user_type == 'STAFF' || Auth::user()->user_type == 'AGENT' || Auth::user()->user_type == 'ADMIN'){
			$last50Applications = Application::orderBy('id', 'desc')->limit(50)->get();
			$last50RentPayment = PaymentController::getUserPayments(Auth::user()->user_type, 50);
			$monthlyPlans = MonthlyPlan::where('due_date', '<=', date("Y-m-d"))->orderBy('created_at', 'desc')->get();
			$last50OutstandingRent = PaymentController::getOutstandingRent($monthlyPlans);
			$approvedStatusApplication = ApplicationStatusController::getTotalApplicationByStatus('APPROVED', '', 0);
			$totalApprovedStatusApplication = count($approvedStatusApplication);
			$allStatusApplication = ApplicationStatusController::getTotalApplicationByStatus();
			$data = array(
				'todaysApplication' => FunctionController::formatCurrencyView(ApplicationController::getTotalApplications('today'), 0),
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
		}
		return view('dashboard', $data);
	}
}
