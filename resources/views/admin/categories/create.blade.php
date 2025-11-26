@extends('layouts.admin')

@section('title', 'Add Category')
@section('page-title', 'Add Category')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Category Name" required>
        </div>
        
        <div class="form-group">
            <textarea name="description" class="form-input" placeholder="Description" rows="3"></textarea>
        </div>
        
        <button type="submit" class="login-btn">Create Category</button>
    </form>
</div>
@endsection