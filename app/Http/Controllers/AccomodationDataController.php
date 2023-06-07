<?php

namespace App\Http\Controllers;

use App\Models\AccomodationData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccomodationDataController extends Controller
{
    public function update(Request $request){
		//var_dump($request->all);
		$validator = Validator::make($request->all(), [
			'userDataId' => 'required',
			'currentAccommodationStatus' => 'required',
			'propertyLocation' => 'required',
			'propertyType' => 'required',
			'monthlyRent' => 'required|decimal:0',
			'totalRentYears' => 'required|integer',
			'expectedMoveinDate' => 'required|date',
			'totalPaybackMonths' => 'required|integer',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'errors' => $validator->messages()
			], 200);
		}
		//DB::enableQueryLog();
		$updated = AccomodationData::where(DB::raw('md5(user_data_id)'), $request->userDataId)
			->update([
				'current_accommodation_status' => $request->currentAccommodationStatus,
				'property_location' => $request->propertyLocation,
				'property_type' => $request->propertyType,
				'monthly_rent' => $request->monthlyRent,
				'total_rent_years' => $request->totalRentYears,
				'expected_movein_date' => $request->expectedMoveinDate,
				'total_payback_months' => $request->totalPaybackMonths,
				'is_filled' => 1,
			]);

		//dd(DB::getQueryLog());
		if($updated === 0){
			return response()->json([
				'success' => false,
				'error' => 'Unable to update the accomodation data.'
			], 200);
		}
		return response()->json([
			'success' => true,
			'message' => 'Successfully updated the accomodation data.'
		], 200);
	}
}
