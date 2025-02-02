@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold">{{ __('event.list.page_header') }}</h1>
            <p class="lead">{{ __('event.list.subheader') }}</p>
        </div>
    </section>

     <!-- Search and Filter -->
    <section class="search-filter py-4 bg-light">
        <div class="container">
            <form method="GET" action="{{ route('events.index') }}" class="d-flex justify-content-between align-items-center">
                <!-- Search Input and Button -->
                <div class="d-flex w-50 align-items-center">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control me-2" 
                        placeholder="Search events" 
                        value="{{ request()->get('search') }}"
                    >
                    <button 
                        type="submit" 
                        class="btn btn-success d-flex justify-content-center align-items-center p-0" 
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <!-- Category Filter -->
                <div class="filter-group ms-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <option value="Environment" {{ request()->get('category') == 'Environment' ? 'selected' : '' }}>Environment</option>
                        <option value="Healthcare" {{ request()->get('category') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="Social" {{ request()->get('category') == 'Social' ? 'selected' : '' }}>Social</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <!-- Events List Section -->
    <section class="events-list py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($events as $event)
                <div class="col-md-4">
                    <div class="event-card position-relative overflow-hidden">
                        <!-- Event Image -->
                        <div class="event-image-container">
                            <img src="data:image/png;base64,{{ $event->eventImage }}" alt="Event Image" class="event-image">
                        </div>

                        <!-- Event Details -->
                        <div class="event-details p-4">
                            <!-- Event Name -->
                            <h5 class="event-title text-truncate">{{ $event->eventName }}</h5>

                            <!-- Event Date -->
                            <p class="event-date mb-1">
                                <i class="bi bi-calendar3 text-success"></i> 
                                {{ __('event.list.event_date') }}: {{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}
                            </p>

                            <!-- Event Location -->
                            <p class="event-location mb-1">
                                <i class="bi bi-geo-alt text-success"></i> 
                                {{ __('event.list.event_location') }}: {{ $event->eventLocation }}
                            </p>

                            <!-- Event Participants -->
                            <p class="event-participants fw-bold text-success mb-1">
                                <i class="bi bi-people"></i> 
                                {{ __('event.list.event_participants') }}: {{ $event->eventParticipantNumber }} / {{ $event->eventParticipantQuota }}
                            </p>

                            <!-- Event Points -->
                            <p class="event-points text-muted mb-4">
                                <i class="bi bi-award-fill text-warning"></i> 
                                {{ __('event.list.event_points') }}: {{ $event->eventPoints }}
                            </p>

                            <!-- View Details Button -->
                            <div class="view-details-wrapper">
                                <a href="{{ route('event.detail', ['id' => $event->eventId, 'from' => 'events']) }}" class="btn btn-success">
                                    {{ __('event.list.view_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
    <style>
    body {
        background-color: #f9fafb;
        font-family: 'Roboto', sans-serif;
    }

    .page-header {
        background-color: #28a745;
        color: white;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .event-card {
        display: flex;
        flex-direction: column;
        background-color: white;
        border: 1px solid #e3e6e8;
        border-radius: 12px;
        height: 100%;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .event-image-container {
        height: 200px;
        overflow: hidden;
        border-radius: 12px 12px 0 0;
    }

    .event-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .event-card:hover .event-image {
        transform: scale(1.05);
    }

    .event-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .event-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 0.5rem;
    }

    .event-date, .event-location, .event-description {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .event-description {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 1rem;
    }

    .event-participants {
        font-size: 1rem;
        color: #28a745;
        margin-top: auto;
    }

    .view-details-wrapper {
        margin-top: auto;
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
        .event-card {
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