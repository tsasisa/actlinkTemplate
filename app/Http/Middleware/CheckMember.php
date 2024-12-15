<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMember
{
    public function handle($request, Closure $next)
    {
        
        if (Auth::check() && Auth::user()->userType === 'member') {
            return $next($request);
        }

        if($request->routeIs('home')){
            return $next($request);
        }
        return redirect()->route('home')->with('error', 'You do not have member access.');
    }
}
