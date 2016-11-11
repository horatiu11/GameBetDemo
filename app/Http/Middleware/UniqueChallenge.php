<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        $user1 = $request->input('id');

        $user2 = Auth::user()->id;

        $challenge1 = Challenge::where('user1_id', '=', $user1->id)->orWhere('user2_id', '=', $user1->id)->first();

        if(!is_null($challenge1))
            return redirect()->url('/')->with('error', 'You already have an active challenge!');


        $challenge2 = Challenge::where('user1_id', '=', $user2->id)->orWhere('user2_id', '=', $user2->id)->first();

        if(!is_null($challenge1))
            return redirect()->url('/')->with('error', 'The other user already has an active challenge!');

        return $next($request);
    }
}
