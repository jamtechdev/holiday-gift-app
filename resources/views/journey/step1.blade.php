@extends('layouts.journey')

@section('title', 'Step 1')

@section('journey-content')
<div class="step-progress">Step 1 of 7</div>
<h1 class="step-title">Who are you shopping for?</h1>
<p class="step-description">Tell us about the special person you're buying a gift for</p>
<a href="{{ route('journey.step', 2) }}" class="next-btn">Continue</a>
@endsection