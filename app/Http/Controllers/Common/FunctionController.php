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
		if($decimal == 0){
			return number_format($amount, $decimal);
		}
		return 'GHs ' . number_format($amount, $decimal);
	}

	public static function generateOTP($size = 6){
		return 123456;
		//return rand(pow(10, $size), (pow(10, $size+1) - 1));
	}

	public static function sendSMS($phone, $otp){
		return true;
	}

	public static function getDateRange($type){
		switch($type){
			case 'week':
				$from = Carbon::now()->startOfWeek(Carbon::MONDAY)->format("Y-m-d H:i:s");
				$to = Carbon::now()->endOfWeek(Carbon::SUNDAY)->format("Y-m-d H:i:s");
				break;
			case 'month':
				$from = Carbon::now()->startOfMonth()->format("Y-m-d H:i:s");
				$to = Carbon::now()->endOfMonth()->format("Y-m-d H:i:s");
				break;
			case 'quarter':
				$from = Carbon::now()->startOfQuarter()->format("Y-m-d H:i:s");
				$to = Carbon::now()->endOfQuarter()->format("Y-m-d H:i:s");
				break;
			case 'year':
				$from = Carbon::now()->startOfYear()->format("Y-m-d H:i:s");
				$to = Carbon::now()->endOfYear()->format("Y-m-d H:i:s");
				break;
			default:
				$from = $to = '';
		}
		return (object) array(
			'from' => $from,
			'to' => $to,
		);
	}
}
