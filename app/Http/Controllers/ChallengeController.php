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
    public function joinChallenge(Request $request)
    {
        //Updating an existing challenge or creating a new one
        $user = Auth::user();

        $challenge = Challenge::where('user1_id', '=', $user->id)->first();

        if($challenge == null){
            $challenge = Challenge::where('user2_id', '=', $user->id)->first();
        }

        if($challenge == null){
            $challenge = Challenge::where('state', '=', 1)->first();
            if($challenge == null){
                $challenge = new Challenge();
                $challenge->user1_id = $user->id;
                $challenge->state = 1;
                $challenge->save();
            } else{
                if($challenge->user2_id == null){
                    $challenge->user2_id = $user->id;
                    $challenge->state = 2;
                    $challenge->save();
                } else{
                    $challenge->user1_id = $user->id;
                    $challenge->state = 2;
                    $challenge->save();
                }
            }
            return redirect()->route('/');
        } else{
            return redirect()->back();
        }
    }

    public function viewPage(Request $request){
        return view('challenge');
    }
}
