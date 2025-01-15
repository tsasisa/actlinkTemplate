@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    
    @section('content')

<!-- How ActLink Works Section -->
<section class="page-header py-5 text-center text-white" style="position: relative; overflow: hidden; background-image: url('{{ asset('assets/images/hiw1.png') }}'); background-size: cover; background-position: center; min-height: 600px; display: flex; align-items: center; justify-content: center;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 1;"></div>
    <div class="container position-relative text-center" style="z-index: 2; padding: 20px;">
        <h1 class="display-4 fw-bold">{{ __('messages.how_actlink_works_title') }}</h1>
        <p class="lead">{{ __('messages.how_actlink_works_description') }}</p>
    </div>
</section>

<!-- Visual Content Section for Members -->
<section class="visual-content py-5" style="background-color: #28a745;">
    <div class="container">
        <h2 class="content-title mb-3 text-center text-white">{{ __('messages.for_members_title') }}</h2>
        <div class="row">
            @foreach(['register', 'login', 'view_events', 'select_event', 'participate', 'earn_points'] as $index => $step)
            <div class="col-md-4 mb-4">
                <div class="gif-container" style="text-align: center;">
                    <p class="text-center text-white"><strong>{{ $loop->iteration }}. {{ __( 'messages.' . $step) }}</strong></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detailed Content Section for Members -->
<section class="detailed-content py-5">
    <div class="container">
        <p class="mb-4">{{ __('messages.register_description') }}</p>
        <ol style="color: black; font-size: 1.1rem;">
            <li><strong>{{ __('messages.register') }}:</strong> {{ __('messages.register_description') }}</li>
            <li><strong>{{ __('messages.login') }}:</strong> {{ __('messages.login_description') }}</li>
            <li><strong>{{ __('messages.view_events') }}:</strong> {{ __('messages.view_events_description') }}</li>
            <li><strong>{{ __('messages.select_event') }}:</strong> {{ __('messages.select_event_description') }}</li>
            <li><strong>{{ __('messages.participate') }}:</strong> {{ __('messages.participate_description') }}</li>
            <li><strong>{{ __('messages.earn_points') }}:</strong> {{ __('messages.earn_points_description') }}</li>
        </ol>
    </div>
</section>

<!-- Visual Content Section for Organizers -->
<section class="visual-content py-5" style="background-color: #28a745;">
    <div class="container">
        <h2 class="content-title mb-3 text-center text-white">{{ __('messages.for_organizers_title') }}</h2>
        <div class="row">
            @foreach(['register', 'login', 'view_events', 'select_event', 'participate', 'earn_points'] as $index => $step)
            <div class="col-md-4 mb-4">
                <div class="gif-container">
                    <p class="text-center mt-2 text-white"><strong>{{ $loop->iteration }}. {{ __( 'messages.' . $step) }}</strong></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detailed Content Section for Organizers -->
<section class="detailed-content py-5">
    <div class="container">
        <p class="mb-4">{{ __('messages.register_description') }}</p>
        <ol style="color: black; font-size: 1.1rem;">
            <li><strong>{{ __('messages.register') }}:</strong> {{ __('messages.register_description') }}</li>
            <li><strong>{{ __('messages.login') }}:</strong> {{ __('messages.login_description') }}</li>
            <li><strong>{{ __('messages.create_event') }}:</strong> {{ __('messages.create_event') }}</li>
            <li><strong>{{ __('messages.publish_event') }}:</strong> {{ __('messages.publish_event') }}</li>
            <li><strong>{{ __('messages.manage_participants') }}:</strong> {{ __('messages.manage_participants') }}</li>
            <li><strong>{{ __('messages.feedback_and_points') }}:</strong> {{ __('messages.feedback_and_points') }}</li>
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
