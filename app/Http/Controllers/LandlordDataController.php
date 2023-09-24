<?php

namespace App\Http\Controllers;

use App\Models\LandlordData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LandlordDataController extends Controller
{
	public function update(Request $request){
		//var_dump($request->all);
		$validator = Validator::make($request->all(), [
			'userDataId' => 'required',
			'landlordName' => 'required',
			'countryCode' => 'required',
			'landlordNumber' => 'required|integer',
			'landlordAddress' => 'required',
			'landlordEmail' => 'required|email',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'errors' => $validator->messages()
			], 200);
		}
		//DB::enableQueryLog();
		$updated = LandlordData::where(DB::raw('md5(user_data_id)'), $request->userDataId)
			->update([
				'landlord_name' => $request->landlordName,
				'landlord_countrycode' => $request->countryCode,
				'landlord_number' => $request->landlordNumber,
				'landlord_address' => $request->landlordAddress,
				'landlord_email' => $request->landlordEmail,
				'is_filled' => 1,
			]);

		//dd(DB::getQueryLog());
		if($updated === 0){
			return response()->json([
				'success' => false,
				'error' => 'Unable to update the landlord data.'
			], 200);
		}
		return response()->json([
			'success' => true,
			'message' => 'Successfully updated the landlord data.'
		], 200);
	}
}
