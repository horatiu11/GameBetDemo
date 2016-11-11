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

        $challenge1 = Challenge::where('user1_id', '=', $user1->id)->orWhere('user2_id', '=', $user1->id)->first();

        if(!is_null($challenge1))  
               return redirect()->route('waitPage'); 

        return $next($request);
    }
}
