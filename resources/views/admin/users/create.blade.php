@extends('layouts.admin')

@section('title', 'Add User')
@section('page-title', 'Add User')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="form-group">
            <input type="text" name="first_name" class="form-input" placeholder="First Name" required>
        </div>

        <div class="form-group">
            <input type="text" name="last_name" class="form-input" placeholder="Last Name" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" class="form-input" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-input" placeholder="Password" required>
        </div>

        <div class="form-group">
            <input type="text" name="street_address" class="form-input" placeholder="Street Address">
        </div>

        <div class="form-group">
            <input type="text" name="apt_suite_unit" class="form-input" placeholder="Apt., Suite, Unit">
        </div>

        <div class="form-group">
            <input type="text" name="city" class="form-input" placeholder="City">
        </div>

        <div class="form-group">
            <input type="text" name="state" class="form-input" placeholder="State">
        </div>

        <div class="form-group">
            <input type="text" name="zip" class="form-input" placeholder="Zip">
        </div>

        <div class="form-group">
            <input type="text" name="country" class="form-input" placeholder="Country">
        </div>

        <input type="hidden" name="role" value="user">

        <button type="submit" class="login-btn">Create User</button>
    </form>
</div>
@endsection
