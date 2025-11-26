@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Full Name" value="{{ $user->name }}" required>
        </div>
        
        <div class="form-group">
            <input type="email" name="email" class="form-input" placeholder="Email" value="{{ $user->email }}" required>
        </div>
        
        <div class="form-group">
            <input type="password" name="password" class="form-input" placeholder="New Password (leave blank to keep current)">
        </div>
        
        <div class="form-group">
            <select name="role" class="form-input" required>
                <option value="">Select Role</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        
        <button type="submit" class="login-btn">Update User</button>
    </form>
</div>
@endsection