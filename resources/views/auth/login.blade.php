@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
.puzzle-form-container {
    position: absolute;
    max-width: 50%;
    margin: 0px auto;
    left: 0;
    right: 0;
    top: 50%;
    transform: translate(-1%, -21%);
    background-size: cover;
    padding: 40px 40px;
    min-height: 374px;
}
input {
    background: linear-gradient(to right, #2d2b2d, #444447) !important;
    border: 3px solid #58595b !important;
    border-radius: 8px !important;
    margin-top: 9px;
}
.remember_me {
    font-size: 18px;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: cursive;
    justify-content: space-between;
}
.remember_me input {
    width: 24px;
    height: 19px;
    margin-top: 0;
}
.remember_me div {
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>
<div class="login-container" style="background-image: url('{{ asset('images/login.png') }}');background-size: contain;">
    <div class="puzzle-form-container" style="background-image: url('{{ asset('images/puzzle.png') }}');">
        <form method="POST" action="/" class="puzzle-form">
            @csrf
            
            <div class="form-group">
                <input type="email" 
                       name="email" 
                       class="form-input" 
                       placeholder="USERNAME" 
                       value="{{ old('email') }}" 
                       required />
            </div>

            
            <div class="form-group">
                <input type="password" 
                       name="password" 
                       class="form-input" 
                       placeholder="PASSWORD" 
                       required />
            </div>

            <div class="remember_me">
               <div>
                 <input type="checkbox" /> I accept terms & conditions
               </div>
               <button>Login</button>
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