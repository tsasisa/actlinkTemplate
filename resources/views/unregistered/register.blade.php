@extends('layouts.regislogin.regis')

@section('content')
<div class="container-fluid py-5" style="background-color: #28a745;">
    <!-- Motivational Sentence -->
    <h2 class="fw-bold text-white text-center">ActLink</h2>
    <!-- Registration Section -->
    <div class="row align-items-center justify-content-center">
        <!-- Left Side: Company Logo -->
        <div class="col-md-5 text-center m-5">
            <img src="{{ asset('assets/images/LogoRegis.jpeg') }}" alt="Company Logo" class="img-fluid mb-4" style="max-width: 50%; height: auto;">
            <div class="text-center">
                <h5 class="fw-bold text-white">Join us today and be part of something extraordinary!</h5>
                <p class="text-white">Take the first step toward creating meaningful connections and impactful actions.</p>
            </div>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="col-md-4 m-5">
            <div class="card shadow">
                <div class="text-center my-4 mb-2">
                    <h5>Register Now!</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST" class="needs-validation" novalidate>

                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                            <div class="invalid-feedback">Please enter your full name.</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" minlength="8" required>
                            <div class="invalid-feedback">Password must be at least 8 characters.</div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" minlength="8" required>
                            <div class="invalid-feedback">Passwords do not match.</div>
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" 
                                   id="phoneNumber" 
                                   name="phoneNumber" 
                                   placeholder="Enter your phone number" 
                                   pattern="08[0-9]{7,}" 
                                   required>
                            <div class="invalid-feedback">Phone number must start with 08 and be at least 9 digits long.</div>
                            @error('phoneNumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="userType" class="form-label">Register as</label>
                            <select name="userType" id="userType" class="form-select" onchange="toggleFields(this.value)" required>
                                <option value="" disabled selected>Select a role</option>
                                <option value="member">Member</option>
                                <option value="organizer">Organizer</option>
                            </select>
                            <div class="invalid-feedback">Please select a role.</div>
                        </div>

                        <!-- Member-Specific Fields -->
                        <div id="dobField" class="mb-3" style="display: none;">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                            <div class="invalid-feedback">Please provide your date of birth.</div>
                        </div>

                        <!-- Organizer-Specific Fields -->
                        <div id="organizerFields" style="display: none;">
                            <div class="mb-3">
                                <label for="organizerAddress" class="form-label">Organizer Address</label>
                                <input type="text" class="form-control" id="organizerAddress" name="organizerAddress" placeholder="Enter your organization address">
                                <div class="invalid-feedback">Please provide an organizer address.</div>
                            </div>
                        
                            <div class="mb-3">
                                <label for="officialSocialMedia" class="form-label">Official Social Media</label>
                                <input type="url" class="form-control" id="officialSocialMedia" name="officialSocialMedia" placeholder="Enter official social media URL">
                                <div class="invalid-feedback">Please provide a valid URL for your organization's social media.</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #28a745;">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Already have an account? <a href="{{ route('login') }}">Login here</a>.</small>
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
