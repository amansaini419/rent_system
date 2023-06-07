<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Application;
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
}
