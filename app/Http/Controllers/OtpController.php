<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OtpController extends Controller
{
	public static function new($phone)
	{
		$otp = FunctionController::generateOTP();
		if(FunctionController::sendSMS($phone, $otp)){
			return Otp::create([
				'phone_number' => $phone,
				'otp' => FunctionController::generateOTP(),
			]);
		}
		return false;
	}

	public static function checkOTP($phone, $otp){
		$otpStr = Otp::where([
			'phone_number' => $phone,
			'otp' => $otp,
		])->orderBy('created_at', 'desc')->first();
		//dd(Carbon::parse($otpStr->created_at)->diffInMinutes(Carbon::now(), false));
		return ( $otpStr && ( Carbon::parse($otpStr->created_at)->diffInMinutes(Carbon::now(), false) <= SettingController::getValue('OTP_EXPIRY_TIME') ) ) ? true : false;
	}
}
