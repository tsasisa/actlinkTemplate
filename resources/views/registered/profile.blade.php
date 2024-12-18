@extends('layouts.navbar.navbar')

@section('content')
    <section class="profile-header py-5 text-center text-white animate__animated animate__fadeInDown">
        <div class="container">
            <h1 class="display-4 fw-bold">🎭 {{ $user->userName }}'s Profile</h1>
        </div>
    </section>

    <section class="profile-details py-5">
        <div class="container animate__animated animate__fadeInUp">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card profile-card shadow-lg border-0">
                        <div class="profile-image text-center position-relative py-4">
                            @if($user->userImage)
                                <img src="data:image/png;base64,{{ $user->userImage }}"
                                    alt="Profile Image"
                                    class="rounded-circle border border-4 border-success shadow-lg"
                                    width="150" height="150">
                            @else
                                <img src="https://via.placeholder.com/150"
                                    alt="Default Image"
                                    class="rounded-circle border border-4 border-success shadow-lg"
                                    width="150" height="150">
                            @endif
                            <h3 class="mt-3 fw-bold text-success">{{ $user->userName }}</h3>
                            <p class="text-muted">{{ ucfirst($user->userType) }}</p>
                        </div>

                        <div class="card-body">
                            <div class="info-section mb-4">
                                <h5 class="fw-bold text-success"><i class="bi bi-person-circle"></i> Basic Information</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Email:</strong> {{ $user->userEmail }}</li>
                                    <li><strong>Phone:</strong> {{ $user->userPhoneNumber ?? 'N/A' }}</li>
                                </ul>
                            </div>

                            @if($member)
                                <div class="info-section mb-4 animate__animated animate__fadeInLeft">
                                    <h5 class="fw-bold text-primary"><i class="bi bi-award-fill"></i> Member Details</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Date of Birth:</strong> {{ $member->memberDOB }}</li>
                                        <li><strong>Points:</strong>
                                            <span class="badge bg-success fs-6">{{ $member->memberPoints }} XP</span>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            @if($organizer)
                                <div class="info-section mb-4 animate__animated animate__fadeInRight">
                                    <h5 class="fw-bold text-warning"><i class="bi bi-briefcase-fill"></i> Organizer Details</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Address:</strong> {{ $organizer->organizerAddress }}</li>
                                        <li><strong>Social Media:</strong> 
                                            <a href="{{ $organizer->officialSocialMedia }}" target="_blank" class="text-primary">
                                                {{ $organizer->officialSocialMedia }}
                                            </a>
                                        </li>
                                        <li><strong>Status:</strong>
                                            @if($organizer->activeFlag)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        @if ($organizer)
                            <div class="card-footer text-center bg-light py-3">
                                <a href="{{ route('organizer.updateProfile') }}" class="btn btn-outline-success btn-lg animate__animated animate__pulse animate__infinite">Edit Profile</a>
                            </div>
                        @else
                        <div class="card-footer text-center bg-light py-3">
                            <a href="#" class="btn btn-outline-success btn-lg animate__animated animate__pulse animate__infinite">Edit Profile</a>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        /* Header Section */
        .profile-header {
            background: linear-gradient(135deg, #28a745, #218838);
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Profile Card */
        .profile-card {
            border-radius: 20px;
            overflow: hidden;
        }

        .profile-image img {
            transition: transform 0.3s ease;
        }

        .profile-image img:hover {
            transform: scale(1.1);
        }

        .info-section h5 {
            border-bottom: 2px solid #28a745;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .badge {
            font-size: 0.95rem;
        }

        .btn-outline-success {
            transition: all 0.3s ease;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: #fff;
            transform: translateY(-3px);
        }
    </style>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
@endsection
