<?php

namespace App\Http\Controllers;

use App\Models\ApplicationData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicationDataController extends Controller
{
	public function store(Request $request)
	{
		$validated = $request->validate([
			'user_data_id' => 'required|integer',
		]);
		$applicationData = new ApplicationData();
		$applicationData->user_data_id = $request->user_data_id;
		$applicationData->save();
		return $applicationData;
	}

	public function update(Request $request){
		//var_dump($request->all);
		$validator = Validator::make($request->all(), [
			'userDataId' => 'required',
			'firstName' => 'required',
			'surname' => 'required',
			'gender' => 'required',
			'dateOfBirth' => 'required|date',
			'maritalStatus' => 'required',
			'currentLocation' => 'required',
			'whatsappNumber' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'errors' => $validator->messages()
			], 200);
		}
		//DB::enableQueryLog();
		$updated = ApplicationData::where(DB::raw('md5(user_data_id)'), $request->userDataId)
			->update([
				'first_name' => $request->firstName,
				'surname' => $request->surname,
				'others_name' => $request->otherNames,
				'gender' => $request->gender,
				'date_of_birth' => $request->dateOfBirth,
				'marital_status' => $request->maritalStatus,
				'current_location' => $request->currentLocation,
				'whatsapp_number' => $request->whatsappNumber,
				'social_media_handles' => $request->socialMediaHandles,
				'employment_status' => $request->employmentStatus,
				'monthly_net_income' => $request->monthlyNetIncome,
				'company_name' => $request->companyName,
				'outstanding_loan' => $request->outstandingLoan,
				'emergency_contact_name' => $request->emergencyContactName,
				'emergency_contact_number' => $request->emergencyContactNumber,
				'emergency_contact_relation' => $request->emergencyContactRelation,
				'emergency_contact_location' => $request->emergencyContactLocation,
				'is_filled' => 1,
			]);

		//dd(DB::getQueryLog());
		if($updated === 0){
			return response()->json([
				'success' => false,
				'error' => 'Unable to update the application data.'
			], 200);
		}
		return response()->json([
			'success' => true,
			'message' => 'Successfully updated the application data.'
		], 200);
	}
}
