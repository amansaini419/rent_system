<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use Illuminate\Http\Request;

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

	public static function getTotalApplicationByStatus($status = '', $type = ''){
		$dateRange = FunctionController::getDateRange($type);
		$invoices = ($type != '') ? ApplicationStatus::whereBetween('created_at', [$dateRange->from, $dateRange->to]) : ApplicationStatus::all();
		return ($status != '') ? $invoices->where('application_status', $status)->count() : Application::all()->count();
	}
}
