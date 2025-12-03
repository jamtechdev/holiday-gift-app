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
    max-width: 1440px;
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
    transform: translateX(-1440px);
  }
  100% {
    transform: translateX(10px); /* Move 300px to the right */
  }
}

@media screen and (max-width: 767px){
  @keyframes slideAndChange {
    0% {
      transform: translateX(-1440px);
    }
    100% {
      transform: translateX(-100px); /* Move 300px to the right */
    }
  }
}
@media screen and (min-width:668px) {
   .hidedDesktop{
    display:none;
   }
}
@media screen and (max-width:667.99px) {
    .box img{
        width: 100%;
        max-width: 200px;
        margin: auto
    }
    .hidedMobile{
        display:none;
    }
    @keyframes slideAndChange {
    0% {
      transform: translateX(-667px);
    }
    100% {
      transform: translateX(0px); /* Move 300px to the right */
    }
  }
  .topLogo{

    max-width: 160px !important;

}
}
.topLogo{
    position: absolute;
    left: 0;
    right: 0;
    top: 30px;
    width: 100%;
    max-width: 220px;
    margin: auto;
    z-index: 999;
    filter: drop-shadow(2px 4px 6px black);
}

    form[action*="logout"] {
        position: fixed;
        top: 15px;
        right: 50px;
        z-index: 9999;
        display: inline-block;
    }
    button.logout {
        height: 42px;
        background: #ffff;
        width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #e16539;
        padding: 10px;
        border: 1px solid #e16539;
        cursor: pointer;
    }
    button.logout:hover {
        background: #e16539;
        color: #fff;
        cursor: pointer;
    }
</style>

<div class="video-overlay">
    <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
        </button>
    </form>
<!-- <video controls width="100%" height="100%" autoplay controls="false">
    <source src="'{{ asset('images/02_INTRO PAGE.mp4') }}" type="video/mp4">
    <source src="{{ asset('images/02_INTRO PAGE.webm') }}" type="video/webm">
</video>   -->
<img src="{{ asset('images/logo-1.png') }}" class="topLogo" />
<img src="{{ asset('images/landing.png') }}" class="bgImage" />
<!-- 
<div class="box animate fadeInUp three">
    <img src="{{ asset('images/welcome.png') }}" class="overlayImg" id="welcomeImg" />
</div> -->

<div class="box animate fadeInRight four">
  <a href="{{ route('user.gift.categories') }}" class="next-btn">
    <img src="{{ asset('images/holiday-store-btn.png') }}" class="overlayImg hidedMobile" />
    <img src="{{ asset('images/store-mobile.png') }}" class="overlayImg hidedDesktop" />
  </a>
</div>

<!-- <div class="box animate fadeInUp one">
    <img src="{{ asset('images/puzzle1.png') }}" class="overlayImg" />
</div>

<div class="box animate fadeInDown two">
    <img src="{{ asset('images/puzzle2.png') }}" class="overlayImg" />
</div> -->

<img  src="{{ asset('images/train.png') }}" class="runner animated-box hidedMobile" />
<img src="{{ asset('images/train-mobile.png') }}" class="runner animated-box hidedDesktop" />

</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const welcomeImg = document.getElementById('welcomeImg');
        // Hide image after 3 seconds
        setTimeout(function() {
            if (welcomeImg) {
                welcomeImg.style.opacity = '0';
            }
        }, 5000);
    });
</script>
