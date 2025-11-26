@extends('layouts.journey')

@section('title', 'Step 3')

@section('journey-content')
<div class="step-progress">Step 3 of 7</div>
<h1 class="step-title">What are their interests?</h1>
<p class="step-description">Select categories that match their hobbies and preferences</p>
<a href="{{ route('journey.step', 4) }}" class="next-btn">Continue</a>
@endsection