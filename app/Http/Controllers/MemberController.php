<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(){          
        // Fetch the latest 5 events
        $latestEvents = Event::orderBy('eventDate', 'asc')
        ->with('organizer.user')
        ->take(3)
        ->get();
        
        $largestParticipantEvents = Event::orderBy('eventParticipantNumber', 'desc')
            ->with('organizer.user')
            ->take(3)
            ->get();

            $user = Auth::user(); 
        
        return view('registered.home', compact('latestEvents', 'largestParticipantEvents', 'user'));
    }

    public function leaderboard() {
        $members = DB::table('members')
        ->join('users', 'members.memberId', '=', 'users.userId')
        ->select('users.userName', 'members.memberPoints')
        ->orderBy('members.memberPoints', 'desc')
        ->get();

        return view('unregistered.leaderboard', compact('members'));
    }
}
