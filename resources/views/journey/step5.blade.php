@extends('layouts.journey')

@section('title', 'Step 5')

@section('journey-content')
<div class="step-progress">Step 5 of 7</div>
<h1 class="step-title">Personal Touch</h1>
<p class="step-description">Would you like something personalized or custom-made?</p>
<a href="{{ route('journey.step', 6) }}" class="next-btn">Continue</a>
@endsection