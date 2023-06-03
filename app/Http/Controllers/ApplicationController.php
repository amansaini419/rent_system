<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	protected function showRegistrationForm($id)
	{
		return view('application.register');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'user_data_id' => 'required|integer',
			'application_code' => 'required|unique:applications',
		]);
		$application = new Application;
		$application->user_data_id = $request->user_data_id;
		$application->application_type = $request->application_type;
		$application->application_code = $request->application_code;
		$application->save();
		return $application;
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Application $application)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Application $application)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Application $application)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Application $application)
	{
		//
	}

	public function checkApplicationCode($code)
	{
		return Application::where('application_code', $code)->first();
	}
}
