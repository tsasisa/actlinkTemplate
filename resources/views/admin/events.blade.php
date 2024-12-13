@extends('layouts.admin.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success') !!}</p>
                    </div>
                @endif
                @if(\Session::has('success_delete'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success_delete') !!}</p>
                    </div>
                @endif

                <h5 class="card-title mb-4">Events</h5>

                <!-- Filter By Date -->
                <form method="GET" action="{{ route('admin.events') }}">
                    <div class="form-inline mb-4">
                        <label for="filter" class="mr-2">Filter Events:</label>
                        <select name="filter" class="form-control">
                            <option value="">Select Filter</option>
                            <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>Past</option>
                            <option value="current" {{ request('filter') == 'current' ? 'selected' : '' }}>Current</option>
                            <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        </select>
                        <button type="submit" class="btn btn-info ml-2">Filter</button>
                    </div>
                </form>

                <a href="{{ route('admin.createEvent') }}" class="btn btn-primary mb-4">Create New Event</a>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Organizer</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->eventId }}</td>
                                <td>{{ $event->eventName }}</td>
                                <td>{{ $event->eventType }}</td>
                                <td>{{ $event->organizer->user->userName }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}</td>
                                <td>{{ $event->eventLocation }}</td>
                                <td>
                                    @if($event->eventDate < \Carbon\Carbon::now()->toDateString())
                                    <!-- For Past Events -->
                                    <a href="{{ route('admin.deleteEvent', $event->eventId) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                @elseif($event->eventDate >= \Carbon\Carbon::now()->toDateString() && $event->eventDate <= \Carbon\Carbon::now()->addDays(2)->toDateString())
                                    <!-- For Current Events -->
                                    <a class="text-muted">ON PROGRESS</a>
                                @else
                                    <!-- For Upcoming Events -->
                                    <a href="{{ route('admin.editEvent', $event->eventId) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.deleteEvent', $event->eventId) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
