@extends('layouts.journey')

@section('title', 'Step 3')

@section('journey-content')
<!-- <div class="step-progress">Step 3 of 7</div>
<h1 class="step-title">What are their interests?</h1>
<p class="step-description">Select categories that match their hobbies and preferences</p>
<a href="{{ route('journey.step', 4) }}" class="next-btn">Continue</a> -->
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
    gap: 66px;
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
    min-width: 240px;
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
.selectedGift {
    max-width: 120px;
}
.boxes a img {
    margin: auto;
    height: auto;
}
.choose {
    max-width: 220px;
    margin-top: 34px !important;
}
.boxes button {
    font-size: 22px;
}
.backBtn {
    max-width: 78%;
    margin: 50px auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.back {
    width: 172px;
    margin-top: 100px;
}
.price {
    font-size: 56px;
    display: block;
    text-align: center;
    color: #dcd08f;
    font-weight: 600;
}
.price sup {
    margin-right: 12px;
    font-size: 36px;
}
</style>

<div class="gift-container" style="background-image: url('{{ asset('images/techBg.jpg') }}');">
    <!-- <img src="{{ asset('images/overlayPuzzle.png') }}" class="overlayPuzzle" /> -->

    <div class="giftBox">

        <div class="logoBox">
           <img src="{{ asset('images/logo-golden.png') }}" class="logo" />
        </div>

        <div class="boxes">
            <a href="#">
                <img src="{{ asset('images/headphone.png') }}" class="giftbox"/>
            </a>
            <a href="{{ route('journey.step', 4) }}">
                <img src="{{ asset('images/gift2.png') }}" class="selectedGift" />
                <img src="{{ asset('images/techno.png') }}" class="choose"/>
            </a>
            <a href="#">
                <button>Add Details</button>
            </a>  
        </div>

        <div class="backBtn">
          <a href="#">

          </a>
          <a href="{{ route('journey.step', 2) }}">
            <img src="{{ asset('images/back.png') }}" class="back" />
          </a>
          <a href="#">

          </a>
        </div>

    </div>
</div>
@endsection