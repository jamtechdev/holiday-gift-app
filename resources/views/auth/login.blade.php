@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="holiday-background">
        <div class="holiday-greeting">
            <h1 class="greeting-text">WE WISH YOU A VERY HAPPY HOLIDAYS</h1>
            <p class="greeting-subtext">ENJOY A HOLIDAY GIFT FROM US AT <span class="graphtech-logo">graphtech</span></p>
        </div>
        
        <div class="login-card puzzle-piece">
            <form method="POST" action="/">
                @csrf
                
                <div class="form-group remember-me-group">
                    <label class="remember-me-label">
                        <input type="checkbox" name="remember" class="remember-me-checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <span class="remember-me-text">Remember Me</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <input type="email" 
                           name="email" 
                           class="form-input" 
                           placeholder="USERNAME" 
                           value="{{ old('email') }}" 
                           required>
                </div>
                
                <div class="form-divider"></div>
                
                <div class="form-group">
                    <input type="password" 
                           name="password" 
                           class="form-input" 
                           placeholder="PASSWORD" 
                           required>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
                
                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
        </div>
        
        <div class="sign-in-callout">
            <p>PLEASE SIGN IN HERE TO RECEIVE YOUR GIFT</p>
        </div>
    </div>
</div>
@endsection