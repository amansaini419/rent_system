<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
	public static function new($usersId){
		return UserData::create([
			'users_id' => $usersId,
		]);
	}
}
