@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Category Name" value="{{ $category->name }}" required>
        </div>
        
        <div class="form-group">
            <textarea name="description" class="form-input" placeholder="Description" rows="3">{{ $category->description }}</textarea>
        </div>
        
        <button type="submit" class="login-btn">Update Category</button>
    </form>
</div>
@endsection