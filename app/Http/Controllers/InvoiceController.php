<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Invoice;
use Illuminate\Http\Request;

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
}
