<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use stdClass;

class UsersController extends Controller
{
	public static function getStaff()
	{
		return Users::whereIn('user_type', ['STAFF', 'AGENT'])->where('is_active', 1)->where('is_deleted', 0)->get();
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
			$tenantName = "";
			$applicationData = $tenant->applicationData;
			if($applicationData){
				$tenantName = $applicationData->first_name;
			}
			$tempJSON = new stdClass();
			$tempJSON->sn = $sn++;
			$tempJSON->id = $tenant->id;
			$tempJSON->email = $tenant->email;
			$tempJSON->phone_number = $tenant->phone_number;
			$tempJSON->tenant_name = $tenantName;
			$tenantStr[] = $tempJSON;
		}
		return $tenantStr;
	}

	protected function tenantIndex(){
		return view('tenant.list',['tenantStr' => UsersController::getTenants()]);
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
}
