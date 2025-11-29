@extends('layouts.journey')

@section('title', 'Gifts')

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
</style>

<div class="gift-container" style="background-image: url('{{ asset('images/SelectionBg.jpg') }}');">
    <!-- <img src="{{ asset('images/overlayPuzzle.png') }}" class="overlayPuzzle" /> -->

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
                <div class="boxes">
                    <a href="#">
                        @if($gift->image)
                            <img src="{{ asset('storage/'.$gift->image) }}" class="giftbox" alt="{{ $gift->name }}"/>
                        @else
                            <img src="{{ asset('images/'.$giftBoxImage) }}" class="giftbox" alt="{{ $gift->name }}"/>
                        @endif
                    </a>
                    <a href="#" onclick="event.preventDefault(); openModal({{ $category->id }});" style="cursor: pointer;">
                        <img src="{{ asset('images/'.$giftImage) }}" class="selectedGift" />
                        <img src="{{ asset('images/'.$chooseImage) }}" class="choose"/>
                        <span class="price"><sup>€</sup>20</span>
                    </a>
                    <button type="button" onclick="openModal({{ $category->id }})" style="cursor: pointer;">Claim</button>
                </div>
            @endforeach
        @else
            <div class="boxes">
                <a href="#">
                    <img src="{{ asset('images/giftbox.png') }}" class="giftbox"/>
                </a>
                <a href="#" onclick="event.preventDefault(); openModal({{ $category->id }});" style="cursor: pointer;">
                    <img src="{{ asset('images/'.$giftImage) }}" class="selectedGift" />
                    <img src="{{ asset('images/'.$chooseImage) }}" class="choose"/>
                    <span class="price"><sup>€</sup>20</span>
                </a>
                <button type="button" onclick="openModal({{ $category->id }})" style="cursor: pointer;">Claim</button>
            </div>
        @endif

        <div class="backBtn">
          <a href="#">
            <img src="{{ asset('images/location.png') }}" />
          </a>
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
    <div class="modal-content" style="border: 2px solid #dcd08f;">
        <div class="modal-header" style="background: #dc2626; border-radius: 13px 13px 0 0;">
            <h2 style="color: white; margin: 0; font-size: 24px; font-weight: 700; text-transform: uppercase;">Already Claimed</h2>
            <span class="close" onclick="closeAlreadyClaimedModal()" style="color: white; font-size: 28px; font-weight: bold;">&times;</span>
        </div>
        <div class="modal-body" style="background: #2a2a2a; text-align: center; padding: 40px 30px; border-radius: 0 0 13px 13px;">
            <div style="font-size: 64px; margin-bottom: 20px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">⚠️</div>
            <h3 style="color: #0a0c3f; margin-bottom: 20px; font-size: 24px; font-weight: 600; background: #ffffff; padding: 10px 20px; border-radius: 8px; display: inline-block;">Gift Already Claimed</h3>
            <p style="color: #ffffff; line-height: 1.8; font-size: 16px; margin-bottom: 15px; text-align: center;">
                Our records show that you've already claimed your gift for this year.
            </p>
            <p style="color: #ffffff; line-height: 1.8; font-size: 16px; margin-bottom: 30px; text-align: center;">
                If this is unexpected or you have questions, please contact us at 
                <a href="mailto:info@thinkgraphtech.com" style="color: #0a0c3f; font-weight: 600; text-decoration: underline; background: #ffffff; padding: 2px 8px; border-radius: 4px; display: inline-block;">info@thinkgraphtech.com</a> 
                so we can assist you.
            </p>
            <div class="form-actions" style="justify-content: center; margin-top: 30px;">
                <button type="button" class="btn btn-primary" onclick="closeAlreadyClaimedModal()" style="min-width: 150px; background: linear-gradient(135deg, #dcd08f 0%, #b8a85a 100%); color: #1a1a1a; font-weight: 600; padding: 12px 30px; border-radius: 8px; border: none; cursor: pointer;">OK</button>
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

function openModal(categoryId) {
    // Check if user has already claimed
    if (hasClaimed) {
        document.getElementById('alreadyClaimedModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
        return;
    }
    
    document.getElementById('category_id').value = categoryId;
    document.getElementById('giftDetailsModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('giftDetailsModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    // Don't reset form if user wants to continue editing
}

function closeAlreadyClaimedModal() {
    document.getElementById('alreadyClaimedModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeModalWithConfirm() {
    alert('Please fill out the form to continue to the next page. All fields are required.');
}

// Close modal when clicking outside of it - but prevent closing if form is required
window.onclick = function(event) {
    const modal = document.getElementById('giftDetailsModal');
    const alreadyClaimedModal = document.getElementById('alreadyClaimedModal');
    
    if (event.target == modal) {
        // Prevent closing by clicking outside - user must fill the form
        // closeModal();
    }
    
    if (event.target == alreadyClaimedModal) {
        closeAlreadyClaimedModal();
    }
}

// Close modal with Escape key - disabled to force form completion
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        // Prevent closing with Escape - user must fill the form
        // closeModal();
    }
});

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

    // Get CSRF token from form
    const csrfToken = formData.get('_token');

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
        // Close modal
        document.getElementById('giftDetailsModal').style.display = 'none';
        document.body.style.overflow = 'auto';

        // Redirect to next page
        const redirectTo = form.querySelector('input[name="redirect_to"]').value;
        window.location.href = redirectTo;
    })
    .catch(error => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;

        // Check if it's an already claimed error
        if (error.error === 'already_claimed' || (error.message && error.message.includes('already claimed'))) {
            // Close form modal and show already claimed modal
            document.getElementById('giftDetailsModal').style.display = 'none';
            document.getElementById('alreadyClaimedModal').style.display = 'block';
            return;
        }

        // Show error message
        let errorMessage = 'Please fill all required fields correctly.';
        if (error.errors) {
            const firstError = Object.values(error.errors)[0];
            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
        } else if (error.message) {
            errorMessage = error.message;
        }

        alert(errorMessage);
    });
});
</script>
@endsection
