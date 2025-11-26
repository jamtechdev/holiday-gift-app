@extends('layouts.journey')

@section('title', 'Journey Start')

@section('journey-content')
<h1 class="step-title">Welcome to Your Gift Journey!</h1>
<p class="step-description">Let's find the perfect holiday gifts together</p>
<div class="step-progress">Ready to start?</div>
<a href="{{ route('journey.step', 1) }}" class="next-btn">Start Journey</a>
@endsection