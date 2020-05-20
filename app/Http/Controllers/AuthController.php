<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login() 
    {
        return view('auths.login');
        
    }

    public function postLogin(Request $request) 
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboards');
            $request->session()->regenerate();
        } else {
            return redirect('/login');
        }
        $request->session()->regenerate();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
