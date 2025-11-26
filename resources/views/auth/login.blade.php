@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container" style="background-image: url('{{ asset('images/login.png') }}');">
    <div class="puzzle-form-container">
        <form method="POST" action="/" class="puzzle-form">
            @csrf
            
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
            
            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
</div>
@endsection