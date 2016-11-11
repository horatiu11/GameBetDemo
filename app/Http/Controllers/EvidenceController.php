<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use App\User;
use Carbon\Carbon;
use App\Challenge;
use App\FinishedChallenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EvidenceController extends Controller
{

    public function viewPage(Request $request)
    {
        $user = Auth::user();

        $challenge = Challenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->first();
        $fc = FinishedChallenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->orderBy('ended_at', 'desc')->first();
        if($challenge == null && $fc != null)
            return view('evidence');
        if($challenge == null)
            return redirect()->route('challengePage');
        if($challenge->state < 3)
            return redirect()->route('waitPage');

        if($challenge->ended_at == null)
            return redirect()->route('outcomePage');

        if(!($challenge->user1_outcome == 'won' && $challenge->user2_outcome == 'won'))
            return redirect()->route('challengePage');

        return view('evidence');
    }

    public function submitEvidence(Request $request)
    {
        $user = Auth::user();
        $challenge = Challenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->first();
        
        $files = $request->file('files');

        if($challenge == null){
            $fc = FinishedChallenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->orderBy('ended_at', 'desc')->first();
            if($fc != null){
                $fileName = 'evidence_user' .$user->id . '_challenge'.'.' . $files->getClientOriginalExtension();
                $files->move('evidences/challenge'.$fc->id.'/', $fileName);
            }
        }else{
            $fileName = 'evidence_user' .$user->id . '_challenge'.'.' . $files->getClientOriginalExtension();
            $files->move('evidences/challenge'.$challenge->id.'/', $fileName);

            $fc = new FinishedChallenge();
            $fc->id = $challenge->id;
            $fc->user1_id = $challenge->user1_id;
            $fc->user2_id = $challenge->user2_id;
            $fc->user1_outcome = $challenge->user1_outcome;
            $fc->user2_outcome = $challenge->user2_outcome;
            $fc->ended_at = $challenge->ended_at;
            $fc->save();
            $challenge->delete();
        }

        return Response::json(['message' => 'Evidence Submitted!'], 200);
    }

    public function evidence(Request $request)
    {
        $user = Auth::user();
        $challenge = Challenge::where('user1_id', '=', $user->id)->orWhere('user2_id', '=', $user->id)->first();

        if($challenge->user1_id == $user->id)
        {
            $challenge->user1_evidence = 1;
            $challenge->save();
        }
        else
        {
            $challenge->user2_evidence = 1;
            $challenge->save();
        }
        if($challenge->user1_evidence == $challenge->user2_evidence)
        {
            $fc = new FinishedChallenge();
            $fc->id = $challenge->id;
            $fc->user1_id = $challenge->user1_id;
            $fc->user2_id = $challenge->user2_id;
            $fc->user1_outcome = $challenge->user1_outcome;
            $fc->user2_outcome = $challenge->user2_outcome;
            $fc->ended_at = $challenge->ended_at;
            $fc->save();
            $challenge->delete();
        }
        return Response::json(['message' => 'Confirmation Submitted!'], 200);
    }
}
