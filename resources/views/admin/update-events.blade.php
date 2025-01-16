@extends('layouts.admin.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Event</h5>
                <form method="POST" action="{{ route('admin.updateEvent', $event->eventId) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')  <!-- Menambahkan method PUT untuk update -->

                    <!-- Event Name -->
                    <div class="form-outline mb-4">
                        <input type="text" name="eventName" class="form-control" value="{{ $event->eventName }}" required />
                    </div>

                    <!-- Event Description -->
                    <div class="form-outline mb-4">
                        <textarea name="eventDescription" class="form-control" required>{{ $event->eventDescription }}</textarea>
                    </div>

                    <!-- Event Date -->
                    <div class="form-outline mb-4">
                        <input type="datetime-local" name="eventDate" class="form-control" value="{{ \Carbon\Carbon::parse($event->eventDate)->format('Y-m-d\TH:i') }}" required />
                    </div>

                    <!-- Event Location -->
                    <div class="form-outline mb-4">
                        <input type="text" name="eventLocation" class="form-control" value="{{ $event->eventLocation }}" required />
                    </div>

                    <!-- Participant Quota -->
                    <div class="form-outline mb-4">
                        <input type="number" name="eventParticipantQuota" class="form-control" value="{{ $event->eventParticipantQuota }}" required />
                    </div>

                  <!-- Event Type -->
                <div class="form-outline mb-4">
                    <select name="eventType" class="form-control" required>
                        <option value="Environment" {{ old('eventType', $event->eventType) == 'Environment' ? 'selected' : '' }}>Environment</option>
                        <option value="Social" {{ old('eventType', $event->eventType) == 'Social' ? 'selected' : '' }}>Social</option>
                        <option value="Healthcare" {{ old('eventType', $event->eventType) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="Education" {{ old('eventType', $event->eventType) == 'Education' ? 'selected' : '' }}>Education</option>
                    </select>
                </div>


                    <!-- Event Updates -->
                    <div class="form-outline mb-4">
                        <textarea name="eventUpdates" class="form-control" placeholder="Event Updates">{{ $event->eventUpdates }}</textarea>
                    </div>

                    <!-- Event Points -->
                    <div class="form-outline mb-4">
                        <input type="number" name="eventPoints" class="form-control" value="{{ $event->eventPoints }}" />
                    </div>

                    <!-- Event Image -->
                    <div class="form-outline mb-4">
                        <input type="file" name="eventImage" class="form-control" />
                    </div>

                    <!-- Organizer Dropdown -->
                    <div class="form-outline mb-4">
                        <select name="organizerId" class="form-control" required>
                            <option value="">Select Organizer</option>
                            @foreach($organizers as $organizer)
                                <option value="{{ $organizer->organizerId }}"
                                    {{ $organizer->organizerId == $event->organizerId ? 'selected' : '' }}>
                                    {{ $organizer->user->userName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
