<?php

namespace App\Http\Controllers;

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
}
