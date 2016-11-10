<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Auth;

class MainController extends Controller
{
    public function login(Request $request)
    {	
    	$id = $request->input('id');

    	if($id == 1)
    	{	    	    
    		Auth::attempt(['email' => 'test@test.com', 'password' => 'parola']);
    	}
    	else if($id == 2)
    	{
    		Auth::attempt(['email' => 'pipos@pipos.com', 'password' => 'parola']);
    	}

    	return Response::json([], 200);
    }

    public function logout(Request $request)
    {
    	Auth::logout();

    	return redirect()->route('welcomePage');
    }

    public function viewPage(Request $request)
    {
        if(Auth::check())
            return redirect()->route('challengePage');

        return view('welcome');
    }
}
