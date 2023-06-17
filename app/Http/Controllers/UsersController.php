<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
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

	public static function getTenants(){
		$tenantStr = array();
		$tenants = Users::where([
			'user_type' => 'TENANT',
			'is_active' => 1,
			'is_deleted' => 0,
		])->get();
		$sn = 1;
		foreach($tenants as $tenant){
			$tenantStr[] = UsersController::getTenantDetails($tenant, $sn++);
		}
		return $tenantStr;
	}

	protected function tenantIndex(){
		return view('tenant.list', ['tenantStr' => UsersController::getTenants()]);
	}

	protected function tenantView($id){
		$tenant = Users::where([
			'id' => $id,
			'user_type' => 'TENANT',
			'is_active' => 1,
			'is_deleted' => 0,
		])->first();
		//dd($tenant);
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
}
