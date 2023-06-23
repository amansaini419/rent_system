<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Login\RememberMeExpiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use RememberMeExpiration;

    protected function show(){
        return (Auth::user()) ? redirect()->route('dashboard') : view('login');
    }

    protected function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials['is_active'] = 1;
        $credentials['is_deleted'] = 0;
        
        //dd(Auth::validate($credentials));
        
        if(!Auth::validate($credentials)){
            return redirect()
                ->route('login')
                ->withErrors(trans('auth.failed'));
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user, $request->get('remember'));
        if($request->get('remember')){
            $this->setRememberMeExpiration($user);
        }
        return redirect()->intended('dashboard');
    }

    protected function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
