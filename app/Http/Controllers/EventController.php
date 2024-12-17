<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\SystemLog; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(3);
        return view('unregistered.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

        // Ensure the user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your registered events.');
        }

        // Get the registered events for the authenticated user
        $registeredEvents = DB::table('eventParticipants')
            ->join('events', 'eventParticipants.eventId', '=', 'events.eventId')
            ->where('eventParticipants.memberId', $user->userId)
            ->select('events.*', 'eventParticipants.registeredDate')
            ->get();

        // Pass the data to the view
        return view('registered.registered-events', compact('registeredEvents'));
    }
}
