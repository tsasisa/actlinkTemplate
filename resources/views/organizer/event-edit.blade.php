@extends('layouts.navbar.navbar')
@section('content')
<div class="container my-3">
    <form action="{{ route('organizer.event-update', ['id' => $event->eventId]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">@lang('organizer.Event-Name')</label>
                <input type="text" class="form-control" id="event-name" name="event-name" value="{{$event->eventName}}">  
                @error('event-name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email">@lang('organizer.Event-Description')</label>
                <input type="text" class="form-control" id="event-description" name="event-description" value="{{$event->eventDescription}}" >  
                @error('event-description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone">@lang('organizer.Event-Image')</label>
                <input type="file" class="form-control" id="image" name="image">   
                @error('event-date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone">@lang('organizer.Event-Date')</label>
                <input type="date" class="form-control" id="event-date" name="event-date" value="{{$event->eventDate}}" >  
                @error('event-date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('organizer.Event-Location')</label>
                <input type="text" class="form-control" id="event-location" name="event-location" value="{{$event->eventLocation}}" >  
                @error('event-location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('organizer.Event-Participant-Quota')</label>
                <input type="text" class="form-control" id="event-quota" name="event-quota" value="{{$event->eventParticipantQuota}}" >  
                @error('event-quota')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('organizer.Event-Points')</label>
                <input type="text" class="form-control" id="event-points" name="event-points" value="{{$event->eventPoints}}" >  
                @error('event-points')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('organizer.Event-Type')</label>
                <select name="event-type" id="event-type" class="form-control">
                    <option value="Environment">@lang('organizer.Environment')</option>
                    <option value="Healthcare">@lang('organizer.Healthcare')</option>
                    <option value="Education">@lang('organizer.Education')</option>
                    <option value="Social">@lang('organizer.Social')</option>
                </select>  
                    @error('event-points')
                        <div class="text-type">{{ $message }}</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('organizer.Event-Updates')</label>
                <input type="text" class="form-control" id="event-update" name="event-update" value="{{$event->eventUpdates}}">  
                @error('event-update')
                    <div class="text-type">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">@lang('organizer.Update')</button>
        </form>
</div>
    
@endsection