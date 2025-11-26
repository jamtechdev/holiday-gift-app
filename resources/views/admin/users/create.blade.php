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
        
        <div class="form-group">
            <select name="role" class="form-input" required>
                <option value="">Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        
        <button type="submit" class="login-btn">Create User</button>
    </form>
</div>
@endsection