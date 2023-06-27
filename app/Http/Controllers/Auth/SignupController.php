<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Common\FunctionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\UsersController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
	protected function show(){
		return (Auth::user()) ? redirect()->route('dashboard') : view('signup');
	}

	protected function signup(Request $request){
		$validator = Validator::make($request->all(), [
			'phone' => 'required|integer',
			'countryCode' => 'required',
			'otp' => 'required|integer|min:100000|max:999999',
			'email' => 'required|email',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
		], [
			'phone.required' => 'Please enter your phone number',
			'otp.min' => 'Please enter 6 digits OTP',
			'otp.max' => 'Please enter 6 digits OTP',
			'email.required' => 'Please enter valid email address',
			'email.email' => 'Please enter valid email address',
			'password.confirmed' => 'Mismatch confirm password',
		]);

		if ($validator->fails()) {
			return back()
				->withInput()
				->withErrors($validator->messages());
		}

		if(UsersController::checkEmail($request->email)){
			return back()
				->withInput()
				->withErrors('Email address is already registerred.');
		}

		if(!OtpController::checkOTP($request->countryCode, $request->phone, $request->otp)){
			return back()
				->withInput()
				->withErrors('Invalid or expired OTP');
		}

		Users::create([
			'phone_number' => $request->phone,
			'country_code' => $request->countryCode,
			'email' => $request->email,
			'password' => $request->password
		]);

		$credentials = $request->only('email', 'password');
		Auth::attempt($credentials);
		$user = Auth::getProvider()->retrieveByCredentials($credentials);
		Auth::login($user);
		return redirect()->intended('dashboard');
		/* $request->session()->regenerate();
		return redirect()->route('dashboard'); */
	}

	protected function getOTP(Request $request){
		$validator = Validator::make($request->all(), [
			'countryCode' => 'required',
			'phone' => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'title' => 'Input Error',
				'errors' => $validator->messages(),
				'alert' => 'warning',
			], 200);
		}
		$otp = FunctionController::generateOTP();
		$otps = OtpController::new($request->countryCode, $request->phone, $otp);
		if($otps){
			$message = "Your one time password (OTP) is $otp to verify your mobile number at " . env('WEBSITE_TITLE') . ".";
			return FunctionController::sendSMS($request->countryCode, $request->phone, $message);
		}
		return response()->json([
			'title' => 'Send OTP',
			'success' => false,
			'error' => 'Unable to generate OTP.',
			'alert' => 'error',
		], 200);
	}
}
