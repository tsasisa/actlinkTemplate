<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        .navbar {
            background-color: white !important;
        }

        .navbar-nav .nav-link {
            font-family: 'Roboto', sans-serif !important;
            font-size: 1rem;
            font-weight: 500;
        }

        .navbar-brand img {
            width: 98px;
        }

        .btn-green {
            background-color: #28a745; /* Green color */
            color: white;
        }

        .btn-green:hover {
            background-color: #218838; /* Darker green on hover */
            color: white;
        }
    </style>
    <title>ActLink</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <!-- Company Logo on the Left -->
            <a class="navbar-brand me-auto" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </a>

            <!-- Hamburger Menu for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centered Navigation Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('events') ? 'active' : '' }}" href="/events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('how-it-works') ? 'active' : '' }}" href="/how-it-works">How it Works</a>
                    </li>
                </ul>
            </div>

            <!-- Register/Login Section on the Right -->
            <!-- User Account Section -->
            <div class="ms-auto d-flex align-items-center">
                @auth
                    <!-- My Profile Icon -->
                    <a href="/profile" class="me-3">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem; color: #28a745;"></i>
                    </a>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @else
                    <!-- Register and Login Buttons -->
                    <a href="/register" class="btn btn-green me-2">Register</a>
                    <a href="/login" class="btn btn-outline-success">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')
    
<!-- Footer Section -->
<footer class="footer py-4" style="background-color: #28a745; color: white;">
    <div class="container">
        <div class="row">
            <!-- Footer Column 1: Logo -->
            <div class="col-3 my-4 text-center">
                <!-- ActLink Logo -->
                <img src="{{ asset('assets/images/Logo.png') }}" alt="ActLink Logo" class="footer-logo" style="max-width: 150px;">
            </div>
            
            <!-- Footer Column 2: About ActLink -->
            <div class="col-md-3 mb-4">
                <h5 class="footer-title">About ActLink</h5>
                <p>ActLink is a platform that connects individuals with meaningful events focused on sustainability and social causes.</p>
            </div>

            <!-- Footer Column 3: Quick Links -->
            <div class="col-md-3 mb-4">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#events" class="text-white">Events</a></li>
                    <li><a href="#sdgs" class="text-white">How it works</a></li>
                    <li><a href="#contact" class="text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Footer Column 4: Social Media -->
            <div class="col-md-3 mb-4">
                <h5 class="footer-title">Follow Us</h5>
                <div class="social-icons">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="text-left mt-4 text-center">
        <p>&copy; {{ date('Y') }} ActLink. All Rights Reserved.</p>
    </div>
</footer>

<!-- Add Bootstrap Icons (for social media icons) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
