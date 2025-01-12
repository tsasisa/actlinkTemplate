@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    
    @section('content')

    <section class="page-header py-5 text-center text-white" style="position: relative; overflow: hidden; background-image: url('{{ asset('assets/images/hiw1.png') }}'); background-size: cover; background-position: center; min-height: 600px; display: flex; align-items: center; justify-content: center;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 1;"></div>
        <div class="container position-relative text-center" style="z-index: 2; padding: 20px;">
            <h1 class="display-4 fw-bold">How ActLink Works</h1>
            <p class="lead">ActLink is a comprehensive event platform that connects organizers and participants for seamless event discovery, participation, and management.</p>
        </div>
    </section>
<!-- Visual Content Section for Members -->
<section class="visual-content py-5" style="background-color: #28a745;">
    <div class="container">
        <h2 class="content-title mb-3 text-center text-white">For Members</h2>
        <div class="row">
            @foreach(['Register', 'Login', 'View Events', 'Select Event', 'Participate', 'Earn Points'] as $index => $step)
            <div class="col-md-4 mb-4">
                <div class="gif-container" style="text-align: center;">
                    {{-- <img src="{{ asset('assets/images/hiwm' . ($index + 1) . '.gif') }}" alt="{{ $step }}" class="img-fluid" style="margin-bottom: 10px;"> --}}
                    <p class="text-center text-white"><strong>{{ $index + 1 }}. {{ $step }}</strong></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detailed Content Section for Members -->
<section class="detailed-content py-5">
    <div class="container">
        <p class="mb-4">Follow these steps to engage with events that inspire and excite:</p>
        <ol style="color: black; font-size: 1.1rem;">
            <li><strong>Register:</strong> Sign up on ActLink by providing your basic details to create an account.</li>
            <li><strong>Login:</strong> Access your new ActLink account using the credentials you set up.</li>
            <li><strong>View Events:</strong> Browse through a diverse list of events sorted by categories that interest you.</li>
            <li><strong>Select an Event:</strong> Find an event that aligns with your interests and click on it for more details.</li>
            <li><strong>Participate:</strong> Join the event by registering your attendance. You might also be able to interact online if the event supports it.</li>
            <li><strong>Earn Points:</strong> Participate in events and earn points that can be redeemed for future events or exclusive perks.</li>
        </ol>
    </div>
</section>

<!-- Visual Content Section for Organizers -->
<section class="visual-content py-5" style="background-color: #28a745;">
    <div class="container">
        <div class="row">
            @foreach(['Register', 'Login', 'View Events', 'Select Event', 'Participate', 'Earn Points'] as $index => $step)
            <div class="col-md-4 mb-4">
                <div class="gif-container">
                    <!-- Adjusted image source to follow your file naming convention -->
                    <p class="text-center mt-2 text-white"><strong>{{ $index + 1 }}. {{ $step }}</strong></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detailed Content Section for Organizers -->
<section class="detailed-content py-5">
    <div class="container">
        <p class="mb-4">Manage your events efficiently with these structured steps:</p>
        <ol style="color: black; font-size: 1.1rem;">
            <li><strong>Register:</strong> Create an organizer account to start managing your events.</li>
            <li><strong>Login:</strong> Log in to access your organizer dashboard.</li>
            <li><strong>Create Event:</strong> Set up a new event by providing all necessary details like date, location, and participant quota.</li>
            <li><strong>Publish Event:</strong> Once your event is ready, publish it on ActLink to make it visible to potential participants.</li>
            <li><strong>Manage Participants:</strong> Track registrations, manage attendee lists, and update event details as needed.</li>
            <li><strong>Feedback and Points:</strong> After the event, gather feedback from participants and earn reputation points based on their satisfaction and engagement.</li>
        </ol>
    </div>
</section>



    

    <style>
    body {
        background-color: #f9fafb;
        font-family: 'Roboto', sans-serif;
    }

    .page-header {

    }

    .content-card {
        display: flex;
        flex-direction: column;
        background-color: white;
        border: 1px solid #e3e6e8;
        border-radius: 12px;
        height: 100%;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .content-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .image-container {
        height: 200px;
        overflow: hidden;
        border-radius: 12px 12px 0 0;
    }

    .content-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .content-card:hover .content-image {
        transform: scale(1.05);
    }

    .content-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .content-title {
        font-size: 1.75rem;  /* Increased to make section headers more prominent */
        font-weight: bold;
        color: #343a40;
        margin-bottom: 1rem;
    }

    ol {
        font-size: 1.1rem;
        margin-left: 20px;
        color: #343a40;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: background-color 0.3s, transform 0.2s;
        width: 100%;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.02);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-card {
            margin-bottom: 20px;
        }
    }

    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        color: #28a745;
        border-color: #28a745;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #28a745;
        color: white;
        border-color: #218838;
    }

    .pagination .page-item.active .page-link {
        background-color: #28a745;
        color: white;
        border-color: #28a745;
    }
    </style>
@endsection
