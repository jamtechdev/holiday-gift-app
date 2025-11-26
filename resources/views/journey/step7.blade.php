@extends('layouts.journey')

@section('title', 'Step 7')

@section('journey-content')
<div class="step-progress">Step 7 of 7</div>
<h1 class="step-title">Perfect Matches Found!</h1>
<p class="step-description">Based on your answers, here are our top gift recommendations</p>
<a href="{{ route('user.journey') }}" class="next-btn">View Recommendations</a>
@endsection