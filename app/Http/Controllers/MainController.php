<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MainController extends Controller
{
    public function login1(Request $request)
    {
    	Auth::attempt(['email' => 'test@test.com', 'password' => 'parola']);

    	return redirect()->back();
    }

    public function login2(Request $request)
    {
    	Auth::attempt(['email' => 'pipos@pipos.com', 'password' => 'parola']);

    	return redirect()->back();
    }

    public function logout(Request $request)
    {
    	Auth::logout();

    	return redirect()->back();
    }
}
