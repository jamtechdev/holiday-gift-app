@extends('layouts.journey')

@section('title', 'Journey Start')

@section('journey-content')
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
    object-fit: cover;
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
.three {
  -webkit-animation-delay: 1.5s;
  -moz-animation-delay: 1.5s;
  animation-delay: 2s;
}
.four {
  -webkit-animation-delay: 3.5s;
  -moz-animation-delay: 3.5s;
  animation-delay: 4s;
}
.three img {
    max-width: 296px;
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
.next-btn{
    background: transparent!important;
    box-shadow: none!important;
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
.runner {
    width: 100%;
    height: 70px;
    position: absolute;
    animation-name: run-left-to-right;
    animation-duration: 3s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    bottom: 1px;
    object-fit: cover;
    object-position: left;
    animation-iteration-count: 1; /* Ensures it runs only once */
}
.video-overlay {
    width: 100%;
    height: 100vh;
    display: block;
    max-width: 1140px;
    margin: 0px auto;
    overflow: hidden;
    position: relative;
}
@keyframes run-left-to-right {
  0% {
    left: -1145px;
  }
  100% {
    left: calc(100% - 50px);
  }
}
/* 2. Apply the Animation to an Element */
.animated-box {
  /* Animation Properties */
  animation-name: slideAndChange;
  animation-duration: 3s; /* This is the key: the animation will complete and stop after 3 seconds. */
  animation-fill-mode: forwards; /* This is important: it ensures the element stays in its final (100%) state. */
  animation-timing-function: ease-in-out; /* Smooth start and end */
}
@keyframes slideAndChange {
  0% {
    transform: translateX(-1140px);
  }
  100% {
    transform: translateX(10px); /* Move 300px to the right */
  }
}

@media screen and (max-width: 767px){
  @keyframes slideAndChange {
    0% {
      transform: translateX(-1140px);
    }
    100% {
      transform: translateX(-100px); /* Move 300px to the right */
    }
  }
}
</style>    

<div class="video-overlay">
<!-- <video controls width="100%" height="100%" autoplay controls="false">
    <source src="'{{ asset('images/02_INTRO PAGE.mp4') }}" type="video/mp4">
    <source src="{{ asset('images/02_INTRO PAGE.webm') }}" type="video/webm">
</video>   -->
<img src="{{ asset('images/landing.png') }}" class="bgImage" />

<div class="box animate fadeInUp three">
    <img src="{{ asset('images/welcome.png') }}" class="overlayImg" />
</div>

<div class="box animate fadeInRight four">
  <a href="{{ route('user.gift.categories') }}" class="next-btn">
    <img src="{{ asset('images/02_INTRO PAGE_Gift button.png') }}" class="overlayImg" />
  </a>  
</div>

<!-- <div class="box animate fadeInUp one">
    <img src="{{ asset('images/puzzle1.png') }}" class="overlayImg" />
</div>

<div class="box animate fadeInDown two">
    <img src="{{ asset('images/puzzle2.png') }}" class="overlayImg" />
</div> -->

<img src="{{ asset('images/train.png') }}" class="runner animated-box" />


</div>
@endsection