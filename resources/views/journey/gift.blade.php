@extends('layouts.journey')

@section('title', 'Gifts')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

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
    max-width: 80%;
    margin: 0px auto;
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
    cursor: pointer;
    color: #dcd08f;
    background: transparent;
    border: none;
    transition: all 0.3s ease;
    position: relative;
}
.boxes button:hover {
    color: #fff;
    text-shadow: 0 0 10px rgba(220, 208, 143, 0.8),
                 0 0 20px rgba(220, 208, 143, 0.6),
                 0 0 30px rgba(220, 208, 143, 0.4);
    animation: blinkLight 1.5s ease-in-out infinite;
}
.backBtn a img {
    margin: auto;
}
.backBtn a {
    flex: 1;
    text-align: center;
}
img.back:hover {
    filter: sepia(1);
}
@keyframes blinkLight {
    0%, 100% {
        opacity: 1;
        text-shadow: 0 0 10px rgba(220, 208, 143, 0.8),
                     0 0 20px rgba(220, 208, 143, 0.6),
                     0 0 30px rgba(220, 208, 143, 0.4);
    }
    50% {
        opacity: 0.9;
        text-shadow: 0 0 15px rgba(255, 255, 255, 1),
                     0 0 25px rgba(220, 208, 143, 0.8),
                     0 0 35px rgba(220, 208, 143, 0.6);
    }
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
/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
}
.modal-content {
    background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%);
    margin: 5% auto;
    padding: 0;
    border: 2px solid #dcd08f;
    border-radius: 15px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    animation: modalSlideIn 0.3s ease-out;
}

/* Already Claimed Modal - Wider and Better UI */
#alreadyClaimedModal .modal-content {
    max-width: 800px;
    width: 95%;
    border: 3px solid #dcd08f;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6), 0 0 30px rgba(220, 208, 143, 0.3);
    animation: modalSlideIn 0.4s ease-out;
}

#alreadyClaimedModal .modal-header {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    padding: 25px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
}

#alreadyClaimedModal .modal-header h2 {
    flex: 1;
    text-align: center;
    font-size: 28px;
    letter-spacing: 2px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

#alreadyClaimedModal .modal-header .close {
    transition: transform 0.3s ease, opacity 0.3s ease;
    cursor: pointer;
    line-height: 1;
    padding: 5px;
}

#alreadyClaimedModal .modal-header .close:hover {
    transform: rotate(90deg) scale(1.2);
    opacity: 0.8;
}

#alreadyClaimedModal .modal-body {
    padding: 50px 60px;
    background: linear-gradient(135deg, #2a2a2a 0%, #1f1f1f 100%);
    position: relative;
}

#alreadyClaimedModal .warning-icon-container {
    display: flex;
    align-items: flex-start;
    gap: 30px;
    margin-bottom: 30px;
    text-align: left;
}

#alreadyClaimedModal .warning-icon {
    font-size: 80px;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
    flex-shrink: 0;
    animation: pulse 2s ease-in-out infinite;
}

#alreadyClaimedModal .message-content {
    flex: 1;
}

#alreadyClaimedModal .message-content h3 {
    color: #ffffff;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

#alreadyClaimedModal .message-content p {
    color: #e0e0e0;
    line-height: 1.9;
    font-size: 17px;
    margin-bottom: 15px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

#alreadyClaimedModal .message-content a {
    color: #0a0c3f;
    font-weight: 700;
    text-decoration: none;
    background: linear-gradient(135deg, #dcd08f 0%, #f0e68c 100%);
    padding: 4px 12px;
    border-radius: 6px;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(220, 208, 143, 0.4);
}

#alreadyClaimedModal .message-content a:hover {
    background: linear-gradient(135deg, #f0e68c 0%, #dcd08f 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 208, 143, 0.6);
}

#alreadyClaimedModal .modal-actions {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid rgba(220, 208, 143, 0.2);
}

#alreadyClaimedModal .btn-ok {
    min-width: 180px;
    background: linear-gradient(135deg, #dcd08f 0%, #b8a85a 100%);
    color: #1a1a1a;
    font-weight: 700;
    font-size: 16px;
    padding: 14px 40px;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(220, 208, 143, 0.4);
}

#alreadyClaimedModal .btn-ok:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(220, 208, 143, 0.6);
    background: linear-gradient(135deg, #e8dc9f 0%, #c4b87a 100%);
}

#alreadyClaimedModal .btn-ok:active {
    transform: translateY(-1px);
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

@media (max-width: 768px) {
    #alreadyClaimedModal .modal-content {
        width: 98%;
        max-width: 100%;
    }

    #alreadyClaimedModal .modal-body {
        padding: 30px 25px;
    }

    #alreadyClaimedModal .warning-icon-container {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }

    #alreadyClaimedModal .warning-icon {
        font-size: 60px;
        margin: 0 auto;
    }
}
@keyframes modalSlideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
.modal-header {
    background: linear-gradient(135deg, #dcd08f 0%, #b8a85a 100%);
    padding: 20px 30px;
    border-radius: 13px 13px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.modal-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 24px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.close {
    color: #1a1a1a;
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s;
    line-height: 1;
}
.close:hover,
.close:focus {
    transform: rotate(90deg);
    color: #000;
}
.modal-body {
    padding: 30px;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #dcd08f;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.form-group input,
.form-group select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #444;
    border-radius: 8px;
    background-color: #1a1a1a;
    color: #fff;
    font-size: 16px;
    transition: all 0.3s;
    box-sizing: border-box;
}
.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #dcd08f;
    background-color: #222;
    box-shadow: 0 0 10px rgba(220, 208, 143, 0.3);
}
.form-group input::placeholder {
    color: #666;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}
.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    justify-content: flex-end;
}
.btn {
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.btn-primary {
    background: linear-gradient(135deg, #dcd08f 0%, #b8a85a 100%);
    color: #1a1a1a;
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 208, 143, 0.4);
}
.btn-secondary {
    background: #444;
    color: #fff;
}
.btn-secondary:hover {
    background: #555;
    transform: translateY(-2px);
}
.boxes a, .boxes button {
    flex: 1;
}

@media screen and (min-width:668px) {
   .gift-container{
    background-image: url('{{ asset('images/SelectionBg.jpg') }}');
   }
   .boxes {

    align-items: center;
}
}
@media screen and (max-width:667.99px) {
    .gift-container{
    background-image: url('{{ asset('images/message-bg-mobile.png') }}');
    background-size: 100% 100%;
    background-position: center !important;
   }
   .logoBox{
    display:none;
   }
   .backBtn {
    position: fixed;
    bottom: 11px;
    left: 0;
    right: 0;
    text-align: center;
}
.boxes {
    gap: 15px;
    flex-direction: column;
    justify-content: center;
    margin:auto !important;
    height: 87vh;
    align-items: center;
}
img.giftbox {
    width: 100%;
    max-width: 150px;
}
.boxes a, .boxes button{
    flex: unset !important;
}
.form-actions {
    flex-direction: column;
}
}

.claim-btn {
    border: 1px solid #dcd08f !important;
    padding: 7px 14px;
    border-radius: 30px;
}

/* Logout Button Styles */
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

/* Charity Selection Styles */
.backBtn .charity-selection-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
    justify-content: center;
}
.charity-options {
    display: flex;
    gap: 20px;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.charity-logo-link {
    display: inline-block;
    transition: transform 0.3s ease;
}
.charity-logo-link:hover {
    transform: scale(1.1);
}
.charity-logo {
    max-width: 120px;
    height: auto;
    filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.3));
}
.lion-charity-logo {
    max-width: 120px;
    height: auto;
    object-fit: contain;
    background: #fff;
    padding: 8px;
    border-radius: 8px;
    filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.3));
}
.charity-selection-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 15px;
    padding: 15px;
    background: rgba(26, 26, 26, 0.8);
    border-radius: 8px;
    border: 1px solid #dcd08f;
}
.charity-radio-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.charity-radio-option {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #dcd08f;
    cursor: pointer;
}
.charity-radio-option input[type="radio"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
}
.charity-radio-option label {
    cursor: pointer;
    font-size: 14px;
}
@media screen and (max-width: 667.99px) {
    .backBtn .charity-selection-container {
        flex: 1;
        min-width: 0;
    }
    .charity-options {
        flex-direction: row;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .charity-logo,
    .lion-charity-logo {
        max-width: 80px;
    }
    .lion-charity-logo {
        padding: 4px;
        border-radius: 4px;
    }
}

/* Swiper Styles */
.gift-swiper {
    width: 100%;
    max-width: 280px;
    height: 280px;
}
.gift-swiper .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
}
.gift-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.gift-swiper .swiper-pagination {
    bottom: -30px;
}
.gift-swiper .swiper-pagination-bullet {
    background: #dcd08f;
    opacity: 0.5;
}
.gift-swiper .swiper-pagination-bullet-active {
    opacity: 1;
}
</style>

<div class="gift-container" >
    <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
        </button>
    </form>
    <div class="giftBox">

        <div class="logoBox">
           <img src="{{ asset('images/logo-golden.png') }}" class="logo" />
        </div>

        @php
            // Determine which images to use based on category name
            $categoryName = strtolower($category->name ?? '');
            $chooseImage = 'choose.png'; // default
            $giftImage = 'gift1.png'; // default
            $giftBoxImage = 'giftbox.png'; // default

            if (strpos($categoryName, 'technology') !== false || strpos($categoryName, 'tech') !== false) {
                $chooseImage = 'techno.png';
                $giftImage = 'gift2.png';
                $giftBoxImage = 'headphone.png';
            } elseif (strpos($categoryName, 'merchandise') !== false || strpos($categoryName, 'merch') !== false) {
                $chooseImage = 'chooseMerge.png';
                $giftImage = 'gift3.png';
                $giftBoxImage = 'giftbox.png';
            } else {
                // Donation or default
                $chooseImage = 'choose.png';
                $giftImage = 'gift1.png';
                $giftBoxImage = 'giftbox.png';
            }
        @endphp

        @if(isset($gifts) && $gifts->count() > 0)
            @foreach($gifts as $gift)
                @php
                    $images = is_array($gift->image) ? $gift->image : (is_string($gift->image) && $gift->image ? [$gift->image] : []);
                    $imageCount = count($images);
                @endphp
                <div class="boxes">
                    <a href="#">
                        @if($imageCount > 0)
                            @if($imageCount > 1)
                                <!-- Swiper for multiple images -->
                                <div class="swiper gift-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($images as $img)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/'.$img) }}" class="giftbox" alt="{{ $gift->name }}"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            @else
                                <!-- Single image -->
                                <img src="{{ asset('storage/'.$images[0]) }}" class="giftbox" alt="{{ $gift->name }}"/>
                            @endif
                        @else
                            <img src="{{ asset('images/'.$giftBoxImage) }}" class="giftbox" alt="{{ $gift->name }}"/>
                        @endif
                    </a>
                    <a href="#" onclick="event.preventDefault(); openModal({{ $category->id }}, '{{ strtolower($category->name) }}');" style="cursor: pointer;">
                        <img src="{{ asset('images/'.$giftImage) }}" class="selectedGift" />
                        <img src="{{ asset('images/'.$chooseImage) }}" class="choose"/>
                        <span class="price"><sup>€</sup>20</span>
                    </a>
                   <div>
                    <button class="claim-btn" type="button" onclick="openModal({{ $category->id }}, '{{ strtolower($category->name) }}')" style="cursor: pointer;">Claim</button>
                   </div>
                </div>
            @endforeach
        @else
            <div class="boxes">
                <a href="#">
                    <img src="{{ asset('images/giftbox.png') }}" class="giftbox"/>
                </a>
                <a href="#" onclick="event.preventDefault(); openModal({{ $category->id }}, '{{ strtolower($category->name) }}');" style="cursor: pointer;">
                    <img src="{{ asset('images/'.$giftImage) }}" class="selectedGift" />
                    <img src="{{ asset('images/'.$chooseImage) }}" class="choose"/>
                    <span class="price"><sup>€</sup>20</span>
                </a>
<div>
    <button class="claim-btn" type="button" onclick="openModal({{ $category->id }}, '{{ strtolower($category->name) }}')" style="cursor: pointer;">Claim</button>

</div>
            </div>
        @endif

            <div class="backBtn">
                @if (strtolower($category->name ?? '') === 'donation')
                    <div class="charity-selection-container">
                        <div class="charity-options">
                            <a href="https://www.wildheartministries.net/" target="_blank" class="charity-logo-link" title="Visit Wild Heart Ministries">
                                <img src="{{ asset('images/location.png') }}" alt="Wild Heart Ministries" class="charity-logo" />
                            </a>
                            <a href="https://www.themicahparsons.com/givingback" target="_blank" class="charity-logo-link" title="Visit Lion Heart Foundation">
                                <img src="{{ asset('images/lionlogo.webp') }}" alt="Lion Heart Foundation" class="lion-charity-logo" />
                            </a>
                        </div>
                    </div>
                @else
                    <a href="#"></a>
                @endif
                <a href="{{ route('user.gift.categories') }}">
                    <img src="{{ asset('images/back.png') }}" class="back" />
                </a>
                <a href="#">

                </a>
            </div>
    </div>
</div>

<!-- Error Modal for Already Claimed -->
<div id="alreadyClaimedModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Already Claimed</h2>
            <span class="close" onclick="closeAlreadyClaimedModal()" style="color: white; font-size: 32px; font-weight: bold; cursor: pointer; transition: transform 0.2s;">&times;</span>
        </div>
        <div class="modal-body">
            <div class="warning-icon-container">
                <div class="warning-icon">⚠️</div>
                <div class="message-content">
                    <h3>Gift Already Claimed</h3>
                    <p>
                        Our records show that you've already claimed your gift for this year.
                    </p>
                    <p>
                        If this is unexpected or you have questions, please contact us at
                        <a href="mailto:info@thinkgraphtech.com">info@thinkgraphtech.com</a>
                        so we can assist you.
                    </p>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-ok" onclick="closeAlreadyClaimedModal()">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="giftDetailsModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Gift Details</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="giftDetailsForm" method="POST">
                @csrf
                <input type="hidden" name="category_id" id="category_id" value="">
                <input type="hidden" name="redirect_to" value="{{ route('user.claimed') }}">

                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label for="street_address">Street Address *</label>
                    <input type="text" id="street_address" name="street_address" required placeholder="Enter street address">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City *</label>
                        <input type="text" id="city" name="city" required placeholder="Enter city">
                    </div>
                    <div class="form-group">
                        <label for="state">State *</label>
                        <input type="text" id="state" name="state" required maxlength="2" placeholder="XX" pattern="[A-Z]{2}" style="text-transform: uppercase;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="zip">ZIP Code *</label>
                    <input type="text" id="zip" name="zip" required maxlength="5" placeholder="12345" pattern="[0-9]{5}">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telephone">Telephone *</label>
                        <input type="tel" id="telephone" name="telephone" required maxlength="10" placeholder="1234567890" pattern="[0-9]{10}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required placeholder="your@email.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company">Company (Optional)</label>
                    <input type="text" id="company" name="company" placeholder="Enter company name">
                </div>

                <div class="form-group" id="charity-selection-group" style="display: none;">
                    <label>Charity Selection *</label>
                    <div class="charity-selection-options">
                        <div class="charity-radio-group">
                            <div class="charity-radio-option">
                                <input type="radio" id="charity_wildheart" name="charity_selection" value="wildheart" required>
                                <label for="charity_wildheart">Wild Heart Ministries (100%)</label>
                            </div>
                            <div class="charity-radio-option">
                                <input type="radio" id="charity_lionheart" name="charity_selection" value="lionheart">
                                <label for="charity_lionheart">Lion Heart Foundation (100%)</label>
                            </div>
                            <div class="charity-radio-option">
                                <input type="radio" id="charity_split" name="charity_selection" value="split">
                                <label for="charity_split">Split 50% / 50%</label>
                            </div>
                        </div>
                        <div style="margin-top: 10px; font-size: 12px; color: #999;">
                            <a href="https://www.wildheartministries.net/" target="_blank" style="color: #dcd08f; text-decoration: none;">Visit Wild Heart Ministries</a> |
                            <a href="https://www.themicahparsons.com/givingback" target="_blank" style="color: #dcd08f; text-decoration: none;">Visit Lion Heart Foundation</a>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModalWithConfirm()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit & Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Check if user has already claimed for this category
const hasClaimed = @json($hasClaimed ?? false);

function openModal(categoryId, categoryName = '') {
    if (hasClaimed) {
        toastr.error('Our records show that you\'ve already claimed your gift for this year. If this is unexpected or you have questions, please contact us at info@thinkgraphtech.com so we can assist you.', 'Already Claimed', {
            timeOut: 8000,
            progressBar: true
        });
        return;
    }

    document.getElementById('category_id').value = categoryId;

    // Show/hide charity selection field for donation category
    const charitySelectionGroup = document.getElementById('charity-selection-group');
    const charitySelectionInputs = charitySelectionGroup.querySelectorAll('input[type="radio"]');

    if (categoryName && categoryName.toLowerCase() === 'donation') {
        charitySelectionGroup.style.display = 'block';
        charitySelectionInputs.forEach(input => input.setAttribute('required', 'required'));
    } else {
        charitySelectionGroup.style.display = 'none';
        charitySelectionInputs.forEach(input => {
            input.removeAttribute('required');
            input.checked = false;
        });
    }

    document.getElementById('giftDetailsModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('giftDetailsModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeModalWithConfirm() {
    alert('Please fill out the form to continue to the next page. All fields are required.');
}

// Auto-uppercase for state field
document.getElementById('state').addEventListener('input', function(e) {
    e.target.value = e.target.value.toUpperCase();
});

// Handle form submission with AJAX
document.getElementById('giftDetailsForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';

    fetch('{{ route("user.gift-request.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json().catch(() => ({ success: true }));
        }
        return response.json().then(err => Promise.reject(err));
    })
    .then(data => {
        // Show success toastr
        toastr.success(data.message || 'Gift request submitted successfully! Your gift will be processed soon.');

        // Close modal after short delay
        setTimeout(() => {
            document.getElementById('giftDetailsModal').style.display = 'none';
            document.body.style.overflow = 'auto';

            // Redirect to next page
            const redirectTo = form.querySelector('input[name="redirect_to"]').value;
            window.location.href = redirectTo;
        }, 1500);
    })
    .catch(error => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;

        // Check if it's an already claimed error
        if (error.error === 'already_claimed' || (error.message && error.message.includes('already claimed'))) {
            // Close form modal
            document.getElementById('giftDetailsModal').style.display = 'none';
            document.body.style.overflow = 'auto';

            // Show error in toastr
            const errorMessage = error.message || 'Our records show that you\'ve already claimed your gift for this year. If this is unexpected or you have questions, please contact us at info@thinkgraphtech.com so we can assist you.';
            toastr.error(errorMessage);
            return;
        }

        // Show error message in toastr
        let errorMessage = 'Please fill all required fields correctly.';
        if (error.errors) {
            const firstError = Object.values(error.errors)[0];
            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
        } else if (error.message) {
            errorMessage = error.message;
        }

        toastr.error(errorMessage);
    });
});

</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
// Initialize Swiper for gift images after library loads
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Swiper to be available
    if (typeof Swiper !== 'undefined') {
        initializeSwipers();
    } else {
        // Retry if Swiper isn't loaded yet
        setTimeout(function() {
            if (typeof Swiper !== 'undefined') {
                initializeSwipers();
            }
        }, 100);
    }

    function initializeSwipers() {
        const swipers = document.querySelectorAll('.gift-swiper');
        swipers.forEach(function(swiperEl) {
            const slideCount = swiperEl.querySelectorAll('.swiper-slide').length;
            new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: swiperEl.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                autoplay: slideCount > 1 ? {
                    delay: 3000,
                    disableOnInteraction: false,
                } : false,
                loop: slideCount > 1,
            });
        });
    }
});
</script>
@endpush
@endsection
