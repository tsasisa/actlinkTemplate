<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Member;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use App\Traits\LogsSystemActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    use LogsSystemActivity;
    public function index(Request $request)
    {
        $query = SystemLog::query();

        if ($request->has('action') && $request->action) {
            $query->where('entityOperation', $request->action);
        }

        if ($request->has('start_date') && $request->start_date) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $query->where('Datetime', '>=', $startDate);
        }

        if ($request->has('end_date') && $request->end_date) {
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->where('Datetime', '<=', $endDate);
        }

        $logs = $query->paginate(10);


        return view('admin.admin', compact('logs'));
    }

    public function events(Request $request)
    {
        $currentDate = Carbon::now();

        if ($request->has('filter') && $request->filter == 'past') {
            // Event sebelum hari ini
            $events = Event::where('eventDate', '<', $currentDate->startOfDay())->get();
        } elseif ($request->has('filter') && $request->filter == 'current') {
            // Event hari ini hingga H+2
            $startDate = $currentDate->copy()->startOfDay();
            $endDate = $currentDate->copy()->addDays(2)->endOfDay();
            $events = Event::where('eventDate', '>=', $startDate)
                           ->where('eventDate', '<=', $endDate)
                           ->get();
        } elseif ($request->has('filter') && $request->filter == 'upcoming') {
            // Event setelah H+2
            $events = Event::where('eventDate', '>', $currentDate->copy()->addDays(2)->endOfDay())->get();
        } else {
            $events = Event::all();
        }

        return view('admin.events', compact('events'));
    }


    public function createEvent()
    {
        $organizers = Organizer::where('activeFlag', 1)->with('user')->get();
        return view('admin.create-events', compact('organizers'));
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'eventName' => 'required|string|max:255',
            'eventDescription' => 'required|string',
            'eventDate' => 'required|date|after_or_equal:tomorrow',
            'eventLocation' => 'required|string',
            'eventParticipantQuota' => 'required|integer',
            'eventImage' => 'nullable|image',
            'organizerId' => 'required|exists:organizers,organizerId',
        ]);

        $eventDate = Carbon::parse($request->input('eventDate'));
        if ($eventDate->isBefore(now())) {
            return back()->withErrors(['eventDate' => 'The event date and time must be a future date and time.']);
        }

        $event = new Event();
        $event->eventName = $request->eventName;
        $event->eventDescription = $request->eventDescription;
        $event->eventDate = $request->eventDate;
        $event->eventLocation = $request->eventLocation;
        $event->eventParticipantQuota = $request->eventParticipantQuota;
        $event->eventParticipantNumber = 0;
        $event->organizerId = $request->organizerId;

        if ($request->hasFile('eventImage')) {
            $path = $request->file('eventImage')->store('events');
            $event->eventImage = $path;
        }

        $event->save();

        $user = Auth::user();

        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Created',
            'OperationDescription' => $user->userName .' created new event: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        return redirect()->route('admin.events')->with('success', 'Event created successfully');
    }

    public function editEvent($id)
    {
        $organizers = Organizer::with('user')->get();
        $event = Event::find($id);
        return view('admin.update-events', compact('event', 'organizers'));
    }

    public function updateEvent(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $organizers = Organizer::with('user')->get();

        $validatedData = $request->validate([
            'eventName' => 'required|string|max:255',
            'eventDescription' => 'required|string',
            'eventDate' => 'required|date|after_or_equal:now',
            'eventLocation' => 'required|string|max:255',
            'eventParticipantQuota' => 'required|integer|min:1',
            'eventType' => 'required|in:Environment,Social,Healthcare,Education',
            'eventUpdates' => 'nullable|string',
            'eventPoints' => 'nullable|integer',
            'eventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'organizerId' => 'required|exists:organizers,organizerId',
        ]);

        $event->update($validatedData);

        if ($request->hasFile('eventImage')) {
            $imagePath = $request->file('eventImage')->store('event_images');
            $event->eventImage = $imagePath;
        }

        $event->save();

        $user = Auth::user();

        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Updated',
            'OperationDescription' => $user->userName .' updated event: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        return redirect()->route('admin.events')->with('success', 'Event updated successfully!');
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);

        $user = Auth::user();

        SystemLog::create([
            'entityName' => 'Event',
            'entityOperation' => 'Deleted',
            'OperationDescription' => $user->userName. ' deleted event: ' . $event->eventName,
            'Datetime' => now(),
        ]);

        $event->delete();

        return redirect()->route('admin.events')->with('success_delete', 'Event deleted successfully');
    }


    // ==================ORGANIZER MANAGEMENT================================

    public function showOrganizers(Request $request)
    {

        $status = $request->input('status');

        $query = Organizer::query();


        if ($status) {
            if ($status == 'pending') {
                $query->where('activeFlag', 0);
            } elseif ($status == 'accepted') {
                $query->where('activeFlag', 1);
            }
        }


        $organizers = $query->paginate(10);


        return view('admin.organizers', compact('organizers'));
    }


    public function acceptOrganizer($organizerId)
    {
        $organizer = Organizer::find($organizerId);
        if ($organizer) {
            $organizer->activeFlag = true;
            $organizer->save();

            $user = $organizer->user;

            $this->logActivity(
                'Organizer',
                'Accepted', 
                'Admin accepted organizer: ' . $user->userName 
            );
            return redirect()->route('admin.organizers')->with('success', 'Organizer accepted successfully.');
        }
       

        return redirect()->route('admin.organizers')->with('error', 'Organizer not found.');
    }

    public function declineOrganizer($organizerId)
    {
        $organizer = Organizer::find($organizerId);
        if ($organizer) {
            $organizer->delete();

            $user = $organizer->user;

            $this->logActivity(
                'Organizer',
                'Declined', 
                'Admin declined organizer: ' . $user->userName 
            );

            return redirect()->route('admin.organizers')->with('success', 'Organizer declined successfully.');
        }
        return redirect()->route('admin.organizers')->with('error', 'Organizer not found.');
    }

    public function editOrganizer($organizerId)
    {
        $organizer = Organizer::find($organizerId);


        if (!$organizer) {
            return redirect()->route('admin.organizers')->with('error', 'Organizer not found');
        }

        return view('admin.edit-organizers', compact('organizer'));
    }

    public function updateOrganizer(Request $request, $organizerId)
    {
        // Cari organizer berdasarkan ID
        $organizer = Organizer::find($organizerId);

        if (!$organizer) {
            return redirect()->route('admin.organizers')->with('error', 'Organizer not found');
        }

        // Validasi input
        $validatedData = $request->validate([
            'userName' => 'required|string|max:255',
            'organizerAddress' => 'required|string|max:255',
            'officialSocialMedia' => 'required|url|max:255',
        ], __('validationEditOrganizer.custom'));
        

        // Update data user
        $organizer->user->update([
            'userName' => $validatedData['userName'],
        ]);

        // Update data organizer
        $organizer->update([
            'organizerAddress' => $validatedData['organizerAddress'],
            'officialSocialMedia' => $validatedData['officialSocialMedia'],
        ]);

        // Log aktivitas
        $user = $organizer->user;

        $this->logActivity(
            'Organizer',
            'Updated',
            'Updated organizer: ' . $user->userName
        );

        return redirect()->route('admin.organizers')->with('success', 'Organizer updated successfully');
    }


   // =================== MEMBER MANAGEMENT =======================================

    public function indexMember(Request $request)
    {
        $searchName = $request->get('searchName');
        $members = Member::whereHas('user', function ($query) use ($searchName) {
            $query->where('userName', 'like', '%' . $searchName . '%')
                ->where('userType', 'member');
        })->paginate(10);

        return view('admin.members', compact('members'));
    }

    public function editMember($memberId)
    {
        $member = Member::find($memberId);

        if (!$member) {
            return redirect()->route('admin.members.indexMember')->with('error', 'Member not found');
        }

        return view('admin.edit-members', compact('member'));
    }

    public function updateMember(Request $request, $memberId)
    {
        // Cari member berdasarkan ID
        $member = Member::find($memberId);

        if (!$member) {
            return redirect()->route('admin.members.indexMember')->with('error', __('admin.member_not_found'));
        }

        $validatedData = $request->validate([
            'userName' => 'required|string|max:255', 
            'userPhoneNumber' => 'required|regex:/^08[0-9]{7,}$/|max:15', 
            'memberDOB' => 'required|date', 
            'memberPoints' => 'nullable|integer|min:0', 
            'userType' => 'required|string|in:member,admin,organizer', 
            'organizerAddress' => 'exclude_if:userType,member|exclude_if:userType,admin|required|string|max:255',
            'officialSocialMedia' => 'exclude_if:userType,member|exclude_if:userType,admin|required|url|max:255'
        ], __('validationEditMember.custom'));
        

        // Update data user
        $member->user->update([
            'userName' => $validatedData['userName'],
            'userPhoneNumber' => $validatedData['userPhoneNumber'],
            'userType' => $validatedData['userType'],
        ]);

        // Update data member
        $member->update([
            'memberDOB' => $validatedData['memberDOB'],
            'memberPoints' => $validatedData['memberPoints'],
        ]);

        // Jika role berubah menjadi organizer
        if ($validatedData['userType'] === 'organizer') {
            Organizer::updateOrCreate(
                ['organizerId' => $member->user->userId], // Cari berdasarkan organizerId
                [
                    'organizerAddress' => $validatedData['organizerAddress'],
                    'officialSocialMedia' => $validatedData['officialSocialMedia'],
                    'activeFlag' => true,
                ]
            );
        } else {
            // Hapus data organizer jika role bukan organizer
            Organizer::where('organizerId', $member->user->userId)->delete();
        }

        return redirect()->route('admin.members.indexMember')->with('success', __('admin.member_updated'));
    }

    
    public function deleteMember($memberId)
    {
        $member = Member::find($memberId);

        if (!$member) {
            return redirect()->route('admin.members.indexMember')->with('error', 'Member not found');
        }

        $user = $member->user;
        $member->delete();
        $user->delete();

        $this->logActivity(
            'Member',
            'Deleted', 
            'Admin deleted member: ' . $user->userName 
        );

        return redirect()->route('admin.members.indexMember')->with('success', 'Member deleted successfully');
    }

    public function updateRoleMember(Request $request, $memberId)
    {
        $member = Member::find($memberId);

        if (!$member) {
            return redirect()->route('admin.members.indexMember')->with('error', 'Member not found');
        }

        $request->validate([
            'userType' => 'required|string|in:admin,organizer,member',
        ]);

        $member->user->update([
            'userType' => $request->userType,
        ]);

        $this->logActivity(
            'Member',
            'Updated', 
            'Admin updated member role of : ' . $member->user->userName 
        );

        return redirect()->route('admin.members.indexMember')->with('success', 'Role updated successfully');
    }


}
