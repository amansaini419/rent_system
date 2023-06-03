<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
	public function generateCode($length = 10) {
		$permittedChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomCode = '';
		for ($i = 0; $i < $length; $i++) {
			$randomCode .= $permittedChars[mt_rand(0, $length - 1)];
		}
		return $randomCode;
	}

	public function createApplicationCode($length = 10){
		echo $code = $this->generateCode($length);
		$applicationObj = new ApplicationController();
		if(!$applicationObj->checkApplicationCode($code)){
			return $code;
		}
		return $this->createApplicationCode();
		/* $application = Application:: */
	}
}
