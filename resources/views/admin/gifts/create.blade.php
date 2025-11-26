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
            <input type="file" name="image" class="form-input" accept="image/*" required>
            @error('image')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="submit-btn">Create Gift</button>
    </form>
</div>
@endsection