@extends('layouts.admin')

@section('title', 'Edit Gift')
@section('page-title', 'Edit Gift')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.gifts.update', $gift) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <select name="category_id" class="form-input" required>
                <option value="">Select Gift Label</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $gift->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Gift Name" value="{{ old('name', $gift->name) }}" required>
            @error('name')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            @if($gift->image)
                <div style="margin-bottom: 0.5rem;">
                    <img src="{{ asset('storage/' . $gift->image) }}" alt="{{ $gift->name }}" style="width: 128px; height: 128px; object-fit: cover; border-radius: 8px; border: 1px solid #d1d5db;">
                </div>
            @endif
            <input type="file" name="image" class="form-input" accept="image/*">
            <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #6b7280;">Leave empty to keep current image</p>
            @error('image')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="submit-btn">Update Gift</button>
    </form>
</div>
@endsection