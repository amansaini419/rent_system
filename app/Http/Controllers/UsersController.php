<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public static function getStaff(){
        return Users::whereIn('user_type', ['STAFF', 'AGENT'])->where('is_active', 1)->where('is_deleted', 0)->get();
    }
}
