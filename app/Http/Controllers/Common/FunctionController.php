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

	public static function formatRentMonth($date){
		return Carbon::parse($date)->format('M-Y');
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
		//return 123456;
		return rand(pow(10, $size), (pow(10, $size+1) - 1));
	}

	public static function sendSMS($phone, $message){
		//return true;
		// https://smsc.hubtel.com/v1/messages/send?clientsecret=dcbjseub&clientid=datphoqy&from=TechMinds&to=233202997676&content=This+Is+A+Test+Message
		$query = array(
			"clientid" => env('HUBTEL_CLIENT_ID'),
			"clientsecret" => env('HUBTEL_CLIENT_SECRET'),
			"from" => env('HUBTEL_SENDER_NICKNAME'),
			"to" => "233" . $phone,
			"content" => $message
		);
		
		$curl = curl_init();
		
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://devp-sms03726-api.hubtel.com/v1/messages/send?" . http_build_query($query),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "GET",
		]);
		
		$response = curl_exec($curl);
		$error = curl_error($curl);
		
		curl_close($curl);
		
		if ($error) {
			//echo "cURL Error #:" . $error;
			return response()->json([
				'title' => 'Send OTP',
				'success' => false,
				'message' => $error,
				'alert' => 'warning',
			], 200);
		} /* else {
			echo $response;
		} */
		return response()->json([
			'title' => 'Send OTP',
			'success' => true,
			'message' => 'Please check your mobile number for the OTP.',
			'alert' => 'success',
		], 200);
	}

	public static function getDateRange($type){
		switch($type){
			case 'today':
				$from = Carbon::now()->startOfDay()->format("Y-m-d H:i:s");
				$to = Carbon::now()->endOfDay()->format("Y-m-d H:i:s");
				break;
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
