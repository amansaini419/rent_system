<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\InitialDeposit;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\RegistrationFee;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
		//
	}

	protected function payRentOffline(Request $request){
		//
	}
}
