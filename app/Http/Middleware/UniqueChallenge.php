<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Response;
use App\Challenge;

class UniqueChallenge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $user1 = Auth::user();

        $user2 = $request->input('id');

        $challenge1 = Challenge::where('user1_id', '=', $user1->id)->orWhere('user2_id', '=', $user1->id)->first();

        if(!is_null($challenge1))  
            if($request->ajax())
            {
                return Response::json(['error' => 'You already have an active challenge!' ],400);
            }
            else
            {
               return redirect()->route('waitPage'); 
            }
            


        $challenge2 = Challenge::where('user1_id', '=', $user2)->orWhere('user2_id', '=', $user2)->first();

        if(!is_null($challenge2))
            if($request->ajax())
            {
                return Response::json(['error' => 'The other user already has an active challenge!' ],400);
            }
            else
            {
                return redirect()->route('waitPage');
            }

        return $next($request);
    }
}
