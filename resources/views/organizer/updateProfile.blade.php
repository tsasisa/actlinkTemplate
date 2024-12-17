@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
    <form action="{{ route('organizer.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control"
                    value="{{ $user->userName }}" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="{{ $user->userEmail }}" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="form-control" 
                    value="{{ $user->userPhoneNumber }}" 
                >
            </div>

            <div class="form-group">
                <label for="phone">Address</label>
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    class="form-control" 
                    value="{{ $organizer->organizerAddress }}" 
                >
            </div>

            <div class="form-group">
                <label for="phone">Social Media</label>
                <input 
                    type="text" 
                    id="sosmed" 
                    name="sosmed" 
                    class="form-control" 
                    value="{{ $organizer->officialSocialMedia }}" 
                >
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    
@endsection