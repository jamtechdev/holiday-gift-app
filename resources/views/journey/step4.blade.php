@extends('layouts.journey')

@section('title', 'Step 4')

@section('journey-content')
<div class="step-progress">Step 4 of 7</div>
<h1 class="step-title">Gift Type Preference</h1>
<p class="step-description">Do they prefer practical gifts or something more experiential?</p>
<a href="{{ route('journey.step', 5) }}" class="next-btn">Continue</a>
@endsection