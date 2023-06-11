<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\ApplicationData;
use App\Models\AccomodationData;
use App\Models\DocumentData;
use App\Models\LandlordData;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ApplicationController extends Controller
{
	protected static function getApplications($applications, String $status){
		$applicationStr = array();
		foreach($applications as $application){
			$tempJSON = new stdClass();
			$tempJSON->id = $application->id;
			$applicationData = $application->userData->applicationData;
			$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
			$tempJSON->application_type = $application->application_type;
			$tempJSON->application_code = $application->application_code;
			$currentApplicationStatus = $application->currentStatus->application_status;
			$tempJSON->application_status = $currentApplicationStatus;
			$tempJSON->initial_deposit = $application->initialDeposits->sum('invoice_amount');
			$tempJSON->subadmin_id = ($application->subadmin_id) == 0 ? 'NONE' : User::find($application->subadmin_id)->name;
			if($currentApplicationStatus == $status || $status == 'ALL'){
				$applicationStr[] = $tempJSON;
			}
		}
		return $applicationStr;
	}

	protected static function getTotalDeposit($application){
		return $application->initialDeposits->sum('invoice_amount');
	}

	protected static function getStaffAssigned($application){
		return ($application->subadmin_id == 0) ? 'NONE' : User::find($application->subadmin_id)->name;
	}
	
	protected function index(Request $request, string $status = 'ALL'){
		$applicationStr = array();
		if(Auth::user()->user_type == "TENANT"){
			$applications = Auth::user()->applications;
			foreach($applications as $application){
				$tempJSON = new stdClass();
				$tempJSON->id = $application->id;
				$tempJSON->application_type = $application->application_type;
				$tempJSON->application_code = $application->application_code;
				$tempJSON->application_status = $application->currentStatus->application_status;
				$tempJSON->initial_deposit = ApplicationController::getTotalDeposit($application);
				$tempJSON->subadmin_id = ApplicationController::getStaffAssigned($application);
				$tempJSON->user_data_id = $application->user_data_id;

				$applicationStr[] = $tempJSON;
			}
		}
		elseif(Auth::user()->user_type == "ADMIN"){
			$applications = Application::orderBy('id', 'desc')->get();
			$applicationStr = ApplicationController::getApplications($applications, $status);
		}
		elseif(Auth::user()->user_type == "STAFF" || Auth::user()->user_type == "AGENT"){
			$applications = Application::where('subadmin_id', Auth::id())->orderBy('id', 'desc')->get();
			$applicationStr = ApplicationController::getApplications($applications, $status);
		}

		return view('application.list', [
			'applicationStr' => $applicationStr,
		]);
	}

	protected function viewApplication(string $id){
		$application = ApplicationController::checkApplicationCode($id);
		if(Auth::user()->user_type == "ADMIN" || $application->subadmin_id == Auth::id()){
			$userData = $application->userData;
			//echo($application->currentStatus->application_status);
			return view('application.view',[
				'application' => $application,
				'allStaff' => UsersController::getStaff(),
				'applicationStatus' => $application->currentStatus->application_status,
				'tenant' => $userData->user,
				'initialDeposit' => ApplicationController::getTotalDeposit($application),
				'staffAssigned' => ApplicationController::getStaffAssigned($application),
				'applicationData' => $userData->applicationData,
				'accomodationData' => $userData->accomodationData,
				'documentData' => $userData->documentData,
				'landlordData' => $userData->landlordData,
			]);
		}
		return redirect()->route('dashboard');
	}

	protected function assignStaff(Request $request){
		if(Auth::user()->user_type == "ADMIN"){
			//dd($request->all());
			$validator = Validator::make($request->all(), [
				'applicationId' => 'required|integer',
				'staffId' => 'required|integer',
			]);

			if ($validator->fails()) {
				return back()->with([
					'success' => false,
					'title' => 'Input Error',
					'errors' => $validator->messages(),
					'alert' => 'warning'
				]);
			}
			$application = Application::find($request->applicationId);
			if(!$application){
				return back()->with([
					'success' => false,
					'title' => 'Error',
					'error' => 'Wrong application.',
					'alert' => 'error'
				]);
			}
			$currentApplicationStatus = $application->currentStatus->application_status;
			if($currentApplicationStatus === 'PENDING'){
				if($application->subadmin_id == 0){
					$updated = $application->update(['subadmin_id' => $request->staffId]);
					if($updated === 0){
						return back()->with([
							'success' => false,
							'title' => 'Error',
							'error' => 'Unable to assign staff.',
							'alert' => 'error'
						]);
					}
				}
				// create application status
				ApplicationStatus::create([
					'application_id' => $application->id,
					'application_status' => 'UNDER_VERIFICATION',
				]);
			}

			return redirect()->back()->with([
				'success' => true,
				'title' => 'Staff Assigned',
				'message' => 'You have successfully assigned the staff.',
				'alert' => 'success'
			]);
		}
	}

	protected function sendForApproval(Request $request){
		if(Auth::user()->user_type == "STAFF" || Auth::user()->user_type == "AGENT"){
			$validator = Validator::make($request->all(), [
				'applicationId' => 'required|integer',
				'applicationRemark' => 'required',
			]);

			if ($validator->fails()) {
				return back()->with([
					'success' => false,
					'title' => 'Input Error',
					'errors' => $validator->messages(),
					'alert' => 'warning'
				]);
			}
			$application = Application::find($request->applicationId);
			if(!$application){
				return back()->with([
					'success' => false,
					'title' => 'Error',
					'error' => 'Wrong application.',
					'alert' => 'error'
				]);
			}
			$currentApplicationStatus = $application->currentStatus->application_status;
			if($currentApplicationStatus === 'UNDER_VERIFICATION'){
				$updated = $application->update(['application_remark' => $request->applicationRemark]);
				if($updated === 0){
					return back()->with([
						'success' => false,
						'title' => 'Error',
						'error' => 'Unable to update remark.',
						'alert' => 'error'
					]);
				}
				// create application status
				ApplicationStatus::create([
					'application_id' => $application->id,
					'application_status' => 'VERIFIED',
				]);
			}

			return redirect()->back()->with([
				'success' => true,
				'title' => 'Application Verified',
				'message' => 'You have successfully send the application to ADMIN for approval.',
				'alert' => 'success'
			]);
		}
	}

	protected function reject(Request $request){
		if(Auth::user()->user_type == "ADMIN"){
			$validator = Validator::make($request->all(), [
				'applicationId' => 'required|integer',
				'adminRemark' => 'required',
			]);

			if ($validator->fails()) {
				return back()->with([
					'success' => false,
					'title' => 'Input Error',
					'errors' => $validator->messages(),
					'alert' => 'warning'
				]);
			}
			$application = Application::find($request->applicationId);
			if(!$application){
				return back()->with([
					'success' => false,
					'title' => 'Error',
					'error' => 'Wrong application.',
					'alert' => 'error'
				]);
			}
			$currentApplicationStatus = $application->currentStatus->application_status;
			if($currentApplicationStatus === 'VERIFIED'){
				$updated = $application->update(['admin_remark' => $request->adminRemark]);
				if($updated === 0){
					return back()->with([
						'success' => false,
						'title' => 'Error',
						'error' => 'Unable to reject application.',
						'alert' => 'error'
					]);
				}
				// create application status
				ApplicationStatus::create([
					'application_id' => $application->id,
					'application_status' => 'REJECTED',
				]);
			}

			return redirect()->back()->with([
				'success' => true,
				'title' => 'Application Rejected',
				'message' => 'You have successfully rejected the application.',
				'alert' => 'success'
			]);
		}
	}

	protected function approve(Request $request){
		if(Auth::user()->user_type == "ADMIN"){
			$validator = Validator::make($request->all(), [
				'applicationId' => 'required|integer',
				'adminRemark' => 'required',
			]);

			if ($validator->fails()) {
				return back()->with([
					'success' => false,
					'title' => 'Input Error',
					'errors' => $validator->messages(),
					'alert' => 'warning'
				]);
			}
			$application = Application::find($request->applicationId);
			if(!$application){
				return back()->with([
					'success' => false,
					'title' => 'Error',
					'error' => 'Wrong application.',
					'alert' => 'error'
				]);
			}
			$currentApplicationStatus = $application->currentStatus->application_status;
			if($currentApplicationStatus === 'VERIFIED'){
				$updated = $application->update(['admin_remark' => $request->adminRemark]);
				if($updated === 0){
					return back()->with([
						'success' => false,
						'title' => 'Error',
						'error' => 'Unable to approve application.',
						'alert' => 'error'
					]);
				}
				// create application status
				ApplicationStatus::create([
					'application_id' => $application->id,
					'application_status' => 'APPROVED',
				]);
			}

			return redirect()->back()->with([
				'success' => true,
				'title' => 'Application Approved',
				'message' => 'You have successfully approved the application.',
				'alert' => 'success'
			]);
		}
	}

	protected function monthlyPlan(Request $request){
		// check loan is created on this application or not
		// create loan
		// create monthly plan
		// create LOAN_STARTED status
	}

	protected function verifyTenantApplication(string $id){
		$application = ApplicationController::checkApplicationCode($id);
		return ($application && $application->userData && $application->userData->user && $application->userData->user->id == Auth::id()) ? true : false;
	}

	protected function showRegistrationForm(string $id){
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
			if($applicationData->is_filled && $accomodationData->is_filled && $documentData->is_filled && $fees && $landlordData->is_filled){
				$applicationStatus = $application->currentStatus;
				if ($applicationStatus->application_status == "INCOMPLETE") {
					// create application status pending
					$applicationStatus = ApplicationStatus::create([
						'application_id' => $application->id,
						'application_status' => 'PENDING',
					]);
					//dd($applicationStatus);
				}
				return redirect()->route('application-list');
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

	public static function checkApplicationCode(string $code){
		return Application::where('application_code', $code)->first();
	}

	public static function createApplicationCode(int $length = 10){
		$code = FunctionController::generateCode($length);
		if(!ApplicationController::checkApplicationCode($code)){
			return $code;
		}
		return ApplicationController::createApplicationCode();
	}
}
