<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Invoice;
use App\Models\RegistrationFee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrationFeeController extends Controller
{
	public static function new($userDataId, $invoiceId){
		return RegistrationFee::create([
			'user_data_id' => $userDataId,
			'invoice_id' => $invoiceId,
		]);
	}

	public static function getTotalFees($type = ''){
		$dateRange = FunctionController::getDateRange($type);
		$invoices = ($type != '') ? Invoice::whereBetween('created_at', [$dateRange->from, $dateRange->to]) : Invoice::all();
		return $invoices->where('invoice_type', 'REGISTRATION')->sum('invoice_amount');
	}
}
