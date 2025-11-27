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
.journey-container, .journey-page{
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
/* img.overlayImg {
    position: fixed;
    object-fit: contain;
    z-index: 999;
    top: 57%;
    transform: translate(-2%, -51%) scale(0.91);
    left: 0;
    right: 0;
    margin: auto;
} */
img.bgImage {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.box {
    font-size: 14px;
    font-weight: 600;
    padding: 20px;
    text-transform: uppercase;
    position: fixed;
    z-index: 999;
    top: 0;
    bottom: 0px;
    left: 0;
    right: 0;
    margin: auto;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}
.box img{
    margin: auto;
}
/*=== Trigger  ===*/
.animate {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
.four {
  -webkit-animation-delay: 3.5s;
  -moz-animation-delay: 3.5s;
  animation-delay: 1.5s;
}
.one, .two {
    top: auto;
    bottom: 50px;
}
/*==== FADE IN RIGHT ===*/
@-webkit-keyframes fadeInRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}
@keyframes fadeInRight {
  from {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

.fadeInRight {
  -webkit-animation-name: fadeInRight;
  animation-name: fadeInRight;
}

/*=== FADE IN  ===*/
@-webkit-keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}
@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}
.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}
.one {
  -webkit-animation-delay: 0.5s;
  -moz-animation-delay: 0.5s;
  animation-delay: 2.5s;
}
.two {
  -webkit-animation-delay: 1.5s;
  -moz-animation-delay: 1.5s;
  animation-delay: 5.5s;
}
/*==== FADE IN UP ===*/
@-webkit-keyframes fadeInUp {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}
@keyframes fadeInUp {
  from {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

.fadeInUp {
  -webkit-animation-name: fadeInUp;
  animation-name: fadeInUp;
}

/*=== FADE IN DOWN ===*/
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
}
.one .overlayImg, .two .overlayImg {
    max-width: 44%;
}
@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}
@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}
</style>    

<div class="video-overlay">
<!-- <video controls width="100%" height="100%" autoplay controls="false">
    <source src="'{{ asset('images/02_INTRO PAGE.mp4') }}" type="video/mp4">
    <source src="{{ asset('images/02_INTRO PAGE.webm') }}" type="video/webm">
</video>   -->
<img src="{{ asset('images/landing.png') }}" class="bgImage" />

<div class="box animate fadeInRight four">
    <img src="{{ asset('images/02_INTRO PAGE_Gift button.png') }}" class="overlayImg" />
</div>

<!-- <div class="box animate fadeInUp one">
    <img src="{{ asset('images/puzzle1.png') }}" class="overlayImg" />
</div>

<div class="box animate fadeInDown two">
    <img src="{{ asset('images/puzzle2.png') }}" class="overlayImg" />
</div> -->

</div>
@endsection