<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class SettingController extends Controller
{
	public static function getValue($setting)
	{
		return Setting::where('setting', $setting)->first()->value;
	}

	public static function getSettingDetails($setting){
		$tempJSON = new stdClass();
		$key = $setting->setting;
		$tempJSON->$key = $setting->value;
		return $tempJSON;
	}

	public static function getSettings($settings){
		$settingStr = array();
		foreach($settings as $setting){
			$settingStr[$setting->setting] = $setting->value;
		}
		return (object)$settingStr;
	}

	public static function getAllSettings(){
		return Setting::all();
	}

	protected function index(){
		$settings = SettingController::getAllSettings();
		return view('settings', ['settings' => SettingController::getSettings($settings)]);
	}

	public static function updateSetting($key, $value){
		Setting::where('setting', $key)->update(['value' => $value]);
	}

	protected function update(Request $request){
		$validator = Validator::make($request->all(), [
			'REGISTRATION_FEES' => 'required|integer',
			'FIRST_PENALTY_DAY' => 'required|integer',
			'FIRST_PENALTY_PER' => 'required|integer',
			'SECOND_PENALTY_DAY' => 'required|integer',
			'SECOND_PENALTY_PER' => 'required|integer',
			'OTP_EXPIRY_TIME' => 'required|integer',
			'TNC' => 'required',
		]);

		if ($validator->fails()) {
			return back()->with([
				'success' => false,
				'title' => 'Input Error',
				'errors' => $validator->messages(),
				'alert' => 'warning'
			]);
		}

		//SettingController::update('REGISTRATION_FEES', )
		//dd($request->request);
		foreach($request->request as $key => $value){
			if($key != "_token"){
				SettingController::updateSetting($key, e($value));
			}
		}

		return back()->with([
			'success' => true,
			'title' => 'Settings',
			'message' => 'Successfully updated the settings.',
			'alert' => 'success'
		]);
	}
}
