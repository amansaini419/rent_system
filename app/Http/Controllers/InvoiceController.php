<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class InvoiceController extends Controller
{
	public static function checkInvoiceCode($code)
	{
		return Invoice::where('invoice_code', $code)->first();
	}

	public static function createInvoiceCode($length = 10)
	{
		$code = FunctionController::generateCode($length);
		if (!InvoiceController::checkInvoiceCode($code)) {
			return $code;
		}
		return InvoiceController::createInvoiceCode();
	}

	public static function new($userId, $invoiceAmount, $invoiceType){
		return Invoice::create([
			'users_id' => $userId,
			'invoice_amount' => $invoiceAmount,
			'invoice_type' => $invoiceType,
			'invoice_code' => InvoiceController::createInvoiceCode(),
		]);
	}

	public static function checkInvoiceStatus($invoice){
		return (PaymentController::getTotalPaymentByInvoice($invoice->id) >= $invoice->invoice_amount) ? "PAID" : "PENDING";
	}

	public static function getInvoiceDetails($invoice){
		//DB::enableQueryLog();
		if($invoice->invoice_type == "RENT"){
			$userData = $invoice->loan->userData;
		}
		elseif($invoice->invoice_type == "REGISTRATION"){
			$userData = $invoice->userData;
		}
		elseif($invoice->invoice_type == "INITIAL_DEPOSIT"){
			$userData = $invoice->application->userData;
			//dd(DB::getQueryLog());
		}
		//dd(DB::getQueryLog());
		//echo json_encode($applicationData);
		//echo "<br>";
		$applicationData = $userData->applicationData;
		$tempJSON = new stdClass();
		$tempJSON->id = $invoice->id;
		$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
		$tempJSON->invoice_amount = FunctionController::formatCurrencyView($invoice->invoice_amount);
		$tempJSON->invoice_code = $invoice->invoice_code;
		$tempJSON->invoice_type = $invoice->invoice_type;
		$tempJSON->invoice_date = FunctionController::formatDate($invoice->created_at);
		$tempJSON->invoice_status = InvoiceController::checkInvoiceStatus($invoice);
		return $tempJSON;
	}

	public static function getInvoices($invoices){
		$invoiceStr = array();
		foreach($invoices as $invoice){
			$invoiceStr[] = InvoiceController::getInvoiceDetails($invoice);
		}
		return $invoiceStr;
	}

	public static function getUserInvoices(){
		if(Auth::user()->user_type == "TENANT"){
			$invoices = Auth::user()->invoices;
		}
		elseif(Auth::user()->user_type == "ADMIN"){
			$invoices = Invoice::latest()->get();
			//dd($invoices);
		}
		elseif(Auth::user()->user_type == "STAFF" || Auth::user()->user_type == "AGENT"){
			$applications = ApplicationController::getUserApplications();
			$userIds = array();
			foreach($applications as $application){
				$userData = $application->userData;
				if($userData){
					$userIds[] = $userData->users_id;
				}
			}
			$invoices = Invoice::whereIn('users_id', $userIds)->latest()->get();
		}
		return $invoices;
	}

	protected function index(){
		$invoices = InvoiceController::getUserInvoices();
		return view('invoice.list', [
			'invoiceStr' => InvoiceController::getInvoices($invoices)
		]);
	}

	protected function view(string $id){
		$invoice = InvoiceController::checkInvoiceCode($id);
		return view('invoice.view', [
			'invoice' => InvoiceController::getInvoiceDetails($invoice),
			'payments' => $invoice->payments,
		]);
	}
}
