<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Invoice;
use App\Models\MonthlyPlan;
use App\Models\Payment;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use stdClass;
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
		$invoice = InvoiceController::new(Auth::id(), SettingController::getValue('REGISTRATION_FEES'), 'REGISTRATION');
		$invoiceId = $invoice->id;
		RegistrationFeeController::new($userDataId, $invoiceId);
		PaymentController::new($invoiceId, SettingController::getValue('REGISTRATION_FEES'), 'CARD');
		return Redirect::back();
	}

	public function payInitialDeposit(Request $request){
		$application = ApplicationController::checkApplicationCode($request->applicationId);
		if($application){
			$invoice = InvoiceController::new(Auth::id(), $request->depositAmount, 'INITIAL_DEPOSIT');
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
		$invoice = InvoiceController::new(Auth::id(), $totalpayment, 'RENT');
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

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Payment',
			'message' => 'You have successfully received the payment through ' . $request->paymentChannel . '.',
			'alert' => 'success'
		]);
	}

	public static function getTotalPaymentByInvoice($invoiceId){
		return Payment::where('invoice_id', $invoiceId)->sum('payment_amount');
	}

	public static function getTotalRepayments($type = ''){
		$dateRange = FunctionController::getDateRange($type);
		$invoices = ($type != '') ? Invoice::whereBetween('created_at', [$dateRange->from, $dateRange->to]) : Invoice::all();
		return $invoices->where('invoice_type', 'RENT')->sum('invoice_amount');
	}

	public static function getOutstandingRent($limit = 50){
		$monthlyPlans = MonthlyPlan::where('due_date', '<=', date("Y-m-d"))->orderBy('created_at', 'desc')->get();
		$responseStr = array();
		//$total = count($monthlyPlans);
		$counter = 1;
		//$limit = ($total < $limit) ? $total : ;
		foreach($monthlyPlans as $monthlyPlan){
			if($counter >= $limit){
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

	public static function getNumberOfRents($type = ''){
		$dateRange = FunctionController::getDateRange($type);
		$monthlyPlans = ($type != '') ? MonthlyPlan::whereBetween('due_date', [$dateRange->from, $dateRange->to])->get() : MonthlyPlan::all();
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
		$paymentChannels = Payment::groupBy('payment_channel')->select('payment_channel', DB::raw('count(*) AS total'))->get();
		//dd($paymentChannels);
		$responseStr = array();
		foreach($paymentChannels as $paymentChannel){
			$responseStr[$paymentChannel->payment_channel] = $paymentChannel->total;
		}
		//dd($responseStr);
		return (object)$responseStr;
	}

	public static function getPaymentDetails($payment){
		$tempJSON = new stdClass();
		$invoice = Invoice::find($payment->id);
		$userData = InvoiceController::getInvoiceUserData($invoice, 'RENT');
		$applicationData = $userData->applicationData;
		$tempJSON->invoice_id = $payment->id;
		$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
		$tempJSON->payment_date = FunctionController::formatDate($payment->created_at);
		$tempJSON->payment_channel = $payment->payment_channel;
		$tempJSON->payment_amount = FunctionController::formatCurrencyView($payment->payment_amount);
		$tempJSON->payment_ref = $payment->payment_ref;
		return $tempJSON;
	}

	public static function getPayments($payments){
		$paymentStr = array();
		foreach($payments as $payment){
			$paymentStr[] = PaymentController::getPaymentDetails($payment);
		}
		return $paymentStr;
	}
}
