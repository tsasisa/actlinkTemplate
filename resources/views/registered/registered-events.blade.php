@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white animate__animated animate__fadeInDown">
        <div class="container">
            <h1 class="display-4 fw-bold">{{ __('event.registered-events.page_header') }}</h1>
            <p class="lead">{{ __('event.registered-events.subheader') }}</p>
        </div>
    </section>

    <!-- Registered Events Section -->
    <section class="registered-events py-5">
        <div class="container">
            @if($registeredEvents->isEmpty())
                <div class="alert alert-warning text-center animate__animated animate__fadeInUp">
                    <h4>{{ __('event.registered-events.no_events') }}</h4>
                </div>
            @else
                <div class="row">
                    @foreach($registeredEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-lg hover-zoom animate__animated animate__fadeInUp">
                                <img src="data:image/png;base64,{{ $event->eventImage }}" class="card-img-top" alt="{{ $event->eventName }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->eventName }}</h5>
                                    <p class="card-text text-muted">
                                        <i class="bi bi-calendar-event"></i> {{ __('event.registered-events.event_date') }}: {{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}
                                    </p>
                                    <p class="card-text text-muted">
                                        <i class="bi bi-geo-alt"></i> {{ __('event.registered-events.event_location') }}: {{ $event->eventLocation }}
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-star-fill text-warning"></i> {{ __('event.registered-events.earned_points') }}: {{ $event->eventPoints }}
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-clock"></i> {{ __('event.registered-events.registered_on') }}: {{ \Carbon\Carbon::parse($event->registeredDate)->format('d M, Y') }}
                                    </p>
                                    <a href="{{ route('event.detail', ['id' => $event->eventId, 'from' => 'registered-events']) }}" class="btn btn-success">
                                        {{ __('event.registered-events.view_event') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <style>
        .page-header {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1c7430;
        }

        .card-text {
            color: #495057;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .hover-zoom {
            transition: transform 0.3s ease;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
        }

        .alert-warning {
            background-color: #ffcc00;
            color: #212529;
            font-size: 1.1rem;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
@endsection
