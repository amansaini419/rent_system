<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($users_id)
    {
        return UserData::latest()->where('users_id', $users_id)->first();
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
        $userData = new UserData;
        $userData->users_id = $request->users_id;
        $userData->save();
        return $userData;
    }

    /**
     * Display the specified resource.
     */
    public function show(UserData $userData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserData $userData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserData $userData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserData $userData)
    {
        //
    }
}
