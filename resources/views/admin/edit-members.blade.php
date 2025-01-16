@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <!-- Language Switcher -->
                <div class="d-flex flex-row-reverse">
                    <div class="dropdown">
                        <a 
                            href="#" 
                            class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                            id="localeDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                        >
                            <i class="bi bi-globe me-3"></i>
                            <span class="text-dark" style="font-weight: 500;">
                                {{ app()->getLocale() == 'en' ? __('admin.english') : __('admin.indonesia') }}
                            </span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="localeDropdown">
                            <li>
                                <a 
                                    class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" 
                                    href="{{ route('set-locale', 'en') }}"
                                >
                                    {{ __('admin.english') }}
                                </a>
                            </li>
                            <li>
                                <a 
                                    class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}" 
                                    href="{{ route('set-locale', 'id') }}"
                                >
                                    {{ __('admin.indonesia') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <h5 class="card-title mb-4">{{ __('admin.edit_member') }}</h5>

                <!-- Form untuk mengedit member -->
                <form action="{{ route('admin.members.update', $member->memberId) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama -->
                    <div class="form-group">
                        <label for="userName">{{ __('admin.name') }}</label>
                        <input 
                            type="text" 
                            name="userName" 
                            id="userName" 
                            class="form-control @error('userName') is-invalid @enderror" 
                            value="{{ old('userName', $member->user->userName) }}" 
                            required>
                        @error('userName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Phone Number -->
                    <div class="form-group">
                        <label for="userPhoneNumber">{{ __('admin.phone') }}</label>
                        <input 
                            type="text" 
                            name="userPhoneNumber" 
                            id="userPhoneNumber" 
                            class="form-control @error('userPhoneNumber') is-invalid @enderror" 
                            value="{{ old('userPhoneNumber', $member->user->userPhoneNumber) }}">
                        @error('userPhoneNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Date of Birth -->
                    <div class="form-group">
                        <label for="memberDOB">{{ __('admin.date_of_birth') }}</label>
                        <input 
                            type="date" 
                            name="memberDOB" 
                            id="memberDOB" 
                            class="form-control @error('memberDOB') is-invalid @enderror" 
                            value="{{ old('memberDOB', $member->memberDOB) }}">
                        @error('memberDOB')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Points -->
                    <div class="form-group">
                        <label for="memberPoints">{{ __('admin.points') }}</label>
                        <input 
                            type="number" 
                            name="memberPoints" 
                            id="memberPoints" 
                            class="form-control @error('memberPoints') is-invalid @enderror" 
                            value="{{ old('memberPoints', $member->memberPoints) }}">
                        @error('memberPoints')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropdown untuk role (userType) -->
                    <div class="form-group">
                        <label for="userType">{{ __('admin.role') }}</label>
                        <select 
                            name="userType" 
                            id="userType" 
                            class="form-control @error('userType') is-invalid @enderror">
                            <option value="member" {{ $member->user->userType == 'member' ? 'selected' : '' }}>{{ __('admin.member') }}</option>
                            <option value="admin" {{ $member->user->userType == 'admin' ? 'selected' : '' }}>{{ __('admin.admin') }}</option>
                            <option value="organizer" {{ $member->user->userType == 'organizer' ? 'selected' : '' }}>{{ __('admin.organizer') }}</option>
                        </select>
                        @error('userType')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input tambahan untuk Organizer -->
                    <div id="organizerFields" style="display: none;">
                        <div class="form-group">
                            <label for="organizerAddress">{{ __('admin.organizer_address') }}</label>
                            <input 
                                type="text" 
                                name="organizerAddress" 
                                id="organizerAddress" 
                                class="form-control @error('organizerAddress') is-invalid @enderror" 
                                value="{{ old('organizerAddress') }}">
                            @error('organizerAddress')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="officialSocialMedia">{{ __('admin.official_social_media') }}</label>
                            <input 
                                type="text" 
                                name="officialSocialMedia" 
                                id="officialSocialMedia" 
                                class="form-control @error('officialSocialMedia') is-invalid @enderror" 
                                value="{{ old('officialSocialMedia') }}">
                            @error('officialSocialMedia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Save Changes -->
                    <br>
                    <button type="submit" class="btn btn-primary">{{ __('admin.save_changes') }}</button>
                    <a href="{{ route('admin.members.indexMember') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const userTypeDropdown = document.getElementById('userType');
    const organizerFields = document.getElementById('organizerFields');
    const organizerAddressField = document.getElementById('organizerAddress');
    const officialSocialMediaField = document.getElementById('officialSocialMedia');

    function toggleOrganizerFields() {
        if (userTypeDropdown.value === 'organizer') {
            organizerFields.style.display = 'block';
        } else {
            organizerFields.style.display = 'none';
            // Reset nilai jika tidak ada error validasi
            if (!organizerAddressField.classList.contains('is-invalid') && 
                !officialSocialMediaField.classList.contains('is-invalid')) {
                organizerAddressField.value = '';
                officialSocialMediaField.value = '';
            }
        }
    }

    // Jalankan fungsi saat halaman dimuat ulang
    toggleOrganizerFields();

    // Tambahkan event listener untuk perubahan dropdown
    userTypeDropdown.addEventListener('change', toggleOrganizerFields);
});

</script>
@endsection
