<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
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
	public static function checkPaymentRef($code)
	{
		return Payment::where('payment_ref', $code)->first();
	}

	public function payRegistrationFees(Request $request)
	{
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
		$invoice = Invoice::create([
			'invoice_amount' => SettingController::getValue('REGISTRATION_FEES'),
			'invoice_type' => 'REGISTRATION',
			'invoice_code' => InvoiceController::createInvoiceCode(),
		]);
		$invoiceId = $invoice->id;
		$registrationFee = RegistrationFee::create([
			'user_data_id' => $userDataId,
			'invoice_id' => $invoiceId,
		]);
		$payment = Payment::create([
			'invoice_id' => $invoiceId,
			'payment_amount' => SettingController::getValue('REGISTRATION_FEES'),
			'payment_ref' => PaymentController::createPaymentRef(),
			'payment_channel' => 'CARD',
		]);
		return Redirect::back();
	}

	public static function createPaymentRef($length = 10){
		$code = FunctionController::generateCode($length);
		if(!PaymentController::checkPaymentRef($code)){
			return $code;
		}
		return PaymentController::createPaymentRef();
	}
}
