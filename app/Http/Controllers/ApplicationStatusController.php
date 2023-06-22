<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationStatusController extends Controller
{
	public static function new($applicationId, $applicationStatus){
		return ApplicationStatus::create([
			'application_id' => $applicationId,
			'application_status' => $applicationStatus,
		]);
	}

	public static function getCurrentApplicationStatus($application){
		return ($application && $application->currentStatus) ? $application->currentStatus->application_status : "";
	}

	public static function getTotalApplicationByStatus($status = '', $type = '', $countFlag = 1){
		$dateRange = FunctionController::getDateRange($type);
		if(Auth::user()->user_type == 'ADMIN'){
			$applicationStatuses = ($type != '') ? ApplicationStatus::whereBetween('created_at', [$dateRange->from, $dateRange->to]) : ApplicationStatus::all();
			$applicationStatuses = ($status != '') ? $applicationStatuses->where('application_status', $status)->pluck('application_id') : Application::all();
		}
		elseif(Auth::user()->user_type == 'STAFF' || Auth::user()->user_type == 'AGENT'){
			$applicationIdStr = ApplicationController::getUserApplications(Auth::user()->user_type, Auth::id())->pluck('id');
			$applicationStatuses = ($type != '') ? ApplicationStatus::whereIn('application_id', $applicationIdStr)->whereBetween('created_at', [$dateRange->from, $dateRange->to]) : ApplicationStatus::whereIn('application_id', $applicationIdStr)->get();
			$applicationStatuses = ($status != '') ? $applicationStatuses->where('application_status', $status)->pluck('application_id') : $applicationIdStr;
		}
		return ($countFlag == 1) ? $applicationStatuses->count() : $applicationStatuses;
	}

	public static function getTotalApprovedApplicationGenderWise($approvedApplications){
		$maleCount = $femaleCount = 0;
		$applications = Application::whereIn('id', $approvedApplications)->get();
		//dd($applications);
		foreach($applications as $application){
			//dd($application);
			$applicationData = $application->applicationData;
			//echo $application->id;
			if($applicationData){
				//echo $applicationData->gender;
				if($applicationData->gender == "male"){
					$maleCount++;
				}
				elseif($applicationData->gender == "female"){
					$femaleCount++;
				}
			}
		}
		return (object)array(
			'male' => $maleCount,
			'female' => $femaleCount,
		);
	}

	public static function getTotalApplicationStatusWise($applications){
		$total = $approved = $rejected = $pending = 0;
		foreach($applications as $application){
			$total++;
			$applicationStatus = $application->currentStatus->application_status;
			if(in_array($applicationStatus, ['APPROVED', 'LOAN_STARTED', 'LOAN_CLOSED'])){
				$approved++;
			}
			elseif($applicationStatus == 'REJECTED'){
				$rejected++;
			}
			elseif(in_array($applicationStatus, ['INCOMPLETE', 'PENDING', 'UNDER_VERIFICATION', 'VERIFIED'])){
				$pending++;
			}
		}
		return (object)array(
			'total' => $total,
			'approved' => $approved,
			'rejected' => $rejected,
			'pending' => $pending,
		);
	}
}
