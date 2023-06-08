<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Common\FunctionController;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\UserData;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantRegistrationMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		if (Auth::check() && Auth::user()->user_type != "TENANT") {
			return $next($request);
		} elseif (Auth::user()->user_type == "TENANT") {
			$userData = Auth::user()->userData;
			//var_dump($userData);
			if ($userData) {
				$application = $userData->application;
				//var_dump($application); die();
				if ($application) {
					$applicationStatus = $application->currentStatus;
					//dd($applicationStatus);
					if($applicationStatus){
						//dd($applicationStatus->application_status);
						if ($applicationStatus->application_status != "INCOMPLETE") {
							return $next($request);
						} else {
							$applicationCode = $application->application_code;
						}
					}
					else{
						// create application status
						ApplicationStatus::create([
							'application_id' => $application->id,
							'application_status' => 'INCOMPLETE',
						]);
						$applicationCode = $application->application_code;
					}
				} else {
					// create application
					$applicationCode = ApplicationController::createApplicationCode();
					$application = Application::create([
						'user_data_id' => $userData->id,
						'application_type' => 'NEW',
						'application_code' => $applicationCode,
					]);
					// create application status
					ApplicationStatus::create([
						'application_id' => $application->id,
						'application_status' => 'INCOMPLETE',
					]);
				}
			} else {
				// create user data
				$userData = UserData::create([
					'users_id' => Auth::id(),
				]);
				// create application data, accomodation data, document data, landlord data
				// create application
				$applicationCode = ApplicationController::createApplicationCode();
				$application = Application::create([
					'user_data_id' => $userData->id,
					'application_type' => 'NEW',
					'application_code' => $applicationCode,
				]);
				// create application status
				ApplicationStatus::create([
					'application_id' => $application->id,
					'application_status' => 'INCOMPLETE',
				]);
			}
		}
		return redirect()->route('application-register', ['id' => $applicationCode]);
	}
}
