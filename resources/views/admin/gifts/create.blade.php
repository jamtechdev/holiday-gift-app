@extends('layouts.admin')

@section('title', 'Add Gift')
@section('page-title', 'Add Gift')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.gifts.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <select name="category_id" class="form-input" required>
                <option value="">Select Gift Label</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Gift Name" value="{{ old('name') }}" required>
            @error('name')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Gift Images</label>
            <input type="file" name="images[]" class="form-input" accept="image/*" multiple required>
            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">You can select multiple images. They will be displayed in a swiper on the frontend.</p>
            @error('images')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
            @error('images.*')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="submit-btn">Create Gift</button>
    </form>
</div>
@endsection