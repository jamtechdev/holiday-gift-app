@extends('layouts.journey')

@section('title', 'Claimed')

@section('journey-content')

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
    max-width: 1440px;
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
    gap: 0px;
    display: flex;
    justify-content: center;
    margin-top: 69px;
    max-width: 85%;
    float: right;
    align-items: center;
}
.cta-text {
    max-width: 55%;
}
.cta-row {
    margin-top: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    max-width: 90%;
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
    width: 164px;
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
.cta-row {
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}
.cta-text p {
    margin: 0;
    color: #0a0c3f;
    font-size: 18px;
    line-height: 1.6;
}
.cta-btn-wrapper {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
}
.email-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 14px 36px;
    border-radius: 999px;
    background: linear-gradient(135deg, #281c66, #4c2fc7);
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    box-shadow: 0 10px 30px rgba(40, 28, 102, 0.4);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.email-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(40, 28, 102, 0.45);
}
.email-note {
    color: #0a0c3f;
    font-size: 13px;
}
.email-note a {
    color: #0a0c3f;
    text-decoration: underline;
    font-weight: 600;
}
@media screen and (min-width:668px) {
    .gift-container{
        background-image: url('{{ asset('images/endBg.jpg') }}');
   }
}
@media screen and (max-width:667.99px) {
    .gift-container{
    background-image: url('{{ asset('images/end-page-bg.jpg') }}');
    background-size: 100% 100%;
    background-position: center;
   }
   .boxes {
    flex-direction: column;
    text-align: center;

}
.giftBox {
    width: 100%;
    float: unset;
    padding: 20px 40px;
}
.logoBox img {
    width: 100%;
    max-width: 115px;
}
.boxes {
    gap: 20px;
    display: flex;
    justify-content: center;
    margin-top: 0;
    align-items: center;
}
.selectedGift {
    width: 100%;
    max-width: 135px;
    margin-top: 20px !important;
}
.boxes h2 br, .boxes p br {
    display: none;
}
.boxes h2 {
    font-size: 18px;
    line-height: normal;
    margin-top: 0;
    margin-bottom: 15px;
}
.boxes h5 {
    color: #0a0c3f;
    font-size: 16px;
}
.boxes p {
    color: #0a0c3f;
    font-size: 12px;
    line-height: normal;
}
.boxes a{
    min-width: unset !important;
}



    .cta-row {
        flex-direction: column;
        align-items: flex-start;
    }
    .cta-btn-wrapper {
        width: 100%;
        align-items: flex-start;
    }
    .email-btn {
        width: 100%;
        justify-content: center;
    }
}
form[method="POST"] {
    position: fixed;
    top: 15px;
    right: 50px;
    z-index: 9999;
    display: inline-block;
}
form[method="POST"] button{
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
form[method="POST"] button:hover {
    background: #e16539;
    color: #fff;
    cursor: pointer;
}
@media screen and (max-width: 667.99px) {
    form[method="POST"] {
        top: 10px;
        right: 15px;
    }
    form[method="POST"] button.logout {
        height: 36px;
        width: 36px;
        padding: 8px;
    }
}
</style>

<div class="gift-container" style="">
    <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout1">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
        </button>
    </form>
    <div class="giftBox">

        <div class="logoBox">
           <img src="{{ asset('images/silverLogo.png') }}" width="200px" class="logo" />
        </div>

        @php
            // Determine which gift image to use based on category name
            $categoryName = strtolower($category->name ?? '');
            $giftImage = 'gift1.png'; // default for donation

            if (strpos($categoryName, 'technology') !== false || strpos($categoryName, 'tech') !== false) {
                $giftImage = 'gift2.png';
            } elseif (strpos($categoryName, 'merchandise') !== false || strpos($categoryName, 'merch') !== false) {
                $giftImage = 'gift3.png';
            } else {
                // Donation or default
                $giftImage = 'gift1.png';
            }

            // Format category name for display
            $displayCategoryName = $category->name ?? 'your selected gift';

            // Use category image from database if available, otherwise use the determined gift image
            $displayImage = $category && $category->image
                ? asset('storage/' . $category->image)
                : asset('images/' . $giftImage);
        @endphp

        @if($category)
        <div class="boxes">
            <a href="#">
                <img src="{{ $displayImage }}" class="selectedGift" alt="{{ $displayCategoryName }}" />
            </a>
            <div>
                <h5>You have chosen {{ strtolower($displayCategoryName) }}.</h5>
                <h2>Your gift is on the<br> way to you.</h2>
                <div class="cta-row">
                    <div class="cta-text">
                        <p>
                            Graphtech is ready to help you drive efficiency, creativity,
                            and measurable results in 2026.<br><br>
                            Let’s start the conversation—your next big initiative could be
                            just one email/meeting away.
                        </p>
                    </div>
                    <div class="cta-btn-wrapper">
                        <a href="mailto:Mike.mikyska@thinkgraphtech.com" class="email-btn">Email</a>
                        <div class="email-note">
                            <a href="mailto:Mike.mikyska@thinkgraphtech.com">Mike.mikyska@thinkgraphtech.com</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @else
        <div class="boxes">
            <a href="#">
                <img src="{{ asset('images/gift1.png') }}" class="selectedGift" alt="Gift" />
            </a>
            <div>
                <h5>You have chosen your gift.</h5>
                <h2>Your gift is on the<br> way to you.</h2>
                <div class="cta-row">
                    <div class="cta-text">
                        <p>
                            Graphtech is ready to help you drive efficiency, creativity,
                            and measurable results in 2026.<br><br>
                            Let’s start the conversation—your next big initiative could be
                            just one email/meeting away.
                        </p>
                    </div>
                    <div class="cta-btn-wrapper">
                        <a href="mailto:Mike.mikyska@thinkgraphtech.com" class="email-btn">Email</a>
                        <div class="email-note">
                            <a href="mailto:Mike.mikyska@thinkgraphtech.com">Mike.mikyska@thinkgraphtech.com</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>
</div>
@endsection
