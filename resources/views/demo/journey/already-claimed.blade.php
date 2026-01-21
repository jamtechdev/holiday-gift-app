@extends('layouts.journey')

@section('title', 'Already Claimed')

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
.boxes p a {
    color: #0a0c3f;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    border-bottom: 2px solid rgba(220, 208, 143, 0.6);
    padding-bottom: 2px;
}
.boxes p a:hover {
    color: #0a0c3f;
    border-bottom-color: #dcd08f;
    border-bottom-width: 3px;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(220, 208, 143, 0.3);
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
.logout-container {
    margin-top: 50px;
    text-align: center;
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}
.logout-btn, .claim-again-btn {
    background: linear-gradient(135deg, #0a0c3f 0%, #1a1c4f 100%);
    color: white;
    border: none;
    padding: 16px 48px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(10, 12, 63, 0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
    text-decoration: none;
}
.claim-again-btn {
    background: linear-gradient(135deg, #dcd08f 0%, #c4b87a 100%);
    color: #0a0c3f;
    box-shadow: 0 4px 15px rgba(220, 208, 143, 0.3);
}
.logout-btn::before, .claim-again-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}
.logout-btn:hover::before {
    background: rgba(255, 255, 255, 0.2);
}
.claim-again-btn:hover::before {
    background: rgba(10, 12, 63, 0.1);
}
.logout-btn:hover::before, .claim-again-btn:hover::before {
    width: 300px;
    height: 300px;
}
.logout-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(10, 12, 63, 0.4);
    background: linear-gradient(135deg, #1a1c4f 0%, #2a2c5f 100%);
}
.claim-again-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(220, 208, 143, 0.4);
    background: linear-gradient(135deg, #e8dc9f 0%, #d4c88a 100%);
}
.logout-btn:active, .claim-again-btn:active {
    transform: translateY(-1px);
}
.logout-btn span, .claim-again-btn span {
    position: relative;
    z-index: 1;
}
.logout-icon, .claim-again-icon {
    position: relative;
    z-index: 1;
    font-size: 20px;
}
@media (max-width: 768px) {
    .logout-btn, .claim-again-btn {
        padding: 14px 36px;
        font-size: 16px;
        width: 100%;
        max-width: 280px;
    }
    .logout-container {
        margin-top: 40px;
        flex-direction: column;
        align-items: center;
    }
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
.boxes p a {
    color: #0a0c3f;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    border-bottom: 2px solid rgba(220, 208, 143, 0.6);
    padding-bottom: 2px;
}
.boxes p a:hover {
    color: #0a0c3f;
    border-bottom-color: #dcd08f;
    border-bottom-width: 3px;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(220, 208, 143, 0.3);
}
.logout-container {
    margin-top: 20px;
    gap: 10px;

}
.boxes a{
    min-width: unset !important;
}
.logout-btn, .claim-again-btn {
        padding: 10px 20px;
        font-size: 16px;
        font-size: 16px !important;
        width: 100%;
        text-align: center;
        align-items: center;
        justify-content: center;
    }
    .logout-container form {
    width: 100%;
    text-align: center;
}
}
</style>

<div class="gift-container" style="">
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
                <h5>You have already claimed {{ strtolower($displayCategoryName) }}.</h5>
                <h2>Gift Already Claimed</h2>
                <p>Our records show that you've already claimed your gift for this year. If this is unexpected or you have any questions, please contact us at <a href="mailto:info@thinkgraphtech.com?subject=Gift Claim Inquiry&body=Hello,%0D%0A%0D%0AI have a question about my gift claim.">info@thinkgraphtech.com</a>, and we will assist you.</p>

                <div class="logout-container">
                    <form method="POST" action="{{ route('demo.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <span class="logout-icon">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="boxes">
            <a href="#">
                <img src="{{ asset('images/gift1.png') }}" class="selectedGift" alt="Gift" />
            </a>
            <div>
                <h5>You have already claimed your gift.</h5>
                <h2>Gift Already Claimed</h2>
                <p>Our records show that you've already claimed your gift for this year. If this is unexpected or you have any questions, please contact us at <a href="mailto:info@thinkgraphtech.com?subject=Gift Claim Inquiry&body=Hello,%0D%0A%0D%0AI have a question about my gift claim.">info@thinkgraphtech.com</a>, and we will assist you.</p>

                <div class="logout-container">
                    <form method="POST" action="{{ route('demo.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <span class="logout-icon">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
