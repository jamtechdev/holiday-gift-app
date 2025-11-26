@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="login-container">
    <div class="login-card">
        <h1 class="login-title">Admin Login</h1>
        
        <form method="POST" action="/admin/login">
            @csrf
            
            <div class="form-group">
                <input type="email" 
                       name="email" 
                       class="form-input" 
                       placeholder="Admin Email" 
                       value="{{ old('email') }}" 
                       required>
            </div>
            
            <div class="form-group">
                <input type="password" 
                       name="password" 
                       class="form-input" 
                       placeholder="Password" 
                       required>
            </div>
            
            <button type="submit" class="login-btn">Admin Login</button>
            
            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
</div>
@endsection