<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use App\User;
use Carbon\Carbon;
use App\Challenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ChallengeController extends Controller
{
    public function createChallenge(Request $request)
    {
        //Take user and find its challenge
        $user = Auth::user();

        $challengedUser = $request->input('id');

        $challenge = Challenge::firstOrNew(['user1_id' => $user->id,'user2_id' => $challengedUser, 'state' => 1]);

        //Create a new challenge if needed
        if($challenge->save()) {
            return Response::json(['message' => 'Challenge Successful!'], 200);
        }
         else{
            return Response::json(['error' => 'Sorry, there was an error!'], 400);
        }
    }

    public function acceptChallenge(Request $request)
    {
        //Take user and find the challenge
        $user = Auth::user();
        $decision = $request->input('decision');

        $challenge = Challenge::where('user2_id', '=', $user->id)->where('state', '=', 1)->first();

        //If no challenge, redirect
        if($challenge == null)
            return redirect()->route('challengePage');

        if($decision == 0){
            $challenge->delete();
            return redirect()->route('challengePage');
        }

        $challenge->state = $decision;

        if($challenge->save()) {
            return Response::json(['message' => 'Challenge Successful!'], 200);
        }
         else{
            return Response::json(['error' => 'Sorry, there was an error!'], 400);
        }
    }

    public function viewPage(Request $request){
        //return the challenge page
        $user = Auth::user();

        $challenge = Challenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->first();

        return view('challenge', ['challenge' => $challenge]);
    }

    public function viewWait(Request $request){
        //return waiting page
        $user = Auth::user();

        $challenge = Challenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->first();
        //redirects if needed
        if($challenge == null)
            return redirect()->route('challengePage');
        if($challenge->state == 3 && ( ($challenge->user1_outcome != '' && $challenge->user1_id == $user->id) || ($challenge->user2_outcome != '' && $challenge->user2_id == $user->id)))
        return redirect()->route('outcomePage');

        return view('wait', ['challenge' => $challenge]);
    }

    public function postOutcome(Request $request)
    {

        $outcome = $request->input('outcome');
        $result = 'lost';
        if($outcome == 1)
            $result = 'won';

        $user = Auth::user();

        $challenge1 = Challenge::where('user1_id', '=', $user->id)->where('state', '>', 1)->first();
        $challenge2 = Challenge::where('user2_id', '=', $user->id)->where('state', '>', 1)->first();
        //submit the choice of outcome
        if($challenge1 != null){
            $challenge1->state = 3;
            $challenge1->user1_outcome = $result;

            if($challenge1->user2_outcome != '')
                $challenge1->ended_at = Carbon::now();

            if($challenge1->save()) {
            return Response::json(['message' => 'Challenge Successful!'], 200);
            }
            else{
                return Response::json(['error' => 'Sorry, there was an error!'], 400);
            }
        } else if($challenge2 != null){
            $challenge2->state = 3;
            $challenge2->user2_outcome = $result;

            if($challenge2->user1_outcome != '')
                $challenge2->ended_at = Carbon::now();

            if($challenge2->save()) {
                return Response::json(['message' => 'Challenge Successful!'], 200);
            }
            else{
                return Response::json(['error' => 'Sorry, there was an error!'], 400);
            }
        }
        return redirect()->route('waitPage');
    }

    public function viewOutcome(Request $request)
    {
        //return the outcome view
        $user = Auth::user();

        $challenge = Challenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->first();
        //redirects if needed
        if($challenge == null)
            return redirect()->route('challengePage');
        if($challenge->state < 3)
            return redirect()->route('waitPage');

        if($challenge->state == 3 && ( ($challenge->user1_outcome == '' && $challenge->user1_id == $user->id) || ($challenge->user2_outcome == '' && $challenge->user2_id == $user->id)))
            return redirect()->route('waitPage');

        return view('outcome', ['challenge' => $challenge]);
    }
}
