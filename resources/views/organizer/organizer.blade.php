@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
   
    
    <h1 class="page-title">Recently Created Events</h1>
    <a href="{{ route('organizer.manage-event') }}"><button type="button" class="btn btn-success my-3">Manage Event</button></a>
    <a href="{{ route('organizer.create-product') }}"><button type="button" class="btn btn-success my-3">Add Product</button></a>
    
    <section class="latest-events ">
    <div class="container text-center">
        <h4 class="event-heading fw-bold mb-4"></h4>
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4">
                <div class="event-card p-4 mb-1">
                    <!-- Event Image -->
                    <img src="data:image/png;base64,{{ $event->eventImage }}" alt="Event Image" class="event-image img-fluid mb-3">
                    
                    <h5 class="event-title">{{ $event->eventName }}</h5>
                    <p class="event-date">{{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}</p>
                    <p class="event-location">{{ $event->eventLocation }}</p>
                    <p class="event-description">{{ str($event->eventDescription)->limit(100) }}</p>
                    <p class="event-organizer">Organized by: {{ $event->organizer->user->userName }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
                {{ $events->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
</div>

<style>
        /* Hero Section */
        .hero {
            height: 100vh; /* Full viewport height */
            position: relative;
        }
        .latest-events {
            background-color: white;
        }

        .page-title {
            font-family: 'Roboto', sans-serif !important;
            font-size: 2.5rem;
            font-weight: 500;
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

        .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: background-color 0.3s, transform 0.2s;
    }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.02);
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