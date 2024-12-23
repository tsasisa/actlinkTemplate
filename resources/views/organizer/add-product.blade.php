@extends('layouts.navbar.navbar')
@section('content')
<div class="container my-4">
    <form action="{{route('organizer.create-product')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" id="event-name" name="product-name" required>  
            @error('event-name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <input type="text" class="form-control" id="event-description" name="product-description" required>  
            @error('event-description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" required>  
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" id="event-location" name="product-price" required>  
            @error('event-location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="text" class="form-control" id="event-quota" name="product-quantity" required>  
            @error('event-quota')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection