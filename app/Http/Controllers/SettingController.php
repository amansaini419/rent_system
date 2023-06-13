<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
	public static function getValue($setting)
	{
		return Setting::where('setting', $setting)->first()->value;
	}
}
