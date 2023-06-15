<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

	public static function getInvoices($invoices){
		$invoiceStr = array();
		foreach($invoices as $invoice){
			$applicationData = $invoice->user->applicationData;
			$tempJSON = new stdClass();
			$tempJSON->id = $invoice->id;
			$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
			$tempJSON->invoice_amount = FunctionController::formatCurrencyView($invoice->invoice_amount);
			$tempJSON->invoice_code = $invoice->invoice_code;
			$tempJSON->invoice_type = $invoice->invoice_type;
			$tempJSON->invoice_date = FunctionController::formatDate($invoice->created_at);
			$tempJSON->invoice_status = InvoiceController::checkInvoiceStatus($invoice);
			$invoiceStr[] = $tempJSON;

			/* $applicationData = $application->userData->applicationData;
			$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
			$tempJSON->application_type = $application->application_type;
			$tempJSON->application_code = $application->application_code;
			$currentApplicationStatus = $application->currentStatus->application_status;
			$tempJSON->application_status = $currentApplicationStatus;
			$tempJSON->initial_deposit = $application->initialDeposits->sum('invoice_amount');
			$tempJSON->subadmin_id = ($application->subadmin_id) == 0 ? 'NONE' : User::find($application->subadmin_id)->name;
			if($currentApplicationStatus == $status || $status == 'ALL'){
				$applicationStr[] = $tempJSON;
			} */
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
		return view('invoice.view');
	}
}
