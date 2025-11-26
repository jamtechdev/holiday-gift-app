@extends('layouts.admin')

@section('title', 'Edit Gift Label')
@section('page-title', 'Edit Gift Label')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Gift Label Name" value="{{ $category->name }}" required>
        </div>
        
        <div class="form-group">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="Current image" style="max-width: 100px; margin-bottom: 10px;">
            @endif
            <input type="file" name="image" class="form-input" accept="image/*">
        </div>
        
        <button type="submit" class="login-btn">Update Gift Label</button>
    </form>
</div>
@endsection