<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        // Allow unauthenticated users to access the home page
        if (!Auth::check()) {
            return $next($request);
        }

        // Redirect authenticated users accessing '/' to their respective home pages
        if ($request->path() === '/') {
            switch (Auth::user()->userType) {
                case 'admin':
                    return redirect()->route('admin.home');
                case 'organizer':
                    if (Auth::user()->organizer && Auth::user()->organizer->activeFlag == 0) {
                        return redirect()->route('organizer.waitingAccept');
                    }
                    return redirect()->route('organizer.home');
                case 'member':
                    return redirect()->route('member.home');
            }
        }

        // Redirect authenticated users attempting to access unknown or restricted routes
        $userType = Auth::user()->userType;

        switch ($userType) {
            case 'admin':
                if (!$request->is('admin/*')) {
                    return redirect()->route('admin.home');
                }
                break;

            case 'organizer':
                if (Auth::user()->organizer) {
                    if (Auth::user()->organizer->activeFlag == 0 && !$request->is('organizer/waitingAccept')) {
                        return redirect()->route('organizer.waitingAccept');
                    }
                    if (Auth::user()->organizer->activeFlag == 1 && !$request->is('organizer/*')) {
                        return redirect()->route('organizer.home');
                    }
                }
                break;

            case 'member':
                if (!$request->is('member/*')) {
                    return redirect()->route('member.home');
                }
                break;

            default:
                return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
