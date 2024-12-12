<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(){          
        // Fetch the latest 5 events
        $latestEvents = Event::orderBy('eventDate', 'asc') // Order by nearest event date
        ->with('organizer.user') // Eager load organizer's user
        ->take(3)
        ->get();
        
        $largestParticipantEvents = Event::orderBy('eventParticipantNumber', 'desc') // Order by largest participant number
            ->with('organizer.user') // Eager load organizer's user
            ->take(3)
            ->get();

            $user = Auth::user(); 
        
        return view('unregistered.home', compact('latestEvents', 'largestParticipantEvents', 'user'));
    }
}
