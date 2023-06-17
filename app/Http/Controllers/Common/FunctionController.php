<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
	public static function generateCode($length = 10) {
		$permittedChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomCode = '';
		for ($i = 0; $i < $length; $i++) {
			$randomCode .= $permittedChars[mt_rand(0, $length - 1)];
		}
		return $randomCode;
	}

	public static function formatDate($date){
		return Carbon::parse($date)->format('d-M-Y');
	}

	public static function formatCurrency($amount, $decimal = 2){
		return round($amount, $decimal);
	}

	public static function formatCurrencyView($amount, $decimal = 2){
		return number_format($amount, $decimal);
	}

	public static function generateOTP($size = 6){
		return 123456;
		//return rand(pow(10, $size), (pow(10, $size+1) - 1));
	}

	public static function sendSMS($phone, $otp){
		return true;
	}
}
