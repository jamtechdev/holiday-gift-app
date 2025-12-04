@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="first_name" class="form-input" placeholder="First Name" value="{{ $user->first_name ?? '' }}" required>
        </div>

        <div class="form-group">
            <input type="text" name="last_name" class="form-input" placeholder="Last Name" value="{{ $user->last_name ?? '' }}" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" class="form-input" placeholder="Email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-input" placeholder="New Password (leave blank to keep current)">
        </div>

        <div class="form-group">
            <input type="text" name="street_address" class="form-input" placeholder="Street Address" value="{{ $user->street_address ?? '' }}">
        </div>

        <div class="form-group">
            <input type="text" name="apt_suite_unit" class="form-input" placeholder="Apt., Suite, Unit" value="{{ $user->apt_suite_unit ?? '' }}">
        </div>

        <div class="form-group">
            <input type="text" name="city" class="form-input" placeholder="City" value="{{ $user->city ?? '' }}">
        </div>

        <div class="form-group">
            <input type="text" name="state" class="form-input" placeholder="State" value="{{ $user->state ?? '' }}">
        </div>

        <div class="form-group">
            <input type="text" name="zip" class="form-input" placeholder="Zip" value="{{ $user->zip ?? '' }}">
        </div>

        <div class="form-group">
            <input type="text" name="country" class="form-input" placeholder="Country" value="{{ $user->country ?? '' }}">
        </div>

        <input type="hidden" name="role" value="{{ $user->role }}">

        <button type="submit" class="login-btn">Update User</button>
    </form>
</div>
@endsection
