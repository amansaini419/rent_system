<?php

namespace App\Http\Controllers;

use App\Models\ApplicationStatus;
use Illuminate\Http\Request;

class ApplicationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'application_id' => 'required|integer',
			'application_status' => 'required',
        ]);

        $applicationStatus = new ApplicationStatus;
        $applicationStatus->application_id = $request->application_id;
        $applicationStatus->application_status = $request->application_status;
        $applicationStatus->save();
		return $applicationStatus;
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplicationStatus $applicationStatus)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplicationStatus $applicationStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApplicationStatus $applicationStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationStatus $applicationStatus)
    {
        //
    }
}
