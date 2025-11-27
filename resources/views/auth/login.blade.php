@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
.puzzle-form-container {
    position: absolute;
    max-width: 50%;
    margin: 0px auto;
    left: 0;
    right: 0;
    top: 50%;
    transform: translate(-1%, -21%);
    background-size: cover;
    padding: 40px 40px;
    min-height: 374px;
}
input {
    background: linear-gradient(to right, #2d2b2d, #444447) !important;
    border: 3px solid #58595b !important;
    border-radius: 8px !important;
    margin-top: 9px;
}
.remember_me {
    font-size: 18px;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: cursive;
    justify-content: space-between;
}
.remember_me input {
    width: 24px;
    height: 19px;
    margin-top: 0;
    cursor: pointer;
}
.remember_me div {
    display: flex;
    align-items: center;
    gap: 10px;
}
.remember_me button {
    cursor: pointer;
}
</style>
<div class="login-container" style="background-image: url('{{ asset('images/login.png') }}');background-size: contain;">
    <div class="puzzle-form-container" style="background-image: url('{{ asset('images/puzzle.png') }}');">
        <form method="POST" action="/" class="puzzle-form">
            @csrf
            
            <div class="form-group">
                <input type="email" 
                       name="email" 
                       class="form-input" 
                       placeholder="USERNAME" 
                       value="{{ old('email') }}" 
                       required />
            </div>

            
            <div class="form-group">
                <input type="password" 
                       name="password" 
                       class="form-input" 
                       placeholder="PASSWORD" 
                       required />
            </div>

            <div class="remember_me">
              <div class="terms-acknowledgement">
                <input type="checkbox"
                       id="terms-checkbox"
                       name="terms"
                       value="1"
                       aria-describedby="terms-text"
                       required />
                 <span id="terms-text">
                    I accept Graphtech’s gift terms and my organization’s policy.
                 </span>
               </div>
               <button type="submit">Login</button>
            </div>
            
            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
</div>

<div class="terms-modal" id="terms-modal" aria-hidden="true">
    <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="terms-title">
        <div class="terms-header">
            <div>
                <p class="terms-kicker">Graphtech Holiday Gift Program</p>
                <h2 id="terms-title">Terms &amp; Conditions</h2>
            </div>
        </div>
        <div class="terms-scroll">
            <p class="terms-updated">Last Updated: December 2025</p>
            <p>These Terms &amp; Conditions (“Terms”) govern your participation in the Graphtech Holiday Gift Program (“Program”). By accessing the Program website or selecting a gift, you agree to be bound by these Terms.</p>

            <h3>1. Purpose of the Program</h3>
            <p>The Program is a voluntary holiday initiative through which Graphtech provides eligible clients, vendors, partners, and employees with a complimentary gift. Available gifts may include a charitable donation, earbuds, a backpack, or other items at Graphtech’s discretion.</p>

            <h3>2. Eligibility</h3>
            <p>Participation in the Program is by invitation only. Graphtech reserves the right to verify eligibility or to modify, suspend, or discontinue the Program at any time.</p>

            <h3>3. Gift Acceptance &amp; Responsibility</h3>
            <ol>
                <li>The item is offered at no cost as a courtesy from Graphtech.</li>
                <li>You are solely responsible for determining whether acceptance of this gift complies with your employer’s, organization’s, or governing body’s internal gift-acceptance, ethics, and compliance policies.</li>
                <li>Graphtech does not review, monitor, or confirm any recipient’s internal policies, requirements, or restrictions.</li>
                <li>All responsibility for compliance rests entirely with you, the recipient.</li>
            </ol>
            <p class="terms-note">By selecting a gift, you acknowledge that it is provided at no cost by Graphtech and that you are solely responsible for ensuring acceptance complies with your organization’s internal policies. Graphtech is not liable for any issues resulting from your acceptance of a gift.</p>

            <h3>4. No Liability</h3>
            <ul>
                <li>Graphtech is not responsible or liable for any consequences, disciplinary actions, policy violations, tax implications, or other issues that may arise as a result of your acceptance of a gift.</li>
                <li>Graphtech expressly disclaims all warranties, express or implied, relating to the gift items, except where prohibited by law.</li>
                <li>Graphtech is not liable for loss, theft, delays, or delivery issues related to gift shipments handled by third-party carriers.</li>
            </ul>

            <h3>5. Charitable Donations</h3>
            <ul>
                <li>The donation is made by Graphtech, not by you.</li>
                <li>You will not receive a tax receipt and may not claim the donation for tax purposes.</li>
                <li>Graphtech reserves the right to choose the method and timing of the donation.</li>
            </ul>

            <h3>6. Privacy</h3>
            <p>Graphtech may collect limited personal information (such as your name, shipping address, and gift selection) solely to fulfill your gift request. Information will not be sold or shared except for fulfillment purposes.</p>

            <h3>7. Program Modifications</h3>
            <p>Graphtech may modify these Terms, substitute gifts of equal value, or terminate the Program at any time without prior notice.</p>

            <h3>8. Governing Law</h3>
            <p>These Terms are governed by the laws of the state in which Graphtech is headquartered, without regard to conflict-of-law principles.</p>

            <h3>9. Required Acknowledgment</h3>
            <p>I understand that this is a complimentary gift from Graphtech and accept full responsibility for confirming compliance with my organization’s internal gift policies. I acknowledge that Graphtech is not liable for any consequences arising from my acceptance of a gift.</p>
        </div>
        <div class="terms-footer">
            <button type="button" class="terms-close-btn" id="accept-terms">Accept</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('terms-modal');
    const termsCheckbox = document.getElementById('terms-checkbox');
    const acceptBtn = document.getElementById('accept-terms');

    if (!modal || !termsCheckbox || !acceptBtn) return;

    const openModal = () => {
        modal.setAttribute('aria-hidden', 'false');
        modal.classList.add('active');
    };

    const closeModal = () => {
        modal.setAttribute('aria-hidden', 'true');
        modal.classList.remove('active');
    };

    termsCheckbox.addEventListener('change', () => {
        if (termsCheckbox.checked) {
            openModal();
        } else {
            closeModal();
        }
    });

    acceptBtn.addEventListener('click', () => {
        closeModal();
        termsCheckbox.checked = true;
    });
});
</script>
@endpush
@endsection