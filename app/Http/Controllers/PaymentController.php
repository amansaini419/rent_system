<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Mail\PaymentMail;
use App\Models\Application;
use App\Models\Invoice;
use App\Models\MonthlyPlan;
use App\Models\Payment;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use stdClass;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
	public static function checkPaymentRef($code){
		return Payment::where('payment_ref', $code)->first();
	}

	public static function new($invoiceId, $paymentAmount, $paymentChannel, $paymentRef = ''){
		return Payment::create([
			'invoice_id' => $invoiceId,
			'payment_amount' => $paymentAmount,
			'payment_ref' => $paymentRef == '' ? PaymentController::createPaymentRef() : $paymentRef,
			'payment_channel' => $paymentChannel,
		]);
	}

	protected function handleGatewayCallback(){
		$paymentDetails = Paystack::getPaymentData();
		//dd($paymentDetails);
		if($paymentDetails["status"]){
			$data = $paymentDetails["data"];
			$paymentRef = $data["reference"];
			if(!PaymentController::checkPaymentRef($paymentRef)){
				$amount = $data["amount"] / 100;
				$paymentChannel = ($data["channel"] == 'mobile_money') ? 'MOMO' : 'CARD';
				$invoiceType = $data["metadata"]["type"];
				if($invoiceType == 'REGISTRATION'){
					$invoice = InvoiceController::new(Auth::id(), $amount, 'REGISTRATION');
					RegistrationFeeController::new($data["metadata"]["user_data_id"], $invoice->id);
					PaymentController::new($invoice->id, $amount, $paymentChannel, $paymentRef );
					$mailData = [
						'title' => 'Registration Fee Payment',
						'body' => 'You have successfully paid the registration fees.'
					];
					Mail::to(Auth::user()->email)->send(new PaymentMail($mailData));
					$message = $mailData['body'];
					FunctionController::sendSMS(Auth::user()->phone_number, $message);
					return redirect()->route('application-register');
				}
				elseif($invoiceType == 'INITIAL_DEPOSIT'){
					$application = ApplicationController::checkApplicationCode($data["metadata"]["application_id"]);
					if($application){
						$invoice = InvoiceController::new(Auth::id(), $amount, 'INITIAL_DEPOSIT');
						InitialDepositController::new($application->id, $invoice->id);
						PaymentController::new($invoice->id, $amount, $paymentChannel, $paymentRef );
					}
					$mailData = [
						'title' => 'Initial Deposit',
						'body' => 'You have successfully initially deposited for the loan.'
					];
					Mail::to(Auth::user()->email)->send(new PaymentMail($mailData));
					$message = $mailData['body'];
					FunctionController::sendSMS(Auth::user()->phone_number, $message);
					return redirect()->route('application-list');
				}
				elseif($invoiceType == 'RENT'){
					$invoice = InvoiceController::new(Auth::id(), $amount, 'RENT');
					PaymentController::new($invoice->id, $amount, $paymentChannel, $paymentRef );
					$monthlyPlan = MonthlyPlan::find($data["metadata"]["monthly_plan_id"]);
					$monthlyPlan->invoice_id = $invoice->id;
					$monthlyPlan->payment_date = Carbon::now();
					$monthlyPlan->penalty = $data["metadata"]["penalty"];
					$monthlyPlan->save();

					$loan = $monthlyPlan->loan;
					LoanController::checkLoanClosed($loan);

					$mailData = [
						'title' => 'Rent Payment',
						'body' => 'You have successfully paid your rent online.'
					];
					Mail::to(Auth::user()->email)->send(new PaymentMail($mailData));
					$message = $mailData['body'];
					FunctionController::sendSMS(Auth::user()->phone_number, $message);

					return redirect()->back()->with([
						'success' => true,
						'title' => 'Payment',
						'message' => 'You have successfully done the payment.',
						'alert' => 'success'
					]);
				}
			}
		}
		return redirect()->route('dashboard');
		/* // FOR registration fees
		$userData = UserData::where(DB::raw('md5(id)'), $request->userDataId)->first();
		$userDataId = $userData->id;
		$invoice = InvoiceController::new(Auth::id(), SettingController::getValue('REGISTRATION_FEES'), 'REGISTRATION');
		$invoiceId = $invoice->id;
		RegistrationFeeController::new($userDataId, $invoiceId);
		PaymentController::new($invoiceId, SettingController::getValue('REGISTRATION_FEES'), 'CARD');
		return redirect()->route('application-register');

		// FOR Initial deposit
		$application = ApplicationController::checkApplicationCode($request->applicationId);
		if($application){
			$invoice = InvoiceController::new(Auth::id(), $request->depositAmount, 'INITIAL_DEPOSIT');
			$invoiceId = $invoice->id;
			InitialDepositController::new($application->id, $invoiceId);
			PaymentController::new($invoiceId, $request->depositAmount, 'CARD');
		}
		return redirect()->route('application-list');

		// FOR rent payment
		// create invoice
		$invoice = InvoiceController::new(Auth::id(), $totalpayment, 'RENT');
		// create payment
		PaymentController::new($invoice->id, $totalpayment, 'CARD');
		// update monthly plan
		$monthlyPlan->invoice_id = $invoice->id;
		$monthlyPlan->payment_date = Carbon::now();
		$monthlyPlan->penalty = $penaltyAmount;
		$monthlyPlan->save();

		LoanController::checkLoanClosed($loan);

		$mailData = [
			'title' => 'Rent Payment',
			'body' => 'You have successfully paid your rent online.'
		];
		Mail::to(Auth::user()->email)->send(new PaymentMail($mailData));
		$message = $mailData['body'];
		FunctionController::sendSMS(Auth::user()->phone_number, $message);

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Payment',
			'message' => 'You have successfully done the payment.',
			'alert' => 'success'
		]); */
	}

	public function payRegistrationFees(Request $request){
		$userData = UserData::where(DB::raw('md5(id)'), $request->userDataId)->first();
		try {
			$data = array(
				"amount" => SettingController::getValue('REGISTRATION_FEES') * 100,
				"reference" => PaymentController::createPaymentRef(),
				"email" => Auth::user()->email,
				"currency" => "GHS",
				"metadata" => array(
					"user_data_id" => $userData->id,
					"type" => "REGISTRATION"
				),
			);
			//dd($data); die();
			return Paystack::getAuthorizationUrl($data)->redirectNow();
		} catch (\Exception $e) {
			dd($e);
			return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
		}
	}

	public function payInitialDeposit(Request $request){
		try {
			$data = array(
				"amount" => $request->depositAmount * 100,
				"reference" => PaymentController::createPaymentRef(),
				"email" => Auth::user()->email,
				"currency" => "GHS",
				"metadata" => array(
					"application_id" => $request->applicationId,
					"type" => "INITIAL_DEPOSIT"
				),
			);
			//dd($data); die();
			return Paystack::getAuthorizationUrl($data)->redirectNow();
		} catch (\Exception $e) {
			dd($e);
			return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
		}
	}

	public static function createPaymentRef($length = 10){
		$code = FunctionController::generateCode($length);
		if(!PaymentController::checkPaymentRef($code)){
			return $code;
		}
		return PaymentController::createPaymentRef();
	}

	protected function payRent(Request $request){
		$validator = Validator::make($request->all(), [
			'monthlyId' => 'required',
		]);

		if ($validator->fails()) {
			return back()->with([
				'success' => false,
				'title' => 'Input Error',
				'errors' => $validator->messages(),
				'alert' => 'warning'
			]);
		}

		$monthlyPlan = MonthlyPlanController::getByHashId($request->monthlyId);
		if(!$monthlyPlan){
			return back()->with([
				'success' => false,
				'title' => 'Error',
				'error' => 'Invalid payment request.',
				'alert' => 'error'
			]);
		}
		$loan = $monthlyPlan->loan;
		if(!$loan){
			return back()->with([
				'success' => false,
				'title' => 'Error',
				'error' => 'Invalid loan request.',
				'alert' => 'error'
			]);
		}

		$paymentAmount = FunctionController::formatCurrency($loan->monthly_payment);
		$penaltyAmount = FunctionController::formatCurrency(MonthlyPlanController::calculatePenalty(Carbon::parse($monthlyPlan->due_date), $loan->monthly_payment));
		echo $totalpayment = FunctionController::formatCurrency($paymentAmount + $penaltyAmount);

		try {
			$data = array(
				"amount" => $totalpayment * 100,
				"reference" => PaymentController::createPaymentRef(),
				"email" => Auth::user()->email,
				"currency" => "GHS",
				"metadata" => array(
					"monthly_plan_id" => $monthlyPlan->id,
					"type" => "RENT",
					"penalty" => $penaltyAmount
				),
			);
			//dd($data); die();
			return Paystack::getAuthorizationUrl($data)->redirectNow();
		} catch (\Exception $e) {
			dd($e);
			return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
		}
	}

	protected function payRentOffline(Request $request){
		$validator = Validator::make($request->all(), [
			'monthlyId' => 'required',
			'paymentChannel' => 'required',
		]);

		if ($validator->fails()) {
			return back()->with([
				'success' => false,
				'title' => 'Input Error',
				'errors' => $validator->messages(),
				'alert' => 'warning'
			]);
		}

		$monthlyPlan = MonthlyPlanController::getByHashId($request->monthlyId);
		if(!$monthlyPlan){
			return back()->with([
				'success' => false,
				'title' => 'Error',
				'error' => 'Invalid payment request.',
				'alert' => 'error'
			]);
		}
		$loan = $monthlyPlan->loan;
		if(!$loan){
			return back()->with([
				'success' => false,
				'title' => 'Error',
				'error' => 'Invalid loan request.',
				'alert' => 'error'
			]);
		}

		$userData = $loan->userData;
		if(!$userData){
			return back()->with([
				'success' => false,
				'title' => 'Error',
				'error' => 'Invalid user.',
				'alert' => 'error'
			]);
		}

		$paymentAmount = FunctionController::formatCurrency($loan->monthly_payment);
		$penaltyAmount = FunctionController::formatCurrency(MonthlyPlanController::calculatePenalty(Carbon::parse($monthlyPlan->due_date), $loan->monthly_payment));
		$totalpayment = FunctionController::formatCurrency($paymentAmount + $penaltyAmount);

		// create invoice
		$invoice = InvoiceController::new($userData->users_id, $totalpayment, 'RENT');
		// create payment
		PaymentController::new($invoice->id, $totalpayment, $request->paymentChannel);
		// update monthly plan
		$monthlyPlan->invoice_id = $invoice->id;
		$monthlyPlan->payment_date = Carbon::now();
		$monthlyPlan->penalty = $penaltyAmount;
		$monthlyPlan->save();

		LoanController::checkLoanClosed($loan);

		$mailData = [
			'title' => 'Rent Payment',
			'body' => 'You have successfully paid your rent offline.'
		];
		Mail::to(Auth::user()->email)->send(new PaymentMail($mailData));
		$message = $mailData['body'];
		FunctionController::sendSMS(Auth::user()->phone_number, $message);

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Payment',
			'message' => 'You have successfully received the payment through ' . $request->paymentChannel . '.',
			'alert' => 'success'
		]);
	}

	public static function getTotalRepayments($type = ''){
		$dateRange = FunctionController::getDateRange($type);
		$invoices = ($type != '') ? Invoice::whereBetween('created_at', [$dateRange->from, $dateRange->to]) : Invoice::all();
		return $invoices->where('invoice_type', 'RENT')->sum('invoice_amount');
	}

	public static function getOutstandingRent($monthlyPlans, $limit = 50){
		$responseStr = array();
		//$total = count($monthlyPlans);
		$counter = 1;
		//$limit = ($total < $limit) ? $total : ;
		foreach($monthlyPlans as $monthlyPlan){
			if($limit != -1 && $counter >= $limit){
				break;
			}
			if($monthlyPlan->invoice_id == 0){
				$responseStr[] = $monthlyPlan;
				$counter++;
			}
			else{
				$invoiceAmount = $monthlyPlan->invoice->invoice_amount;
				$totalPayment = $monthlyPlan->payments->sum('payment_amount');
				if($totalPayment < $invoiceAmount){
					$responseStr[] = $monthlyPlan;
					$counter++;
				}
			}
		}
		return $responseStr;
	}

	public static function getUserMonthlyPlan($userType, $userId, $type = ''){
		$dateRange = FunctionController::getDateRange($type);
		if($userType == "ADMIN"){
			$monthlyPlans = ($type != '') ? MonthlyPlan::whereBetween('due_date', [$dateRange->from, $dateRange->to])->get() : MonthlyPlan::all();
		}
		elseif($userType == "TENANT" || $userType == "STAFF" || $userType == "AGENT"){
			$applications = ApplicationController::getUserApplications($userType, $userId);
			$loans = LoanController::getLoans($applications);
			$loanIdStr = LoanController::getLoanIds($loans);
			$monthlyPlans = MonthlyPlan::whereIn('loan_id', $loanIdStr)->whereBetween('due_date', [$dateRange->from, $dateRange->to])->latest()->get();
		}
		return $monthlyPlans;
	}

	public static function getNumberOfRents($type = ''){
		$monthlyPlans = PaymentController::getOutstandingMonthlyPlan(Auth::user()->user_type, Auth::id(), $type);
		$total = $paid = $outstanding = $zero = $partial = 0;
		foreach($monthlyPlans as $plan){
			$total++;
			if($plan->invoice_id == 0){
				$outstanding++;
				$zero++;
			}
			else{
				$invoiceAmount = $plan->invoice->invoice_amount;
				$totalPayment = $plan->payments->sum('payment_amount');
				//dd($totalPayment);
				if($totalPayment >= $invoiceAmount){
					$paid++;
				}
				elseif($totalPayment == 0){
					$outstanding++;
					$zero++;
				}
				else{
					$outstanding++;
					$partial++;
				}
			}
		}
		return array(
			'total' => $total,
			'paid' => $paid,
			'outstanding' => $outstanding,
			'zero' => $zero,
			'partial' => $partial,
		);
	}

	public static function getTotalPaymentChannelWise(){
		$paymentsIdStr = PaymentController::getUserPayments(Auth::user()->user_type)->pluck('id');
		$paymentChannels = Payment::whereIn('id', $paymentsIdStr)->groupBy('payment_channel')->select('payment_channel', DB::raw('count(*) AS total'))->get();
		//dd($paymentChannels);
		$responseStr = array(
			'CASH' => 0,
			'CARD' => 0,
			'MOMO' => 0,
		);
		foreach($paymentChannels as $paymentChannel){
			$responseStr[$paymentChannel->payment_channel] = $paymentChannel->total;
		}
		//dd($responseStr);
		return (object)$responseStr;
	}

	public static function getPaymentDetails($payment, $invoice){
		$tempJSON = new stdClass();
		$userData = InvoiceController::getInvoiceUserData($invoice);
		$applicationData = $userData->applicationData;
		$tempJSON->id = $payment->id;
		$tempJSON->invoice_id = $payment->invoice_id;
		$tempJSON->invoice_code = $invoice->invoice_code;
		$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
		$tempJSON->payment_date = FunctionController::formatDate($payment->created_at);
		$tempJSON->payment_channel = $payment->payment_channel;
		$tempJSON->payment_amount = FunctionController::formatCurrencyView($payment->payment_amount);
		$tempJSON->payment_ref = $payment->payment_ref;
		$tempJSON->invoice_type = $invoice->invoice_type;
		return $tempJSON;
	}

	public static function getPayments($payments, $type = 'ALL'){
		$paymentStr = array();
		foreach($payments as $payment){
			$invoice = Invoice::find($payment->invoice_id);
			if( $type == 'ALL' || ($invoice && $invoice->invoice_type == $type) ){
				$paymentStr[] = PaymentController::getPaymentDetails($payment, $invoice);
			}
		}
		return $paymentStr;
	}

	public static function getUserPayments($userType, $limit = -1){
		if($userType == "STAFF" || $userType == "AGENT" || $userType == "TENANT" ){
			$paymentSql = Payment::whereIn('invoice_id', InvoiceController::getUserInvoices()->pluck('id'))->latest();
		}
		elseif($userType == "ADMIN"){
			$paymentSql = Payment::latest();
		}
		return ($limit == -1) ? $paymentSql->get() : $paymentSql->limit($limit)->get();
	}

	protected function index(string $type = 'ALL'){
		$payments = PaymentController::getUserPayments(Auth::user()->user_type);
		return view('payment.list', [
			'paymentStr' => PaymentController::getPayments($payments, $type)
		]);
	}

	public static function getOutstandingMonthlyPlan($userType, $userId){
		if($userType == "ADMIN"){
			$monthlyPlans = MonthlyPlan::where('due_date', '<=', date("Y-m-d"))->latest()->get();
		}
		elseif($userType == "TENANT" || $userType == "STAFF" || $userType == "AGENT"){
			$applications = ApplicationController::getUserApplications($userType, $userId);
			$openedLoans = LoanController::getLoans($applications, 'OPENED');
			$loanIdStr = LoanController::getLoanIds($openedLoans);
			$monthlyPlans = MonthlyPlan::whereIn('loan_id', $loanIdStr)->where('due_date', '<=', date("Y-m-d"))->latest()->get();
		}
		return $monthlyPlans;
	}

	protected function outstanding(){
		$monthlyPlans = PaymentController::getOutstandingMonthlyPlan(Auth::user()->user_type, Auth::id());
		$outstandingRents = PaymentController::getOutstandingRent($monthlyPlans, -1);
		//dd($outstandingRent);
		return view('payment.outstanding', [
			'outstandingRentStr' => MonthlyPlanController::getMonthlyPlans($outstandingRents)
		]);
	}

	public static function getTenantpaymentDetails($loan, $application){
		if($loan != null){
			$loanStr = LoanController::getLoanDetails($loan, $application);
			$loanCalculation = LoanController::getLoanCalculation($loan->loan_amount, $loan->interest_rate, $loan->loan_period, $loanStr->initial_deposit_db);

			$totalAmount = $loanCalculation->totalLoanCost;
			$totalPayment = LoanController::getLoanPayment($loan);
			$totalOutstanding = $totalAmount - $totalPayment;

			$recentPaymentsStr = array();
			$initialDeposits = $application->initialDeposits;
			$balanceBF = $totalAmount + $loanStr->initial_deposit_db;
			foreach($initialDeposits as $deposit){
				$balanceBF -= $deposit->invoice_amount;
				$tempJSON = new stdClass();
				$tempJSON->amount = FunctionController::formatCurrencyView($deposit->invoice_amount);
				$tempJSON->month = 'DEPOSIT';
				$tempJSON->due_date = FunctionController::formatDate($deposit->created_at);
				$tempJSON->date_paid = FunctionController::formatDate($deposit->created_at);
				$tempJSON->balance_bf = FunctionController::formatCurrencyView($balanceBF);
				$tempJSON->note = 'SECURITY DEPOSIT';
				$tempJSON->pay = 'Paid';
				$recentPaymentsStr[] = $tempJSON;
			}

			$monthlyPlanStr = MonthlyPlanController::getMonthlyPlan($loan, $loanStr->initial_deposit_db);
			//dd($monthlyPlanStr);
			foreach($monthlyPlanStr as $plan){
				$payStatus = '';
				if($plan->payment_date != null){
					$balanceBF -= $plan->paymentAmount;
					$payStatus = 'Paid';
				}
				$tempJSON = new stdClass();
				$tempJSON->amount = $plan->payment;
				$tempJSON->month = strtoupper(FunctionController::formatRentMonth($plan->due_date));
				$tempJSON->due_date = $plan->due_date;
				$tempJSON->date_paid = $plan->payment_date;
				$tempJSON->balance_bf = FunctionController::formatCurrencyView(($balanceBF < 0) ? 0 : $balanceBF);
				$tempJSON->note = $plan->note;
				$tempJSON->paymentAmount = $plan->paymentAmount;
				$tempJSON->penaltyAmount = $plan->penaltyAmount;
				$tempJSON->id = $plan->id;
				$tempJSON->pay = $payStatus;
				$recentPaymentsStr[] = $tempJSON;
			}

			return (object)array(
				'total' => FunctionController::formatCurrencyView($totalAmount),
				'deposit' => $loanStr->initial_deposit,
				'payment' => FunctionController::formatCurrencyView($totalPayment),
				'payment_db' => FunctionController::formatCurrency($totalPayment),
				'outstanding' => FunctionController::formatCurrencyView($totalOutstanding),
				'outstanding_db' => FunctionController::formatCurrency($totalOutstanding),
				'recentPaymentsStr' => $recentPaymentsStr,
			);
		}
		return (object)array(
			'total' => FunctionController::formatCurrencyView(0),
			'deposit' => FunctionController::formatCurrencyView(0),
			'payment' => FunctionController::formatCurrencyView(0),
			'payment_db' => FunctionController::formatCurrency(0),
			'outstanding' => FunctionController::formatCurrencyView(0),
			'outstanding_db' => FunctionController::formatCurrency(0),
			'recentPaymentsStr' => array(),
		);
	}
}
