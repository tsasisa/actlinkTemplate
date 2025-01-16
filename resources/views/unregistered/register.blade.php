@extends('layouts.regislogin.regis')

@section('content')
<div class="container-fluid py-5" style="background-color: #28a745;">
    <!-- Motivational Sentence -->
    <h2 class="fw-bold text-white text-center">{{ __('messages.motivational_sentence') }}</h2>
    <!-- Registration Section -->
    <div class="row align-items-center justify-content-center">
        <!-- Left Side: Company Logo -->
        <div class="col-md-5 text-center m-5">
            <img src="{{ asset('assets/images/LogoRegis.jpeg') }}" alt="Company Logo" class="img-fluid mb-4" style="max-width: 50%; height: auto;">
            <div class="text-center">
                <h5 class="fw-bold text-white">{{ __('messages.join_us_today') }}</h5>
                <p class="text-white">{{ __('messages.take_the_first_step') }}</p>
            </div>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="col-md-4 m-5">
            <div class="card shadow">
                <div class="text-center my-4 mb-2">
                    <h5>{{ __('messages.register_now') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.full_name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.enter_full_name') }}" required>
                            <div class="invalid-feedback">{{ __('messages.enter_full_name') }}</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('messages.enter_email') }}" required>
                            <div class="invalid-feedback">{{ __('messages.enter_email') }}</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('messages.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('messages.enter_password') }}" minlength="8" required>
                            <div class="invalid-feedback">{{ __('messages.enter_password') }}</div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('messages.confirm_your_password') }}" minlength="8" required>
                            <div class="invalid-feedback">{{ __('messages.confirm_your_password') }}</div>
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">{{ __('messages.phone_number') }}</label>
                            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror"
                                   id="phoneNumber"
                                   name="phoneNumber"
                                   placeholder="{{ __('messages.enter_phone_number') }}"
                                   pattern="08[0-9]{7,}"
                                   required>
                            <div class="invalid-feedback">{{ __('messages.enter_phone_number') }}</div>
                            @error('phoneNumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="userType" class="form-label">{{ __('messages.register_as') }}</label>
                            <select name="userType" id="userType" class="form-select" onchange="toggleFields(this.value)" required>
                                <option value="" disabled selected>{{ __('messages.select_role') }}</option>
                                <option value="member">{{ __('messages.member') }}</option>
                                <option value="organizer">{{ __('messages.organizer') }}</option>
                            </select>
                            <div class="invalid-feedback">{{ __('messages.select_role') }}</div>
                        </div>

                        <!-- Member-Specific Fields -->
                        <div id="dobField" class="mb-3" style="display: none;">
                            <label for="dob" class="form-label">{{ __('messages.date_of_birth') }}</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                            <div class="invalid-feedback">{{ __('messages.date_of_birth') }}</div>
                        </div>

                        <!-- Organizer-Specific Fields -->
                        <div id="organizerFields" style="display: none;">
                            <div class="mb-3">
                                <label for="organizerAddress" class="form-label">{{ __('messages.organizer_address') }}</label>
                                <input type="text" class="form-control" id="organizerAddress" name="organizerAddress" placeholder="{{ __('messages.enter_organizer_address') }}">
                                <div class="invalid-feedback">{{ __('messages.enter_organizer_address') }}</div>
                            </div>
                        
                            <div class="mb-3">
                                <label for="officialSocialMedia" class="form-label">{{ __('messages.official_social_media') }}</label>
                                <input type="url" class="form-control" id="officialSocialMedia" name="officialSocialMedia" placeholder="{{ __('messages.enter_social_media_url') }}">
                                <div class="invalid-feedback">{{ __('messages.enter_social_media_url') }}</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #28a745;">{{ __('messages.register_button') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>{{ __('messages.already_have_account') }} <a href="{{ route('login') }}">{{ __('messages.login_here') }}</a>.</small>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>


document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // Bootstrap Live Validation
    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            // Dynamically handle validation for hidden fields
            toggleOrganizerFieldValidation();

            if (!form.checkValidity()) {
                event.preventDefault(); // Prevent submission if the form is invalid
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });

    // Role-specific Field Variables
    const userTypeField = document.getElementById('userType');
    const dobField = document.getElementById('dobField');
    const organizerFields = document.getElementById('organizerFields');
    const dobInput = document.getElementById('dob');
    const organizerAddressInput = document.getElementById('organizerAddress');
    const officialSocialMediaInput = document.getElementById('officialSocialMedia');

    // Show/Hide Role-Specific Fields Based on Selected Role
    if (userTypeField) {
        userTypeField.addEventListener('change', function () {
            const selectedRole = userTypeField.value;

            if (selectedRole === 'member') {
                // Show DOB field for Member role
                dobField.style.display = 'block';
                dobInput.required = true;

                // Hide Organizer fields
                organizerFields.style.display = 'none';
                organizerAddressInput.required = false;
                officialSocialMediaInput.required = false;
            } else if (selectedRole === 'organizer') {
                // Show Organizer fields for Organizer role
                organizerFields.style.display = 'block';
                organizerAddressInput.required = true;
                officialSocialMediaInput.required = true;

                // Hide DOB field
                dobField.style.display = 'none';
                dobInput.required = false;
            } else {
                // Hide all role-specific fields for default/other roles
                dobField.style.display = 'none';
                dobInput.required = false;

                organizerFields.style.display = 'none';
                organizerAddressInput.required = false;
                officialSocialMediaInput.required = false;
            }
        });
    }

    // Ensure Hidden Fields Are Not Validated
    function toggleOrganizerFieldValidation() {
        if (userTypeField.value === 'member') {
            organizerAddressInput.required = false;
            officialSocialMediaInput.required = false;
        } else if (userTypeField.value === 'organizer') {
            organizerAddressInput.required = true;
            officialSocialMediaInput.required = true;
        }
    }

    // Confirm Password Validation
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    passwordConfirmation.addEventListener('input', function () {
        if (password.value !== passwordConfirmation.value) {
            passwordConfirmation.setCustomValidity("Passwords do not match.");
        } else {
            passwordConfirmation.setCustomValidity('');
        }
    });
});

</script>
@endsection
