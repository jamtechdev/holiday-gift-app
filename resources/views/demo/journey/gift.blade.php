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
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
    align-items: center;
    justify-content: center;
}
.modal[style*="display: flex"],
.modal[style*="display: block"] {
    display: flex !important;
}
.modal-content {
    background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%);
    margin: auto;
    padding: 0;
    border: 2px solid #dcd08f;
    border-radius: 15px;
    width: 90%;
    max-width: 1000px;
    max-height: 95vh;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    animation: modalSlideIn 0.3s ease-out;
    overflow: hidden;
    display: flex;
    flex-direction: column;
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
    padding: 15px 30px;
    border-radius: 13px 13px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
}
.modal-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 24px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}
@media screen and (max-width: 667.99px) {
    .modal-header {
        padding: 12px 15px;
    }
    .modal-header h2 {
        font-size: 16px;
        letter-spacing: 0.5px;
    }
    .close {
        font-size: 24px;
    }
    .modal-content {
        width: 95%;
        max-height: 98vh;
    }
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
    overflow-y: auto;
    flex: 1;
    max-height: calc(95vh - 80px);
}
@media screen and (max-width: 667.99px) {
    .modal-body {
        padding: 15px 12px;
        max-height: calc(95vh - 70px);
    }
}
.form-group {
    margin-bottom: 15px;
}
@media screen and (max-width: 667.99px) {
    .form-group {
        margin-bottom: 12px;
    }
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
@media screen and (max-width: 667.99px) {
    .form-group input,
    .form-group select {
        padding: 10px 12px;
        font-size: 16px;
    }
    .form-group label {
        font-size: 12px;
        margin-bottom: 6px;
    }
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

@media screen and (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr !important;
        gap: 12px;
    }
}

@media screen and (max-width: 480px) {
    .form-row {
        grid-template-columns: 1fr !important;
        gap: 10px;
    }
}
.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 20px;
    justify-content: flex-end;
}
@media screen and (max-width: 667.99px) {
    .form-actions {
        margin-top: 15px;
        gap: 10px;
    }
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
@media screen and (max-width: 667.99px) {
    .form-actions {
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }
    .btn {
        width: 100%;
        padding: 12px 20px;
        font-size: 14px;
    }
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
    max-width: 100%;
    padding: 0 15px;
}
.boxes {
    gap: 15px;
    flex-direction: column;
    justify-content: center;
    margin:auto !important;
    height: 87vh;
    align-items: center;
    padding: 0 15px;
}
img.giftbox {
    width: 100%;
    max-width: 150px;
}
.boxes a, .boxes button{
    flex: unset !important;
}
.price {
    font-size: 42px;
}
.price sup {
    font-size: 28px;
}
.selectedGift {
    max-width: 90px;
}
.choose {
    max-width: 180px;
}
.claim-btn {
    font-size: 18px;
    padding: 8px 20px;
}
.modal-content {
    width: 95%;
    margin: 5% auto;
    max-height: 90vh;
}
}

.claim-btn {
    border: 1px solid #dcd08f !important;
    padding: 7px 14px;
    border-radius: 30px;
    transition: all 0.3s ease;
}

.claim-btn:hover {
    background: linear-gradient(135deg, rgba(220, 208, 143, 0.3) 0%, rgba(184, 168, 90, 0.3) 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 208, 143, 0.4);
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
@media screen and (max-width: 667.99px) {
    form[action*="logout"] {
        top: 10px;
        right: 15px;
    }
    button.logout {
        height: 36px;
        width: 36px;
        padding: 8px;
    }
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
@media screen and (max-width: 667.99px) {
    .gift-swiper {
        max-width: 150px;
        height: 150px;
    }
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
.swap {
    display: flex;
    flex-direction: row-reverse;
}
.nameSwap {
    display: flex;
    column-gap: 17px;
}

/* Demo Notice Modal Styles */
.demo-notice-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    animation: fadeInOverlay 0.4s ease-out forwards;
}

@keyframes fadeInOverlay {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes fadeOutOverlay {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

.demo-notice-modal {
    background: linear-gradient(135deg, rgba(26, 26, 26, 0.98) 0%, rgba(35, 35, 35, 0.98) 100%);
    border: 3px solid #dcd08f;
    border-radius: 20px;
    padding: 40px;
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(220, 208, 143, 0.3);
    position: relative;
    transform: scale(0.9) translateY(20px);
    animation: slideUpModal 0.5s ease-out 0.2s forwards;
    text-align: center;
}

@keyframes slideUpModal {
    from {
        transform: scale(0.9) translateY(20px);
        opacity: 0;
    }
    to {
        transform: scale(1) translateY(0);
        opacity: 1;
    }
}

.demo-notice-modal .close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: 2px solid #dcd08f;
    color: #dcd08f;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    line-height: 1;
}

.demo-notice-modal .close-btn:hover {
    background: #dcd08f;
    color: #1a1a1a;
    transform: rotate(90deg);
}

.demo-notice-modal h3 {
    color: #dcd08f;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.demo-notice-modal .icon {
    font-size: 48px;
    margin-bottom: 20px;
    animation: bounceIcon 2s ease-in-out infinite;
}

@keyframes bounceIcon {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.demo-notice-modal p {
    color: #dcd08f;
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 15px;
}

.demo-notice-modal .highlight-box {
    background: rgba(220, 208, 143, 0.1);
    border: 2px solid #dcd08f;
    border-radius: 12px;
    padding: 20px;
    margin: 25px 0;
}

.demo-notice-modal .highlight-box p {
    margin-bottom: 10px;
    font-size: 15px;
}

.demo-notice-modal .email-link {
    color: #dcd08f;
    text-decoration: underline;
    font-weight: 600;
    font-size: 18px;
    transition: all 0.3s ease;
    display: inline-block;
    margin-top: 10px;
}

.demo-notice-modal .email-link:hover {
    color: #f5e8b8;
    transform: scale(1.05);
    text-shadow: 0 0 10px rgba(220, 208, 143, 0.5);
}

.demo-notice-modal .continue-btn {
    background: linear-gradient(135deg, #dcd08f 0%, #b8a85a 100%);
    color: #1a1a1a;
    border: none;
    padding: 14px 35px;
    border-radius: 30px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(220, 208, 143, 0.3);
}

.demo-notice-modal .continue-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 208, 143, 0.5);
}

@media screen and (max-width: 667.99px) {
    .demo-notice-modal {
        padding: 30px 20px;
        max-width: 95%;
    }
    
    .demo-notice-modal h3 {
        font-size: 22px;
    }
    
    .demo-notice-modal p {
        font-size: 14px;
    }
    
    .demo-notice-modal .icon {
        font-size: 36px;
    }
}
</style>

<div class="gift-container" >
    <form method="POST" action="{{ route('demo.logout') }}" style="display: inline;">
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
                <a href="#" onclick="event.preventDefault(); showGiftInfo({{ $gift->id }}, '{{ $gift->name }}');" style="cursor: pointer;">
                  <div class="swap">
                    <img src="{{ asset('images/'.$giftImage) }}" class="selectedGift" />
                    <img src="{{ asset('images/'.$chooseImage) }}" class="choose"/>
                  </div>
                  @if (strtolower($category->name ?? '') === 'donation')
                    <span class="price"><sup>$</sup>20</span>
                  @endif
                </a>
                   <div>
                    <button class="claim-btn" type="button" onclick="showGiftInfo({{ $gift->id }}, '{{ $gift->name }}')" style="cursor: pointer;">Claim</button>
                   </div>
                </div>
            @endforeach
        @else
            <div class="boxes">
                <a href="#">
                    <img src="{{ asset('images/giftbox.png') }}" class="giftbox"/>
                </a>
                <a href="#" onclick="event.preventDefault(); showGiftInfoDemo();" style="cursor: pointer;">
                    <div class="swap">
                        <img src="{{ asset('images/'.$giftImage) }}" class="selectedGift" />
                        <img src="{{ asset('images/'.$chooseImage) }}" class="choose"/>
                    </div>
                    <span class="price"><sup>€</sup>20</span>
                </a>
<div>
    <button class="claim-btn" type="button" onclick="showGiftInfoDemo()" style="cursor: pointer;">Claim</button>
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
                            <!-- <a href="https://www.themicahparsons.com/givingback" target="_blank" class="charity-logo-link" title="Visit Lion Heart Foundation">
                                <img src="{{ asset('images/lionlogo.webp') }}" alt="Lion Heart Foundation" class="lion-charity-logo" />
                            </a> -->
                        </div>
                    </div>
                @else
                    <a href="#"></a>
                @endif
                <a href="{{ route('demo.gift.categories') }}">
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
            <h2 id="modal-title">Gift Information</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <!-- Demo mode: Only show contact message, no form -->
            <div class="demo-contact-message" style="text-align: center; padding: 40px 20px;">
                <div style="margin-bottom: 25px;">
                    <h3 style="color: #dcd08f; margin-bottom: 15px; font-size: 26px; font-weight: 600;">Thank You for Exploring Our Demo!</h3>
                    <p style="color: #dcd08f; font-size: 16px; line-height: 1.8; margin-bottom: 20px;">
                        You're viewing a sample of our holiday gifting platform. This interactive experience demonstrates how organizations can provide their clients, partners, and employees with a seamless gift selection process.
                    </p>
                </div>
                
                <div style="background: rgba(220, 208, 143, 0.1); border: 2px solid #dcd08f; border-radius: 12px; padding: 25px; margin: 25px 0;">
                    <p style="color: #dcd08f; font-size: 18px; line-height: 1.8; margin-bottom: 15px; font-weight: 500;">
                        Interested in implementing this for your organization?
                    </p>
                    <p style="color: #dcd08f; font-size: 16px; line-height: 1.8;">
                        Contact us to learn more about customizing this holiday gifting experience:
                    </p>
                    <p style="margin-top: 15px;">
                        <a href="mailto:info@thinkgraphtech.com?subject=Holiday Gifting Platform Inquiry&body=Hello,%0D%0A%0D%0AI'm interested in learning more about your holiday gifting platform.%0D%0A%0D%0APlease provide more information about implementation and customization options." 
                           style="color: #dcd08f; text-decoration: underline; font-weight: 600; font-size: 18px;">
                            info@thinkgraphtech.com
                        </a>
                    </p>
                </div>
                
                <button type="button" class="btn btn-secondary" onclick="closeModal()" style="width: 200px; margin-top: 20px; padding: 12px 24px; font-size: 16px;">Close</button>
            </div>
            
            <!-- Hidden form (never shown, never submitted) -->
            <form id="giftDetailsForm" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>

<script>
// Check if user has already claimed for this category
const hasClaimed = @json($hasClaimed ?? false);
const demoMode = true; // Always true in demo views

// Function to show gift info in demo mode (view only, no claim)
function showGiftInfo(giftId, giftName) {
    // Always in demo mode - show contact message only
    const modal = document.getElementById('giftDetailsModal');
    const modalTitle = document.getElementById('modal-title');
    const contactMsg = modal.querySelector('.demo-contact-message');
    
    // Update modal title with gift name
    if (modalTitle) {
        modalTitle.textContent = giftName ? (giftName + ' - Information') : 'Gift Information';
    }
    
        // Update contact message with gift name
        if (contactMsg) {
            const titleElement = contactMsg.querySelector('h3');
            if (titleElement && giftName) {
                titleElement.innerHTML = `Exploring: <span style="font-style: italic;">${giftName}</span>`;
            }
        }
    
    // Ensure form is hidden and contact message is visible
    const form = modal.querySelector('#giftDetailsForm');
    if (form) form.style.display = 'none';
    if (contactMsg) contactMsg.style.display = 'block';
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function showGiftInfoDemo() {
    showGiftInfo(null, 'Gift');
}

function openModal(categoryId, categoryName = '') {
    // In demo mode, always show gift info (contact message) instead of form
    showGiftInfoDemo();
}

function closeModal() {
    const modal = document.getElementById('giftDetailsModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
    
    // Ensure form stays hidden and contact message stays visible
    const contactMsg = modal.querySelector('.demo-contact-message');
    const form = modal.querySelector('#giftDetailsForm');
    if (form) form.style.display = 'none';
    if (contactMsg) contactMsg.style.display = 'block';
}

function closeModalWithConfirm() {
    alert('Please fill out the form to continue to the next page. All fields are required.');
}

// Auto-uppercase for state field
document.getElementById('state').addEventListener('input', function(e) {
    e.target.value = e.target.value.toUpperCase();
});

// Handle form submission - COMPLETELY BLOCKED IN DEMO MODE
// Form is hidden and should never be submitted, but add extra protection
const giftForm = document.getElementById('giftDetailsForm');
if (giftForm) {
    // Block all form submissions
    giftForm.addEventListener('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        // Always show contact message
        alert('Thank you for exploring our demo! To learn more about implementing this holiday gifting experience for your organization, please contact us at info@thinkgraphtech.com.');
        return false;
    }, true);
    
    // Also disable the form completely
    giftForm.style.display = 'none';
    giftForm.setAttribute('onsubmit', 'return false;');
}

</script>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

// Demo Notice Modal Functions
function showDemoNotice() {
    const modal = document.getElementById('demoNoticeModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeDemoNotice() {
    const modal = document.getElementById('demoNoticeModal');
    if (modal) {
        modal.style.animation = 'fadeOutOverlay 0.3s ease-out forwards';
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300);
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('demoNoticeModal');
    if (modal && e.target === modal) {
        closeDemoNotice();
    }
});
</script>
@endpush

<!-- Demo Notice Modal -->
<div id="demoNoticeModal" class="demo-notice-overlay" style="display: none;">
    <div class="demo-notice-modal">
        <button class="close-btn" onclick="closeDemoNotice()" aria-label="Close">×</button>
        <div class="icon">🎁</div>
        <h3>Welcome to Our Demo Experience</h3>
        <p>You're exploring a sample of our holiday gifting platform. This interactive experience demonstrates how organizations can provide their clients, partners, and employees with a seamless gift selection process.</p>
        
        <div class="highlight-box">
            <p><strong>Interested in implementing this for your organization?</strong></p>
            <p>Contact us to learn more about customizing this holiday gifting experience:</p>
            <a href="mailto:info@thinkgraphtech.com?subject=Holiday Gifting Platform Inquiry&body=Hello,%0D%0A%0D%0AI'm interested in learning more about your holiday gifting platform.%0D%0A%0D%0APlease provide more information about implementation and customization options." 
               class="email-link">info@thinkgraphtech.com</a>
        </div>
        
        <button class="continue-btn" onclick="closeDemoNotice()">Continue Exploring</button>
    </div>
</div>

@endsection
