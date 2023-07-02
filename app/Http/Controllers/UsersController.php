<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class UsersController extends Controller
{
	public static function getStaff()
	{
		return Users::whereIn('user_type', ['STAFF', 'AGENT'])->where('is_active', 1)->where('is_deleted', 0)->get();
	}

	public static function getTenantDetails($tenant, $sn){
		$tenantName = "";
		//dd($tenant);
		$applicationData = $tenant->applicationData;
		if($applicationData){
			$tenantName = $applicationData->first_name;
		}
		$tempJSON = new stdClass();
		$tempJSON->sn = $sn;
		$tempJSON->id = $tenant->id;
		$tempJSON->email = $tenant->email;
		$tempJSON->phone_number = $tenant->phone_number;
		$tempJSON->tenant_name = $tenantName;
		return $tempJSON;
	}

	public static function getStaffAssignedTenants(){
		$tenants = array();
		if(Auth::user()->user_type == 'ADMIN'){
			$tenants = Users::where([
				'user_type' => 'TENANT',
				'is_active' => 1,
				'is_deleted' => 0,
			])->get();
		}
		else if(Auth::user()->user_type == 'AGENT' || Auth::user()->user_type == 'STAFF'){
			$tenants = Users::select('users.*')
				->join('user_data AS UD', 'UD.users_id', 'users.id')
				->join('applications AS A', 'A.user_data_id', 'UD.id')
				->where([
					'users.user_type' => 'TENANT',
					'A.subadmin_id' => Auth::id(),
					'users.is_active' => 1,
					'users.is_deleted' => 0,
				])
				->groupBy('users.id')
				->get();
			//dd($tenants);
		}
		return $tenants;
	}

	public static function getTenants(){
		$tenantStr = array();
		$tenants = UsersController::getStaffAssignedTenants();
		$sn = 1;
		foreach($tenants as $tenant){
			$tenantStr[] = UsersController::getTenantDetails($tenant, $sn++);
		}
		return $tenantStr;
	}

	protected function tenantIndex(){
		if(Auth::user()->user_type != 'TENANT'){
			return view('tenant.list', ['tenantStr' => UsersController::getTenants()]);
		}
		return to_route('dashboard');
	}

	protected function tenantView($id){
		if(Auth::user()->user_type != 'TENANT'){
			$tenant = Users::where([
				'id' => $id,
				'user_type' => 'TENANT',
				'is_active' => 1,
				'is_deleted' => 0,
			])->first();
			if(Auth::user()->user_type != 'ADMIN'){
				$tenant = Users::select('users.*')
				->join('user_data AS UD', 'UD.users_id', 'users.id')
				->join('applications AS A', 'A.user_data_id', 'UD.id')
				->where([
					'users.user_type' => 'TENANT',
					'A.subadmin_id' => Auth::id(),
					'users.is_active' => 1,
					'users.is_deleted' => 0,
					'users.id' => $id,
				])
				->groupBy('users.id')
				->first();
			}
			if($tenant != null){
				$allApplications = $tenant->allApplications;
				$applications = ApplicationController::getApplications($allApplications);
				$loans = LoanController::getLoans($allApplications);
				$tenantName = "";
				$applicationData = $tenant->applicationData;
				if($applicationData){
					$tenantName = $applicationData->first_name;
				}
				return view('tenant.view', [
					'tenant' => $tenant,
					'applications' => $applications,
					'loans' => $loans,
					'tenantName' => $tenantName,
				]);
			}
		}
		return to_route('dashboard');
	}

	public static function getSubadminDetails($subadmin, $sn = 0){
		$tempJSON = new stdClass();
		$tempJSON->sn = $sn;
		$tempJSON->id = $subadmin->id;
		$tempJSON->name = $subadmin->name;
		$tempJSON->email = $subadmin->email;
		$tempJSON->phone_number = $subadmin->phone_number;
		$tempJSON->user_type = $subadmin->user_type;
		return $tempJSON;
	}

	public static function getSubadmins($subadmins){
		$subadminStr = array();
		$sn = 1;
		foreach($subadmins as $subadmin){
			$subadminStr[] = UsersController::getSubadminDetails($subadmin, $sn++);
		}
		return $subadminStr;
	}

	protected function subadminIndex(){
		$subadmins = UsersController::getStaff();
		return view('subadmin.list', ['subadminStr' => UsersController::getSubadmins($subadmins)]);
	}

	protected function subadminView($id){
		$subadmin = UsersController::checkSubadmin($id);
		//dd($subadmin);
		if(!$subadmin){
			return redirect()->route('subadmin-list');
		}
		$applications = ApplicationController::getUserApplications($subadmin->user_type, $id);
		return view('subadmin.view', [
			'subadmin' => UsersController::getSubadminDetails($subadmin),
			'tenants' => '',
			'applications' => ApplicationController::getApplications($applications),
			'loans' => LoanController::getLoans($applications),
		]);
	}

	public static function checkSubadmin($id){
		return Users::whereIn('user_type', ['STAFF', 'AGENT'])->where([
			'id' => $id,
			'is_active' => 1,
			'is_deleted' => 0,
		])->first();
	}

	protected function subadminNew(Request $request){
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required',
			'name' => 'required',
			'type' => 'required',
			'phone' => 'required|integer',
		]);

		if ($validator->fails()) {
			return back()->with([
				'success' => false,
				'title' => 'Input Error',
				'errors' => $validator->messages(),
				'alert' => 'warning'
			]);
		}

		$subadmin = Users::create([
			'email' => $request->email,
			'password' => $request->password,
			'name' => $request->name,
			'phone_number' => $request->phone,
			'user_type' => $request->type,
		]);
		if($subadmin){
			return back()->with([
				'success' => true,
				'title' => 'New Subadmin',
				'message' => 'Successfully added new subadmin.',
				'alert' => 'success'
			]);
		}
		return back()->with([
			'success' => false,
			'title' => 'New Subadmin',
			'message' => 'Error coming in adding subadmin.',
			'alert' => 'error'
		]);
	}

	public static function checkEmail($email){
		return Users::where([
			'email' => $email,
			'is_active' => 1,
			'is_deleted' => 0
		])->first();
	}

	public function new(){
		return view('tenant.new');
	}

	public function register(Request $request){
		if(Auth::user()->user_type != "TENANT"){
			$validator = Validator::make($request->all(), [
				'phone' => 'required|integer',
				'countryCode' => 'required',
				'email' => 'required|email',
			], [
				'phone.required' => 'Please enter your phone number',
				'email.required' => 'Please enter valid email address',
				'email.email' => 'Please enter valid email address',
			]);

			if ($validator->fails()) {
				return back()
					->withInput()
					->withErrors($validator->messages());
			}

			if(UsersController::checkEmail($request->email)){
				return back()
					->withInput()
					->withErrors('Email address is already registerred.');
			}

			$password = FunctionController::generateCode(10);
			$tenant = Users::create([
				'phone_number' => $request->phone,
				'country_code' => $request->countryCode,
				'email' => $request->email,
				'password' => $password
			]);

			// send email

			// create user data
			$userData = UserDataController::new($tenant->id);
			// create application
			$subadminId = (Auth::user()->user_type == 'ADMIN') ? 0 : Auth::id();
			$application = ApplicationController::new($userData->id, 'NEW', $subadminId);
			// create application status
			ApplicationStatusController::new($application->id, 'INCOMPLETE');

			return to_route('application-edit', ['id' => $application->application_code]);
		}
	}
}
