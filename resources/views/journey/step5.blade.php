@extends('layouts.journey')

@section('title', 'Step 5')

@section('journey-content')
<!-- <div class="step-progress">Step 5 of 7</div>
<h1 class="step-title">Personal Touch</h1>
<p class="step-description">Would you like something personalized or custom-made?</p>
<a href="{{ route('journey.step', 6) }}" class="next-btn">Continue</a> -->

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
    width: 85%;
    float: right;
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
.boxes a img {
    margin: auto;
    height: auto;
    width: 214px;
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
.boxes p {
    color: #0a0c3f;
    font-size: 20px;
}
.boxes h2 {
    font-size: 28px;
    color: #0a0c3f;
    font-weight: 600;
    line-height: 36px;
    margin-top: 5px;
    margin-bottom: 35px;
}
.boxes h5 {
    color: #0a0c3f;
    font-size: 20px;
}
</style>

<div class="gift-container" style="background-image: url('{{ asset('images/endBg.jpg') }}');">
    <!-- <img src="{{ asset('images/overlayPuzzle.png') }}" class="overlayPuzzle" /> -->

    <div class="giftBox">

        <div class="logoBox">
           <img src="{{ asset('images/silverLogo.png') }}" width="200px" class="logo" />
        </div>

        <div class="boxes">
            <a href="#">
                <img src="{{ asset('images/gift2.png') }}" class="selectedGift" />
            </a>
            <div>
                <h5>You have chosen technology.</h5>
                <h2>Your gift is on the<br> way to you.</h2>
                <p>Thank you for visiting the<br> Graphtech Holiday Store!<br> We hope you enjoy your gift and we<br> wish you a joyful holiday season<br> and a prosperous New Year</p>
            </div>
        </div>

    </div>
</div>
@endsection