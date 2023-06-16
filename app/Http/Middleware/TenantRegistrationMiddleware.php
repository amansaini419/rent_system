<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationStatusController;
use App\Http\Controllers\UserDataController;
use App\Models\Application;
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
							$request->merge(['userData' => $userData]);
							return $next($request);
						} else {
							$applicationCode = $application->application_code;
						}
					}
					else{
						// create application status
						ApplicationStatusController::new($application->id, 'INCOMPLETE');
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
					ApplicationStatusController::new($application->id, 'INCOMPLETE');
				}
			} else {
				// create user data
				$userData = UserDataController::new(Auth::id());
				// create application
				$application = ApplicationController::new($userData->id, 'NEW');
				// create application status
				ApplicationStatusController::new($application->id, 'INCOMPLETE');
			}
		}
		return redirect()->route('application-register', ['id' => $applicationCode]);
	}
}
