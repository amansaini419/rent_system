<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
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
	public static function new($userDataid, $applicationType){
		return Application::create([
			'user_data_id' => $userDataid,
			'application_type' => $applicationType,
			'application_code' => ApplicationController::createApplicationCode(),
		]);
	}

	public static function getApplicationDetails($application){
		$tempJSON = new stdClass();
		$tempJSON->id = $application->id;
		$applicationData = $application->userData->applicationData;
		$tempJSON->tenant_name = $applicationData->first_name . ' ' . $applicationData->surname;
		$tempJSON->application_type = $application->application_type;
		$tempJSON->application_code = $application->application_code;
		$tempJSON->application_remark = $application->application_remark;
		$tempJSON->admin_remark = $application->admin_remark;
		$tempJSON->application_status = ApplicationStatusController::getCurrentApplicationStatus($application);
		$tempJSON->initial_deposit = $application->initialDeposits->sum('invoice_amount');
		$tempJSON->subadmin_id = ($application->subadmin_id) == 0 ? 'NONE' : User::find($application->subadmin_id)->name;
		return $tempJSON;
	}

	public static function getApplications($applications, String $status = 'ALL'){
		$applicationStr = array();
		foreach($applications as $application){
			if(ApplicationStatusController::getCurrentApplicationStatus($application) == $status || $status == 'ALL'){
				$applicationStr[] = ApplicationController::getApplicationDetails($application);
			}
		}
		return $applicationStr;
	}

	public static function getTotalDeposit($application){
		return $application->initialDeposits->sum('invoice_amount');
	}

	protected static function getStaffAssigned($application){
		return ($application->subadmin_id == 0) ? 'NONE' : User::find($application->subadmin_id)->name;
	}

	public static function getUserApplications($userType, $userId = 0){
		if($userType == "TENANT"){
			$applications = Auth::user()->applications;
		}
		elseif($userType == "ADMIN"){
			$applications = Application::orderBy('id', 'desc')->get();
		}
		elseif($userType == "STAFF" || $userType == "AGENT"){
			$applications = Application::where('subadmin_id', $userId)->orderBy('id', 'desc')->get();
		}
		return $applications;
	}

	protected function reapply(Request $request){
		$validator = Validator::make($request->all(), [
			'applicationType' => 'required',
		]);
		if ($validator->fails()) {
			return back()->with([
				'success' => false,
				'title' => 'Input Error',
				'errors' => $validator->messages(),
				'alert' => 'warning'
			]);
		}
		$latestApplication = Auth::user()->latestApplications->first();
		if(ApplicationStatusController::getCurrentApplicationStatus($latestApplication) != "LOAN_CLOSED"){
			return back()->with([
				'success' => false,
				'title' => 'Reapply Error',
				'error' => 'Invalid reapply application.',
				'alert' => 'error'
			]);
		}
		
		if($request->applicationType == "NEW"){
			// create new data id
			$userData = UserDataController::new(Auth::id());
			// create application record
			$application = ApplicationController::new($userData->id, 'NEW');
			// create application status
			ApplicationStatusController::new($application->id, 'INCOMPLETE');
		}
		elseif($request->applicationType == "RENEW"){
			// get old userdata
			$userData = Auth::user()->userData;
			// create application record
			$application = ApplicationController::new($userData->id, 'RENEW');
			// create application status
			ApplicationStatusController::new($application->id, 'PENDING');
		}
		

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Reaaply Application',
			'message' => 'You have successfully reapply for the application.',
			'alert' => 'success'
		]);
	}
	
	protected function index(string $status = 'ALL'){
		$latestApplication = Auth::user()->latestApplications->first();
		$applications = ApplicationController::getUserApplications(Auth::user()->user_type, Auth::id());
		return view('application.list', [
			'applicationStr' => ApplicationController::getApplications($applications, $status),
			'latestApplicationStatus' => ApplicationStatusController::getCurrentApplicationStatus($latestApplication),
		]);
	}

	protected function view(string $id){
		$application = ApplicationController::checkApplicationCode($id);
		if(Auth::user()->user_type == "ADMIN" || $application->subadmin_id == Auth::id()){
			$userData = $application->userData;
			//echo($application->currentStatus->application_status);
			return view('application.view',[
				'application' => ApplicationController::getApplicationDetails($application),
				'allStaff' => UsersController::getStaff(),
				'tenant' => $userData->user,
				'applicationData' => $userData->applicationData,
				'accomodationData' => $userData->accomodationData,
				'documentData' => $userData->documentData,
				'landlordData' => $userData->landlordData,
			]);
		}
		return redirect()->route('dashboard');
	}

	protected function assignStaff(Request $request){
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
		if(ApplicationStatusController::getCurrentApplicationStatus($application) === 'PENDING'){
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
			ApplicationStatusController::new($application->id, 'UNDER_VERIFICATION');
		}

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Staff Assigned',
			'message' => 'You have successfully assigned the staff.',
			'alert' => 'success'
		]);
	}

	protected function sendForApproval(Request $request){
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
		if(ApplicationStatusController::getCurrentApplicationStatus($application) === 'UNDER_VERIFICATION'){
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
			ApplicationStatusController::new($application->id, 'VERIFIED');
		}

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Application Verified',
			'message' => 'You have successfully send the application to ADMIN for approval.',
			'alert' => 'success'
		]);
	}

	protected function reject(Request $request){
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
		if(ApplicationStatusController::getCurrentApplicationStatus($application) === 'VERIFIED'){
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
			ApplicationStatusController::new($application->id, 'REJECTED');
		}

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Application Rejected',
			'message' => 'You have successfully rejected the application.',
			'alert' => 'success'
		]);
	}

	protected function approve(Request $request){
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
		if(ApplicationStatusController::getCurrentApplicationStatus($application) === 'VERIFIED'){
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
			ApplicationStatusController::new($application->id, 'APPROVED');
		}

		return redirect()->back()->with([
			'success' => true,
			'title' => 'Application Approved',
			'message' => 'You have successfully approved the application.',
			'alert' => 'success'
		]);
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
					ApplicationStatusController::new($application->id, 'PENDING');
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
