<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Payment;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
	public static function checkPaymentRef($code){
		return Payment::where('payment_ref', $code)->first();
	}

	public static function new($invoiceId, $paymentAmount, $paymentChannel){
		return Payment::create([
			'invoice_id' => $invoiceId,
			'payment_amount' => $paymentAmount,
			'payment_ref' => PaymentController::createPaymentRef(),
			'payment_channel' => $paymentChannel,
		]);
	}

	public function payRegistrationFees(Request $request){
		/* try {
			$data = array(
				"amount" => SettingController::getValue('REGISTRATION_FEES'),
				"reference" => PaymentController::createPaymentRef(),
				"email" => Auth::user()->email,
				"currency" => "GHS",
				"metadata" => array(
					"user_data_id" => $request->userDataId,
				),
			);
			//dd($data); die();
			return Paystack::getAuthorizationUrl($data)->redirectNow();
		} catch (\Exception $e) {
			dd($e); die();
			return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
		} */
		$userData = UserData::where(DB::raw('md5(id)'), $request->userDataId)->first();
		$userDataId = $userData->id;
		$invoice = InvoiceController::new(SettingController::getValue('REGISTRATION_FEES'), 'REGISTRATION');
		$invoiceId = $invoice->id;
		RegistrationFeeController::new($userDataId, $invoiceId);
		PaymentController::new($invoiceId, SettingController::getValue('REGISTRATION_FEES'), 'CARD');
		return Redirect::back();
	}

	public function payInitialDeposit(Request $request){
		$application = ApplicationController::checkApplicationCode($request->applicationId);
		if($application){
			$invoice = InvoiceController::new($request->depositAmount, 'INITIAL_DEPOSIT');
			$invoiceId = $invoice->id;
			InitialDepositController::new($application->id, $invoiceId);
			PaymentController::new($invoiceId, $request->depositAmount, 'CARD');
		}
		return Redirect::back();
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
		$totalpayment = FunctionController::formatCurrency($paymentAmount + $penaltyAmount);

		// create invoice
		$invoice = InvoiceController::new($totalpayment, 'RENT');
		// create payment
		PaymentController::new($invoice->id, $totalpayment, 'CARD');
		// update monthly plan
		$monthlyPlan->invoice_id = $invoice->id;
		$monthlyPlan->payment_date = Carbon::now();
		$monthlyPlan->penalty = $penaltyAmount;
		$monthlyPlan->save();

		LoanController::checkLoanClosed($loan);

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Payment',
			'message' => 'You have successfully done the payment.',
			'alert' => 'success'
		]);
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

		$paymentAmount = FunctionController::formatCurrency($loan->monthly_payment);
		$penaltyAmount = FunctionController::formatCurrency(MonthlyPlanController::calculatePenalty(Carbon::parse($monthlyPlan->due_date), $loan->monthly_payment));
		$totalpayment = FunctionController::formatCurrency($paymentAmount + $penaltyAmount);

		// create invoice
		$invoice = InvoiceController::new($totalpayment, 'RENT');
		// create payment
		PaymentController::new($invoice->id, $totalpayment, $request->paymentChannel);
		// update monthly plan
		$monthlyPlan->invoice_id = $invoice->id;
		$monthlyPlan->payment_date = Carbon::now();
		$monthlyPlan->penalty = $penaltyAmount;
		$monthlyPlan->save();

		LoanController::checkLoanClosed($loan);

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Payment',
			'message' => 'You have successfully received the payment through ' . $request->paymentChannel . '.',
			'alert' => 'success'
		]);
	}
}
