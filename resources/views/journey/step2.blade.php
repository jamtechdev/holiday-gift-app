@extends('layouts.journey')

@section('title', 'Step 2')

@section('journey-content')
<div class="step-progress">Step 2 of 7</div>
<h1 class="step-title">What's your budget?</h1>
<p class="step-description">Choose a comfortable spending range</p>
<a href="{{ route('journey.step', 3) }}" class="next-btn">Continue</a>
@endsection