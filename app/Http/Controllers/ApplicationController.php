<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\AccomodationData;
use App\Models\Application;
use App\Models\ApplicationData;
use App\Models\DocumentData;
use App\Models\LandlordData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	protected function verifyTenantApplication($id){
		$application = ApplicationController::checkApplicationCode($id);
		return ($application && $application->userData && $application->userData->user && $application->userData->user->id == Auth::id()) ? true : false;
	}

	protected function showRegistrationForm($id){
		$application = ApplicationController::checkApplicationCode($id);
		if($this->verifyTenantApplication($id)){
			$userData = $application->userData;
			$applicationData = $userData->applicationData;
			if(!$applicationData){
				$applicationData = ApplicationData::create([ 'user_data_id' => $userData->id ]);
			}
			$accomodationData = $userData->accomodationData;
			if(!$accomodationData){
				$accomodationData = AccomodationData::create([ 'user_data_id' => $userData->id ]);
			}
			$documentData = $userData->documentData;
			if(!$documentData){
				$documentData = DocumentData::create([ 'user_data_id' => $userData->id ]);
			}
			$landlordData = $userData->landlordData;
			if(!$landlordData){
				$landlordData = LandlordData::create([ 'user_data_id' => $userData->id ]);
			}
			$fees = $userData->fees;
			$startIndex = 0;
			if($applicationData->is_filled){
				$startIndex = 1;
			}
			if($accomodationData->is_filled){
				$startIndex = 2;
			}
			if($documentData->is_filled && $fees){
				$startIndex = 3;
			}
			if($landlordData->is_filled){
				$startIndex = 4;
			}
			//var_dump($applicationData); die();
			return view('application.register', [
				'userDataId' => $userData->id,
				'startIndex' => $startIndex,
				'aaplicationCode' => $id,
				'fees' => $fees,
				'applicationData' => $applicationData,
				'accomodationData' => $accomodationData,
				'documentData' => $documentData,
				'landlordData' => $landlordData,
			]);
		}
		else{
			return redirect()->route('dashboard');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'user_data_id' => 'required|integer',
			'application_code' => 'required|unique:applications',
		]);
		$application = new Application;
		$application->user_data_id = $request->user_data_id;
		$application->application_type = $request->application_type;
		$application->application_code = $request->application_code;
		$application->save();
		return $application;
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Application $application)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Application $application)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Application $application)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Application $application)
	{
		//
	}

	public static function checkApplicationCode($code)
	{
		return Application::where('application_code', $code)->first();
	}

	public static function createApplicationCode($length = 10){
		$code = FunctionController::generateCode($length);
		if(!ApplicationController::checkApplicationCode($code)){
			return $code;
		}
		return ApplicationController::createApplicationCode();
	}
}
