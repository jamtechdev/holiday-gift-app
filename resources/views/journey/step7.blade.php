@extends('layouts.journey')

@section('title', 'Step 7')

@section('journey-content')
<div class="step-progress">Final Step</div>
<h1 class="step-title">Thanks for Completing Your Journey!</h1>
<p class="step-description">
    We’re wrapping your personalized holiday recommendations. You can log out now and return anytime
    to keep the festive magic going.
</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="next-btn">Logout</button>
</form>
@endsection