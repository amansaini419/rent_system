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
		return view('signup');
	}

	protected function signup(Request $request){
		$validator = Validator::make($request->all(), [
			'phone' => 'required',
			'otp' => 'required|integer',
			'email' => 'required|email',
			'password' => 'required',
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

		if(!OtpController::checkOTP($request->phone, $request->otp)){
			return back()
				->withInput()
				->withErrors('Invalid or expired OTP');
		}

		Users::create([
			'phone_number' => $request->phone,
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

		$otp = OtpController::new($request->phone);
		if($otp){
			$message = "$otp is your one time password (OTP) to verify your mobile number at " . env('WEBSITE_TITLE') . ".";
			return FunctionController::sendSMS($request->phone, $message);
		}
		return response()->json([
			'title' => 'Send OTP',
			'success' => false,
			'error' => 'Unable to generate OTP.',
			'alert' => 'error',
		], 200);
	}
}
