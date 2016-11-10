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

        $challenge = Challenge::where('user1_id', '=', $user->id)->first();

        return $next($request);
    }
}
