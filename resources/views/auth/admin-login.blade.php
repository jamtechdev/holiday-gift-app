@extends('layouts.app')

@section('title', 'Admin Login')

@push('styles')
@vite(['resources/css/admin-login.css'])
<style>
.login-container {
    background-image: linear-gradient(120deg, rgba(83, 233, 108, 0.8), rgba(251, 113, 133, 0.8)), url('{{ asset('images/landing.png') }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    width: 100%;
}

.login-card {
    opacity: 0;
    animation: fadeIn 0.5s ease-in-out 1.5s forwards;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="header">
            <span class="badge">Admin Access</span>
            <div class="gift-icon">🎁</div>
            <h1 class="title">Admin Login</h1>
            <p class="subtitle">Welcome back! Please sign in to continue.</p>
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" placeholder="admin@example.com" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Enter your password" autocomplete="off" required>
            </div>

            <button type="submit" class="submit-btn">Sign In</button>
        </form>

        <div class="features">
            <span class="feature">Secure</span>
            <span class="feature">Encrypted</span>
            <span class="feature">24/7</span>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show admin login errors in toastr
    @if ($errors->any())
        toastr.error('{{ $errors->first() }}', 'Login Error', {
            timeOut: 6000,
            progressBar: true
        });
    @endif
});
</script>
@endpush
@endsection