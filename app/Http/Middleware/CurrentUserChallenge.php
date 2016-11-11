<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Challenge;

class CurrentUserChallenge
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

        $challenge1 = Challenge::where('user1_id', '=', $user1->id)->where('state', '=', 1)->first();

        if(!is_null($challenge1))  
           return redirect()->route('waitPage');

        $challenge1 = Challenge::where('user1_id', '=', $user1->id)->where('state', '=', 2)->first();
        $challenge2 = Challenge::where('user2_id', '=', $user1->id)->where('state', '=', 2)->first();

        if(!is_null($challenge1) || !is_null($challenge2))  
            return redirect()->route('waitPage');

        $challenge1 = Challenge::where('user1_id', '=', $user1->id)->where('state', '=', 3)->first();
        $challenge2 = Challenge::where('user2_id', '=', $user1->id)->where('state', '=', 3)->first();

        if(!is_null($challenge1) || !is_null($challenge2))  
            return redirect()->route('waitPage');

        return $next($request);
    }
}
