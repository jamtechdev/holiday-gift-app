@extends('layouts.admin')

@section('title', 'Add User')
@section('page-title', 'Add User')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Full Name" required>
        </div>
        
        <div class="form-group">
            <input type="email" name="email" class="form-input" placeholder="Email" required>
        </div>
        
        <div class="form-group">
            <input type="password" name="password" class="form-input" placeholder="Password" required>
        </div>
        
        <input type="hidden" name="role" value="user">
        
        <button type="submit" class="login-btn">Create User</button>
    </form>
</div>
@endsection