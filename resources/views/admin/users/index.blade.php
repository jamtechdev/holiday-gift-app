@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('admin-content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h3>All Users</h3>
        <a href="{{ route('admin.users.create') }}" class="next-btn">Add User</a>
    </div>

    @foreach($users as $user)
        <div class="admin-list-row">
            <div class="admin-list-main">
                <div class="admin-list-title">{{ $user->name }}</div>
                <div class="admin-list-text">{{ $user->email }}</div>
                <div class="admin-list-meta">Role: {{ ucfirst($user->role) }}</div>
            </div>
            <div class="admin-list-actions">
                <a href="{{ route('admin.users.edit', $user) }}" class="next-btn">Edit</a>
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="logout-btn">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection