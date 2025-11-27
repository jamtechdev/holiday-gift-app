@extends('layouts.journey')

@section('title', 'Journey Start')

@section('journey-content')
<!-- <h1 class="step-title">Welcome to Your Gift Journey!</h1>
<p class="step-description">Let's find the perfect holiday gifts together</p>
<div class="step-progress">Ready to start?</div>
<a href="{{ route('journey.step', 1) }}" class="next-btn">Start Journey</a> -->
<style>
.video-overlay {
    width: 100%;
    height: 100vh;
    display: block;
}
.journey-container{
    padding: 0px;
}
.video-overlay video {
    object-fit: contain;
    width: 100%;
    height: 100%;
}
video::-webkit-media-controls-start-playback-button {
    display: none;
}
img.overlayImg {
    position: fixed;
    object-fit: contain;
    z-index: 999;
    top: 57%;
    transform: translate(-2%, -51%) scale(0.91);
    left: 0;
    right: 0;
    margin: auto;
}
</style>    
<div class="video-overlay">
<video controls width="100%" height="100%" autoplay controls="false">
    <source src="'{{ asset('images/02_INTRO PAGE.mp4') }}" type="video/mp4">
    <source src="{{ asset('images/02_INTRO PAGE.webm') }}" type="video/webm">
    <!-- Fallback text for browsers that do not support the video tag -->
    Your browser does not support the video tag.
</video>  
<img src="{{ asset('images/02_INTRO PAGE_Gift button.png') }}" class="overlayImg" />
</div>
@endsection