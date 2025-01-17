<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();
    
        if ($request->filled('category')) {
            $query->where('eventType', $request->category);
        }
    
        if ($request->filled('search')) {
            $query->where('eventName', 'like', '%' . $request->search . '%');
        }
    
        $events = $query->paginate(3);
    
        return view('unregistered.events', compact('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $event = Event::with('organizer.user')->findOrFail($id);

        $authUser = Auth::user();
        $isRegistered = false;

        if ($authUser) {
            $isRegistered = DB::table('eventParticipants')
                ->where('memberId', $authUser->userId)
                ->where('eventId', $id)
                ->exists();
        }

        if (!Auth::check()) {
            session(['url.intended' => url()->full()]);
        }

        // Log system
        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Viewed',
            'OperationDescription' => 'Viewed event detail: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        return view('unregistered.event-detail', [
            'event' => $event,
            'isRegistered' => $isRegistered,
            'from' => $request->query('from', 'events'),
        ]);
    }

    public function register(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user(); 

        // Check if the event is full
        if ($event->eventParticipantNumber >= $event->eventParticipantQuota) {
            return redirect()->back()->with('error', 'This event is fully booked.');
        }

        // Update participant number
        $event->eventParticipantNumber += 1;
        $event->save();

        $member = Member::where('memberId', $user->userId)->first();

        if ($member) {
            $member->memberPoints += $event->eventPoints;
            $member->save();
        }

        DB::table('eventParticipants')->insert([
        'memberId' => $member->memberId,
        'eventId' => $event->eventId,
        'registeredDate' => now(),
        ]);

        // Log system
        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Registered',
            'OperationDescription' => 'User ' . $user->name . ' registered for event: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        return redirect()->route('event.detail', $id)->with('success', 'You have successfully registered for the event.');
    }

    public function registeredEvents()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your registered events.');
        }

        $registeredEvents = DB::table('eventParticipants')
            ->join('events', 'eventParticipants.eventId', '=', 'events.eventId')
            ->where('eventParticipants.memberId', $user->userId)
            ->select('events.*', 'eventParticipants.registeredDate')
            ->get();

        return view('registered.registered-events', compact('registeredEvents'));
    }
}
