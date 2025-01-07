@extends('layouts.admin.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">{{ __('admin.create_new_event') }}</h5> <!-- Lokalisasi judul -->

                <form method="POST" action="{{ route('admin.storeEvent') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="form-outline mb-4">
                        <input type="text" name="eventName" class="form-control" placeholder="{{ __('admin.event_name') }}" required />
                        @error('eventName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-outline mb-4">
                        <textarea name="eventDescription" class="form-control" placeholder="{{ __('admin.event_description') }}" required></textarea>
                        @error('eventDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="form-outline mb-4">
                        <input type="datetime-local" name="eventDate" class="form-control" required id="eventDate" />
                        @error('eventDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="form-outline mb-4">
                        <input type="text" name="eventLocation" class="form-control" placeholder="{{ __('admin.event_location') }}" required />
                        @error('eventLocation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Quota -->
                    <div class="form-outline mb-4">
                        <input type="number" name="eventParticipantQuota" class="form-control" placeholder="{{ __('admin.participant_quota') }}" required />
                        @error('eventParticipantQuota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="form-outline mb-4">
                        <input type="file" name="eventImage" class="form-control" />
                        @error('eventImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Organizer -->
                    <div class="form-outline mb-4">
                        <select name="organizerId" class="form-control" required>
                            <option value="">{{ __('admin.select_organizer') }}</option>
                            @foreach($organizers as $organizer)
                                <option value="{{ $organizer->organizerId }}">{{ $organizer->user->userName }}</option>
                            @endforeach
                        </select>
                        @error('organizerId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Type -->
                    <div class="form-outline mb-4">
                        <select name="eventType" class="form-control" required>
                            <option value="">{{ __('admin.select_event_type') }}</option>
                            <option value="Environment">{{ __('admin.environment') }}</option>
                            <option value="Social">{{ __('admin.social') }}</option>
                            <option value="Healthcare">{{ __('admin.healthcare') }}</option>
                            <option value="Education">{{ __('admin.education') }}</option>
                        </select>
                        @error('eventType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Updates -->
                    <div class="form-outline mb-4">
                        <textarea name="eventUpdates" class="form-control" placeholder="{{ __('admin.event_updates') }}" rows="3"></textarea>
                        @error('eventUpdates')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Points -->
                    <div class="form-outline mb-4">
                        <input type="number" name="eventPoints" class="form-control" placeholder="{{ __('admin.event_points') }}" required />
                        @error('eventPoints')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('admin.create_event') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
