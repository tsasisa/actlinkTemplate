<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SystemLog; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show($id)
    {
        $event = Event::with('organizer.user')->findOrFail($id);

        // Log system
        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Viewed',
            'OperationDescription' => 'Viewed event detail: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        return view('unregistered.event-detail', compact('event'));
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
    

        // Check if user is already registered
        // if ($user->registeredEvents->contains($id)) {
        //     return redirect()->back()->with('error', 'You are already registered for this event.');
        // }

        // Check if the event is full
        if ($event->eventParticipantNumber >= $event->eventParticipantQuota) {
            return redirect()->back()->with('error', 'This event is fully booked.');
        }

        // Update participant number
        $event->eventParticipantNumber += 1;
        $event->save();

        // Log system
        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Registered',
            'OperationDescription' => 'User ' . $user->name . ' registered for event: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        return redirect()->route('event.detail', $id)->with('success', 'You have successfully registered for the event.');
    }
}
