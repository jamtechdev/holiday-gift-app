@extends('layouts.journey')

@section('title', 'Step 1')

@section('journey-content')
<!-- <div class="step-progress">Step 1 of 7</div>
<h1 class="step-title">Who are you shopping for?</h1>
<p class="step-description">Tell us about the special person you're buying a gift for</p>
<a href="{{ route('journey.step', 2) }}" class="next-btn">Continue</a> -->
<style>
.journey-page {
    padding: 0px;
}
img.top_frame {
    width: 100%;
    margin: 0px auto;
    height: 100%;
}
.gift-container {
    width: 100%;
    height: 100vh;
    max-width: 1140px;
    margin: 0px auto;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}
img.overlayPuzzle {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 99;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.logoBox {
    padding-top: 44px;
}
.logoBox img{
    margin: auto;
}
.logoBox {
    text-align: center;
}
.boxes {
    gap: 10px;
    display: flex;
    justify-content: center;
    margin-top: 69px;
}
.boxes img {
    width: 280px;
    height: 280px;
    object-fit: contain;
}
.giftBox {
    position: relative;
    z-index: 99;
}
.boxes a {
    position: relative;
}
.Donation {
    max-width: 120px;
    position: absolute;
    top: -62px;
    height: auto !important;
    left: 41px;
}
.Technology {
    max-width: 144px;
    position: absolute;
    bottom: -61px;
    height: auto !important;
    right: 23px;
}
.Merchandise {
    max-width: 144px;
    position: absolute;
    top: -56px;
    height: auto !important;
    right: 1px;
}
</style>

<div class="gift-container" style="background-image: url('{{ asset('images/center.png') }}');">
    <img src="{{ asset('images/overlayPuzzle.png') }}" class="overlayPuzzle" />

    <div class="giftBox">
        <div class="logoBox">
           <img src="{{ asset('images/logo-golden.png') }}" class="logo" />
        </div>

        <div class="boxes">
            <a href="{{ route('journey.step', 2) }}">
                <img src="{{ asset('images/Donation.png') }}" class="Donation" />     
                <img src="{{ asset('images/gift1.png') }}" />
            </a>
            <a href="{{ route('journey.step', 2) }}">
                <img src="{{ asset('images/Technology.png') }}" class="Technology" />  
                
                <img src="{{ asset('images/gift2.png') }}" />
            </a>
            <a href="{{ route('journey.step', 2) }}">
                <img src="{{ asset('images/Merchandise.png') }}" class="Merchandise" />  
                <img src="{{ asset('images/gift3.png') }}" />
            </a>  
        </div>
    </div>
</div>

@endsection