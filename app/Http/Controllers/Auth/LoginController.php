<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt(['email' => $input["email"], 'password' => $input["password"], 'is_active' => 1, 'is_deleted' => 0]))
        {
            return redirect()->route('dashboard');
        }
        else
        {
            return redirect()
                ->route('login')
                ->with('error', 'Incorrect email or password');
        }
    }
}
