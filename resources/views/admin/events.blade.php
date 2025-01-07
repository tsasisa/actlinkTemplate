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

                <h5 class="card-title mb-4">{{ __('admin.events') }}</h5>

                <!-- Filter By Date -->
                <form method="GET" action="{{ route('admin.events') }}">
                    <div class="form-inline mb-4">
                        <label for="filter" class="mr-2">{{ __('admin.filter_events') }}:</label>
                        <select name="filter" class="form-control">
                            <option value="">{{ __('admin.select_filter') }}</option>
                            <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>{{ __('admin.past') }}</option>
                            <option value="current" {{ request('filter') == 'current' ? 'selected' : '' }}>{{ __('admin.current') }}</option>
                            <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>{{ __('admin.upcoming') }}</option>
                        </select>
                        <button type="submit" class="btn btn-info ml-2">{{ __('admin.filter') }}</button>
                    </div>
                </form>

                <a href="{{ route('admin.createEvent') }}" class="btn btn-primary mb-4">{{ __('admin.create_new_event') }}</a>
                <div class="d-flex flex-row-reverse">
                    <a class="btn btn-primary" style="margin-left: 10px;" href="{{ route('set-locale','id') }}">{{ __('admin.indonesia') }}</a>
                    <a class="btn btn-primary" href="{{ route('set-locale','en') }}">{{ __('admin.english') }}</a>
                </div>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.type') }}</th>
                            <th>{{ __('admin.organizer') }}</th>
                            <th>{{ __('admin.date') }}</th>
                            <th>{{ __('admin.location') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->eventId }}</td>
                                <td>{{ $event->eventName }}</td>
                                {{-- <td>{{ $event->eventType }}</td> --}}
                                <td>{{ __('admin.' . strtolower($event->eventType)) }}</td>
                                <td>{{ $event->organizer->user->userName }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}</td>
                                <td>{{ $event->eventLocation }}</td>
                                <td>
                                    @if($event->eventDate < \Carbon\Carbon::now()->toDateString())
                                    <!-- For Past Events -->
                                    <a href="{{ route('admin.deleteEvent', $event->eventId) }}" class="btn btn-danger" onclick="return confirm('{{ __('admin.are_you_sure') }}')">{{ __('admin.delete') }}</a>
                                @elseif($event->eventDate >= \Carbon\Carbon::now()->toDateString() && $event->eventDate <= \Carbon\Carbon::now()->addDays(2)->toDateString())
                                    <!-- For Current Events -->
                                    <a class="text-muted">{{ __('admin.on_progress') }}</a>
                                @else
                                    <!-- For Upcoming Events -->
                                    <a href="{{ route('admin.editEvent', $event->eventId) }}" class="btn btn-warning">{{ __('admin.edit') }}</a>
                                    <a href="{{ route('admin.deleteEvent', $event->eventId) }}" class="btn btn-danger" onclick="return confirm('{{ __('admin.are_you_sure') }}')">{{ __('admin.delete') }}</a>
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
