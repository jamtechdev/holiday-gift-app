@extends('layouts.journey')

@section('title', 'Step 6')

@section('journey-content')
<div class="step-progress">Step 6 of 7</div>
<h1 class="step-title">Delivery Timeline</h1>
<p class="step-description">When do you need this gift delivered?</p>
<a href="{{ route('journey.step', 7) }}" class="next-btn">Continue</a>
@endsection