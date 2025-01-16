
@extends('layouts.regislogin.regis')

@section('content')
<div class="container-fluid py-5" style="background-color: #28a745;">
    <!-- Motivational Sentence -->
    <h2 class="fw-bold text-white text-center">{{ __('messages.login_title') }}</h2>

    <!-- Login Section -->
    <div class="row align-items-center justify-content-center">
        <!-- Right Side: Login Form -->
        <div class="col-md-4 m-5">
            <div class="card shadow">
                <div class="row my-4 mb-2">
                    <div class="col-10">
                        <h3 class="ms-3">{{ __('messages.login_header') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Step 1: Enter Email -->
                    <div id="step1">
                        <form id="checkEmailForm" onsubmit="event.preventDefault(); checkEmail();">
                            <div class="mb-3">
                                <label for="step1-email" class="form-label">{{ __('messages.email_address') }}</label>
                                <input type="email" class="form-control" id="step1-email" name="email" placeholder="{{ __('messages.enter_email') }}" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-white" style="background-color: #28a745;">{{ __('messages.next_button') }}</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Step 2: Enter Password -->
                    <div id="step2" style="display: none;">
                        <form id="loginForm" action="{{ route('login.submit') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" id="email" name="email" value="{{ old('email') }}">
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('messages.password') }}</label>
                                <input type="password" class="form-control mb-lg-5" id="password" name="password" placeholder="{{ __('messages.enter_password') }}" required>
                                <div class="invalid-feedback">{{ __('messages.enter_password') }}</div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn text-white" style="background-color: #28a745;">{{ __('messages.login_button') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small>{{ __('messages.no_account') }} <a href="{{ route('register.index') }}">{{ __('messages.register_here') }}</a>.</small>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function checkEmail() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found.');
        alert('CSRF token is missing. Please check your HTML layout.');
        return;
    }

    const email = document.getElementById('step1-email').value;

    fetch('{{ route("login.checkEmail") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.content, // Use the token content
        },
        body: JSON.stringify({ email: email }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            document.getElementById('email').value = email; // Set email in hidden input
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
        } else {
            alert('Email not found. Please register first.');
        }
    })

}

</script>
@endsection