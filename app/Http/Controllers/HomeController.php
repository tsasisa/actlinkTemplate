<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Redirect authenticated users to their role-specific home
            $user = Auth::user();
            switch ($user->userType) {
                case 'admin':
                    return redirect()->route('admin.home');
                case 'organizer':
                    return redirect()->route('organizer.home');
                case 'member':
                    return redirect()->route('member.home');
                default:
                    return redirect('/')->with('error', 'Unauthorized access.');
            }
        }
        // Fetch the latest 5 events
        $latestEvents = Event::orderBy('eventDate', 'asc')
        ->with('organizer.user')
        ->take(3)
        ->get();
    
        $largestParticipantEvents = Event::orderBy('eventParticipantNumber', 'desc')
            ->with('organizer.user')
            ->take(3)
            ->get();
        
        return view('unregistered.home', compact('latestEvents', 'largestParticipantEvents'));
    }


    public function howItWorks()
    {
    
        return view('unregistered.howItWorks') ;
    }
}
