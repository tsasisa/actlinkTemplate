@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">My Registered Events</h1>
            <p class="lead animate__animated animate__fadeInUp">Here are the events you have registered for.</p>
        </div>
    </section>

    <!-- Registered Events Section -->
    <section class="registered-events py-5">
        <div class="container">
            @if($registeredEvents->isEmpty())
                <div class="alert alert-warning text-center">
                    <h4>You have not registered for any events yet.</h4>
                </div>
            @else
                <div class="row">
                    @foreach($registeredEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-lg">
                                <img src="data:image/png;base64,{{ $event->eventImage }}" class="card-img-top" alt="{{ $event->eventName }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->eventName }}</h5>
                                    <p class="card-text text-muted">
                                        <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}
                                    </p>
                                    <p class="card-text text-muted">
                                        <i class="bi bi-geo-alt"></i> {{ $event->eventLocation }}
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-star-fill text-warning"></i> Earned Points: {{ $event->eventPoints }}
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-clock"></i> Registered On: {{ \Carbon\Carbon::parse($event->registeredDate)->format('d M, Y') }}
                                    </p>
                                    <a href="{{ route('event.detail', $event->eventId) }}" class="btn btn-success">View Event</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card {
            border: none;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            color: #6c757d;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
@endsection
