<?php

namespace App\Http\Controllers;

use App\Models\RegistrationFee;
use Illuminate\Http\Request;

class RegistrationFeeController extends Controller
{
	public static function new($userDataId, $invoiceId){
		return RegistrationFee::create([
			'user_data_id' => $userDataId,
			'invoice_id' => $invoiceId,
		]);
	}
}
