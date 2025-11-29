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
                
                <div class="logout-container">
                    <a href="{{ route('user.gift.categories') }}" class="claim-again-btn">
                        <span class="claim-again-icon">🎁</span>
                        <span>Claim Again</span>
                    </a>
                    <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <span class="logout-icon">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
