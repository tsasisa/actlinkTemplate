@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">{{ __('event.detail.page_header') }}</h1>
            <p class="lead animate__animated animate__fadeInUp">{{ __('event.detail.subheader') }}</p>
        </div>
    </section>

    <!-- Back Button -->
    <div class="container mt-4">
        @if($from === 'registered-events')
            <a href="{{ route('member.registered.events') }}" class="btn btn-secondary animate__animated animate__fadeInLeft">
                <i class="bi bi-arrow-left"></i> {{ __('event.detail.back_to_registered') }}
            </a>
        @else
            <a href="{{ route('events.index') }}" class="btn btn-secondary animate__animated animate__fadeInLeft">
                <i class="bi bi-arrow-left"></i> {{ __('event.detail.back_to_list') }}
            </a>
        @endif
    </div>

    <!-- Event Details Section -->
    <section class="event-details py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-4 order-lg-2 mb-4">
                    <!-- Join Event Card -->
                    <div class="join-card shadow-lg rounded p-4 text-center animate__animated animate__fadeInRight">
                        <h4 class="fw-bold">{{ __('event.detail.join_event') }}</h4>
                        @if($event->eventParticipantNumber >= $event->eventParticipantQuota)
                            <p class="text-danger fw-bold">{{ __('event.detail.event_full') }}</p>
                            <button class="btn btn-secondary btn-lg w-100" disabled>{{ __('event.detail.event_full_btn') }}</button>
                        @elseif(!auth()->check())
                            <a href="{{ route('login') }}?intended={{ urlencode(request()->fullUrl()) }}" class="btn btn-success btn-lg w-100">
                                {{ __('event.detail.login_to_register') }}
                            </a>
                        @else
                            @if($isRegistered)
                                <p class="text-warning fw-bold">{{ __('event.detail.already_registered') }}</p>
                                <button class="btn btn-secondary btn-lg w-100" disabled>{{ __('event.detail.already_registered_btn') }}</button>
                            @else
                                <a href="#" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#confirmRegistrationModal">
                                    {{ __('event.detail.register_now') }}
                                </a>
                            @endif
                        @endif
                        <hr class="my-4">
                        <p class="event-participants fw-bold">{{ $event->eventParticipantNumber }} / {{ $event->eventParticipantQuota }} {{ __('event.detail.slots_filled') }}</p>
                    </div>
                    <!-- Event Image -->
                    <div class="event-image-container shadow-lg rounded overflow-hidden mt-4 animate__animated animate__fadeInRight">
                        <img 
                            src="data:image/png;base64,{{ $event->eventImage }}" 
                            alt="Event Image" 
                            class="event-image img-fluid"
                        >
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

                        <h4 class="mt-4">{{ __('event.detail.description') }}</h4>
                        <p class="event-description">{{ $event->eventDescription }}</p>

                        <h4 class="mt-4">{{ __('event.detail.updates') }}</h4>
                        <p class="event-updates">{{ $event->eventUpdates }}</p>

                        <h4 class="mt-4">{{ __('event.detail.points') }}</h4>
                        <p class="event-points"><i class="bi bi-star-fill text-warning"></i> {{ __('event.detail.points_text', ['points' => $event->eventPoints]) }}</p>

                        <h4 class="mt-4">{{ __('event.detail.organizer') }}</h4>
                        <p class="event-organizer"><i class="bi bi-person"></i> {{ __('event.detail.organized_by', ['organizer' => $event->organizer->user->userName]) }}</p>
                    </div>
                </div>
            </div>
            <!-- Confirm Registration Modal -->
            <div class="modal fade" id="confirmRegistrationModal" tabindex="-1" aria-labelledby="confirmRegistrationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRegistrationLabel">{{ __('event.detail.confirm_registration') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="fs-5 fw-bold">{{ __('event.detail.confirmation_text') }}</p>
                            <p class="text-success fw-bold">
                                <i class="bi bi-star-fill text-warning"></i> 
                                {{ __('event.detail.confirmation_points', ['points' => $event->eventPoints]) }}
                            </p>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <form method="POST" action="{{ route('member.event.register', $event->eventId) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">{{ __('event.detail.confirm') }}</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('event.detail.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        rel="stylesheet"
    >
@endsection