<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OtpController extends Controller
{
	public static function new($countryCode, $phone, $otp){
		return Otp::create([
			'country_code' => $countryCode,
			'phone_number' => $phone,
			'otp' => $otp,
		]);
	}

	public static function checkOTP($countryCode, $phone, $otp){
		$otpStr = Otp::where([
			'country_code' => $countryCode,
			'phone_number' => $phone,
			'otp' => $otp,
		])->latest()->first();
		//dd(Carbon::parse($otpStr->created_at)->diffInMinutes(Carbon::now(), false));
		return ( $otpStr && ( Carbon::parse($otpStr->created_at)->diffInMinutes(Carbon::now(), false) <= SettingController::getValue('OTP_EXPIRY_TIME') ) ) ? true : false;
	}
}
