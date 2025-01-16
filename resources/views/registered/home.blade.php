@extends('layouts.navbar.navbar')

@section('content')
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
        <!-- First Slide: Hero Section -->
        <div class="carousel-item active" style="background: url('{{ asset('assets/images/1.jpg') }}') no-repeat center center/cover;">
            <section class="hero d-flex align-items-center justify-content-center text-center">
                <div class="container position-relative text-white">
                    <h1 class="display-4 fw-bold">{{ __('messages.hero_title') }}</h1>
                    <p class="lead">{{ __('messages.hero_description') }}</p>            
                </div>
            </section>
        </div>

        <!-- Second Slide: Call to Action with a Different Background -->
        <div class="carousel-item" style="background: url('{{ asset('assets/images/2.jpg') }}') no-repeat center center/cover;">
            <section class="hero d-flex align-items-center justify-content-center text-center">
                <div class="container position-relative text-white">
                    <h1 class="display-4 fw-bold">{{ __('messages.cta_title') }}</h1>
                    <p class="lead">{{ __('messages.cta_description') }}</p>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- SDG Section with 4 GIF Icons (SDG 15 is the most focused) -->
<section class="sdg-section py-5">
    <div class="container text-center">
        <h4 class="sdg-heading fw-bold mb-4">{{ __('messages.sdg_focus_title') }}</h4>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <!-- SDG 15 (Most Focused, with highlighted description) -->
            <div class="col">
                <div class="sdg-icon-card priority">
                    <img src="{{ asset('assets/images/sdg-15.gif') }}" alt="SDG 15" class="img-fluid mb-3" style="max-width: 130px;">
                    <p class="lead">{{ __('messages.sdg_15_description') }}</p>
                </div>
            </div>

            <!-- SDG 11 -->
            <div class="col">
                <div class="sdg-icon-card">
                    <img src="{{ asset('assets/images/sdg-11.gif') }}" alt="SDG 11" class="img-fluid mb-3" style="max-width: 130px;">
                    <p class="lead">{{ __('messages.sdg_11_description') }}</p>
                </div>
            </div>

            <!-- SDG 3 -->
            <div class="col">
                <div class="sdg-icon-card">
                    <img src="{{ asset('assets/images/sdg-3.gif') }}" alt="SDG 3" class="img-fluid mb-3" style="max-width: 130px;">
                    <p class="lead">{{ __('messages.sdg_3_description') }}</p>
                </div>
            </div>

            <!-- SDG 4 -->
            <div class="col">
                <div class="sdg-icon-card">
                    <img src="{{ asset('assets/images/sdg-4.gif') }}" alt="SDG 4" class="img-fluid mb-3" style="max-width: 130px;">
                    <p class="lead">{{ __('messages.sdg_4_description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Events Section -->
<section class="latest-events py-5">
    <div class="container text-center">
        <h4 class="event-heading fw-bold mb-4">{{ __('messages.latest_events_title') }}</h4>
        <div class="row">
            @foreach($latestEvents as $event)
            <div class="col-md-4">
                <div class="event-card p-4 mb-1">
                    <!-- Event Image -->
                    <img src="data:image/png;base64,{{ $event->eventImage }}" alt="Event Image" class="event-image img-fluid mb-3">
                    <h5 class="event-title">{{ $event->eventName }}</h5>
                    <p class="event-date">{{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}</p>
                    <p class="event-location">{{ $event->eventLocation }}</p>
                    <p class="event-description">{{ \Str::limit($event->eventDescription, 100) }}</p>
                    <p class="event-organizer">{{ __('messages.organized_by') }}: {{ $event->organizer->user->userName }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Largest Participants Section -->
<section class="largest-participants pb-4">
    <div class="container text-center">
        <h4 class="event-heading fw-bold mb-4">{{ __('messages.largest_participants_title') }}</h4>
        <div class="row">
            @foreach($largestParticipantEvents as $event)
            <div class="col-md-4">
                <div class="event-card p-4 mb-4">
                    <!-- Event Image -->
                    <img src="data:image/png;base64,{{ $event->eventImage }}" alt="Event Image" class="event-image img-fluid mb-3">
                    <h5 class="event-title">{{ $event->eventName }}</h5>
                    <p class="event-date">{{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}</p>
                    <p class="event-location">{{ $event->eventLocation }}</p>
                    <p class="event-participants">{{ __('messages.participants') }}: {{ $event->eventParticipantNumber }} / {{ $event->eventParticipantQuota }}</p>
                    <p class="event-organizer">{{ __('messages.organized_by') }}: {{ $event->organizer->user->userName }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



    <style>
        /* Hero Section */
        .hero {
            height: 100vh; /* Full viewport height */
            position: relative;
        }
        .latest-events {
            background-color: white;
        }

        

        .event-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .event-date, .event-location, .event-description {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .event-participants {
            font-size: 1rem;
            color: #28a745;
        }


        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* 80% dark overlay */
            z-index: 1;
        }

        .container {
            z-index: 2; /* Position content above the overlay */
        }

        /* SDG Section */
        .sdg-section {
            background-color: #28a745; /* Light green background for SDG section */
            padding-top: 60px;
        }

        .sdg-icon-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .lead {
            font-size: 1rem;
            margin-top: 10px;
        }

        /* Custom style for the heading */
        .sdg-heading {
            font-size: 1.75rem; /* Slightly smaller heading size */
        }

        .sdg-heading {
            font-size: 2.5rem; /* Increased heading size */
            color: #fff; /* White text color */
        }
        .event-heading {
            font-size: 2.5rem; /* Increased heading size */
            color: #28a745; /* White text color */
        }
        /* Highlight SDG 15 as priority */
        .priority {
            border: 2px solid #28a745; /* Green border for emphasis */
            background-color: white; /* Light green background */
        }

        /* Carousel styles */
        .carousel-item {
            height: 100vh; /* Full height for each carousel item */
            background-size: cover;
            background-position: center;
        }

        .event-image {
        width: 100%; /* Make image full width */
        height: 200px; /* Fixed height for consistency */
        object-fit: cover; /* Ensure the image covers the container */
        border-radius: 10px; /* Optional: rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: add shadow for better look */
    }
    </style>
@endsection