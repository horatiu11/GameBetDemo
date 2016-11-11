<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use App\User;
use App\Challenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ChallengeController extends Controller
{
    public function createChallenge(Request $request)
    {
        $user = Auth::user();

        $challengedUser = $request->input('id');

        $challenge = Challenge::firstOrNew(['user1_id' => $user->id,'user2_id' => $challengedUser, 'state' => 1]);

        if($challenge->save()) {
            return Response::json(['message' => 'Challenge Successful!'], 200);
        }
         else{
            return Response::json(['error' => 'Sorry, there was an error!'], 400);
        }
    }

    public function viewPage(Request $request){

        return view('challenge');
    }

    public function viewWait(Request $request){
        return view('wait');
    }
}
