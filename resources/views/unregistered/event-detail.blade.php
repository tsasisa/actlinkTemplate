@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Event Details</h1>
            <p class="lead animate__animated animate__fadeInUp">Discover everything about this event and join the movement.</p>
        </div>
    </section>

    <!-- Event Details Section -->
    <section class="event-details py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-4 order-lg-2 mb-4">
                    <!-- Join Event Card -->
                    <div class="join-card shadow-lg rounded p-4 text-center animate__animated animate__fadeInRight">
                        <h4 class="fw-bold">Join this Event</h4>
                        @if($event->eventParticipantNumber < $event->eventParticipantQuota)
                            <p class="text-success">Secure your spot now!</p>
                            <a href="" class="btn btn-success btn-lg w-100 animate__animated animate__pulse animate__infinite">Register Now</a>
                        @else
                            <p class="text-danger fw-bold">This event is fully booked.</p>
                        @endif
                        <hr class="my-4">
                        <p class="event-participants fw-bold">{{ $event->eventParticipantNumber }} / {{ $event->eventParticipantQuota }} slots filled</p>
                    </div>

                    <!-- Event Image -->
                    <div class="event-image-container shadow-lg rounded overflow-hidden mt-4">
                        <img src="data:image/png;base64,{{ $event->eventImage }}" alt="Event Image" class="event-image img-fluid">
                    </div>
                </div>

                <!-- Event Main Details -->
                <div class="col-lg-8 order-lg-1">
                    <div class="event-card shadow-lg rounded p-4 animate__animated animate__zoomIn">
                        <h2 class="event-title mb-3">{{ $event->eventName }}</h2>
                        <p class="event-date text-muted">
                            <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}
                        </p>
                        <p class="event-location text-muted">
                            <i class="bi bi-geo-alt"></i> {{ $event->eventLocation }}
                        </p>

                        <h4 class="mt-4">Description</h4>
                        <p class="event-description">{{ $event->eventDescription }}</p>

                        <h4 class="mt-4">Event Updates</h4>
                        <p class="event-updates">{{ $event->eventUpdates }}</p>

                        <h4 class="mt-4">Event Points</h4>
                        <p class="event-points"><i class="bi bi-star-fill text-warning"></i> Earn {{ $event->eventPoints }} points for participating!</p>

                        <h4 class="mt-4">Organizer</h4>
                        <p class="event-organizer"><i class="bi bi-person"></i> Organized by: {{ $event->organizer->user->userName }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Event Card */
        .event-card {
            border: none;
            background-color: #f8f9fa;
        }

        .event-title {
            font-size: 2rem;
            font-weight: bold;
        }

        .event-description,
        .event-updates,
        .event-points,
        .event-organizer {
            color: #6c757d;
        }

        /* Sidebar */
        .join-card {
            background: linear-gradient(135deg, #ffffff, #e9ecef);
            border: 2px solid #28a745;
        }

        .join-card h4 {
            color: #28a745;
        }

        .event-image {
            max-height: 400px;
            object-fit: cover;
            border: 4px solid #28a745;
        }

        .event-image-container {
            background: #f8f9fa;
            padding: 10px;
        }
    </style>

    <!-- Animations -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        rel="stylesheet"
    >
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>