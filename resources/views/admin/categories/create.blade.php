@extends('layouts.admin')

@section('title', 'Add Gift Label')
@section('page-title', 'Add Gift Label')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Gift Label Name" required>
        </div>
        
        <div class="form-group">
            <input type="file" name="image" class="form-input" accept="image/*">
        </div>
        
        <button type="submit" class="login-btn">Create Gift Label</button>
    </form>
</div>
@endsection