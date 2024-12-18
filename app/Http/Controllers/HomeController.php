<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
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
