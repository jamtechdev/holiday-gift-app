@extends('layouts.journey')

@section('title', 'Gift Categories')

@section('journey-content')
<style>
.journey-page {
    padding: 0px;
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
    gap: 10px;
    display: flex;
    justify-content: center;
    margin-top: 69px;
    flex-wrap: wrap;
}
.boxes a {
    position: relative;
    width: 280px;
    height: 280px;
    margin: 10px;
    text-align: center;
    text-decoration: none;
}
.boxes a .category-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.boxes a .category-name {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 10px;
    color: #dcd08f;
    font-weight: 600;
    font-size: 18px;
}
.giftBox {
    position: relative;
    z-index: 99;
}
/* 1. Base Setup */
.flip-container {
  perspective: 1000px;
  width: 260px; /* Set the size of the visible image */
  height: 280px;
  margin: 0 auto;
  position: relative;
  /* Add margin to see the animation on the page */
  opacity: 0;
  transform: scale(0.8);
  transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

/* Show container smoothly before flip */
.flip-container.ready {
  opacity: 1;
  transform: scale(1);
}

/* 2. Flipper Container (Handles the animation) */
.flipper {
  position: absolute;
  width: 100%;
  height: 100%;
  /* Animation will be triggered via JavaScript after video */
  animation: none;
  /* Enable 3D space for children */
  transform-style: preserve-3d;
}

/* Trigger flip animation when this class is added */
.flipper.animate {
  animation: center-flip 4s ease-in-out forwards;
}

/* 3. Image Styling */
.front {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* 4. Keyframes for the combined animation */
@keyframes center-flip {
  /* Start: Already visible and in position, just start rotating */
  0% {
    transform: translateY(0) rotateY(0deg);
    opacity: 1;
  }

  /* Midpoint: Continue rotating */
  50% {
    transform: translateY(0) rotateY(180deg);
    opacity: 1;
  }

  /* End: Complete rotation */
  100% {
    transform: translateY(0) rotateY(360deg);
    opacity: 1;
  }
}

.shine {
  position: relative;
}
.shine::before {
  background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  content: "";
  display: block;
  height: 100%;
  left: -75%;
  position: absolute;
  top: 0;
  transform: skewX(-25deg);
  width: 50%;
  z-index: 2;
}
.shine:hover::before, .shine:focus::before {
  -webkit-animation: shine 0.85s;
          animation: shine 0.85s;
}
@-webkit-keyframes shine {
  100% {
    left: 125%;
  }
}
@keyframes shine {
  100% {
    left: 125%;
  }
}
.Donation {
    max-width: 120px;
    position: absolute;
    top: -62px;
    height: auto !important;
    left: 41px;
}
.boxes a:first-child .flipper span {
    top: -100px;
    font-size: 26px;
    color: #fff;
    left: -76px;
    text-transform: uppercase;
}
.boxes a:nth-child(2) .flipper img.Donation{
    -moz-transform: scaleY(-1);
    -o-transform: scaleY(-1);
    -webkit-transform: scaleY(-1);
    transform: scaleY(-1);
    filter: FlipV;
    -ms-filter: "FlipV";
    -moz-transform: scale(-1, -1);
    -o-transform: scale(-1, -1);
    -webkit-transform: scale(-1, -1);
    transform: scale(-1, -1);
    right: 47px;
    left: auto;
    top: auto;
    bottom: -65px;
}
.boxes a:nth-child(2) .flipper span {
    top: auto;
    font-size: 26px;
    color: #fff;
    left: 73px;
    bottom: -101px;
    text-transform: uppercase;
}
.boxes a:last-child .flipper span {
    top: -100px;
    font-size: 26px;
    color: #fff;
    left: 52px;
    text-transform: uppercase;
}
.boxes a:last-child .flipper img.Donation {
    -moz-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    filter: FlipH;
    -ms-filter: "FlipH";
    left: auto;
    right: 53px;
}
.backBtn a img {
    margin: auto;
    max-width: 160px;
}
.backBtn {
    margin-top: 134px;
}
.backBtn a {
    flex: 1;
    text-align: center;
}


@media screen and (min-width:668px) {
   .gift-container{
    background-image: url('{{ asset('images/center.png') }}');
   }
}
@media screen and (max-width:667.99px) {
    .gift-container{
    background-image: url('{{ asset('images/message-bg-mobile.png') }}');
    background-size: 100% 100%;
    background-position: center !important;
   }
   .overlayPuzzle, .logoBox{
    display:none;
   }
   .boxes a{
    width: auto;
   height: auto;
   display: inline-block
   }
   .giftBox {

    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    max-width: 375px;
    margin: auto;

}
.giftBox > div{
    width: 100%;
    max-width: 100%;
    margin: auto;
}
.flip-container {
    width: 170px;
    height: 170px;

}
.backBtn {
    position: fixed;
    bottom: 11px;
    left: 0;
    right: 0;
    text-align: center;
}
.backBtn a img {
    max-width: 100px;
}
.flip-container span {
    font-size: 14px !important;
    white-space: nowrap;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
}

.boxes{
    justify-content: unset
}
/* .boxes a:last-child{
    left: 14%
} */

a.category-link.shape-1 {
        position: absolute;
        top: 20%;
        left: 20%;
    }
a.category-link.shape-3 {
    position: absolute;
    right: 0;
    top: 40%;
}
a.category-link.shape-2 {
    position: absolute;
    left: 20px;
    top: 51%;
}
.Donation {
    max-width: 25px;

}

.category-link.shape-1 .Donation{
    transform: scaleX(-1);
    left: unset;
        right: 24px;
        top: -45px;
    }
    .category-link.shape-1 .category-name{
        top: -65px !important;
        left: unset !important;
        bottom: unset !important;
    }
    a.category-link.shape-2 img.Donation {
        bottom: unset !important;
        top: -42px !important;
        transform: scale(1, 1) !important;
        left: 32px !important;
}
.category-link.shape-2 span {
    bottom: unset !important;
        top: -63px !important;
        left: 27px !important;
        right: unset !important;
}
.category-link.shape-3 img.Donation {
    top: unset !important;
    transform: scale(-1, -1) !important;
    right: 24px !important;
    bottom: -47px;
}
a.category-link.shape-3 span {
    top: unset !important;
    bottom: -70px;
    left: unset !important;
}
}

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

    .video-page {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 41, 59, 0.9));
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
        }

        .video-page.hide {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .videoContainer video {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @media screen and (min-width:668px) {
            .videoContainer {
                width: 100%;
                max-width: 1440px;
                margin: 0 auto;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .mobileVideo {
                display: none;
            }
        }

        @media screen and (max-width:667.99px) {
            .desktopVideo {
                display: none;
            }
            .choose-bottom {

  bottom: 10% !important;

  max-width: 150px !important;
}
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
    animation: bounce 2s ease-in-out infinite;
}

@keyframes bounce {
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

        /* Initially hide gift container */
        .gift-container {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.8s ease-in-out 0.3s, visibility 0.8s ease-in-out 0.3s;
        }

        /* Show gift container after video */
        .gift-container.show {
            opacity: 1;
            visibility: visible;
        }
        
        .choose-bottom {
  position: absolute;
  left: 22%;
  bottom: 0;
  width: 100%;
  max-width: 250px;
}
</style>

<!-- Video Section - Shows first -->
<div class="video-page" id="videoPage">
    <div class="videoContainer">
        <video type="video/mp4" id="afterVideo" class="desktopVideo"
            src="{{ asset('images/videos/screen-2-video-desktop.mp4') }}" autoplay muted
            playsinline></video>
        <video type="video/mp4" id="afterVideomobile" class="mobileVideo"
            src="{{ asset('images/videos/screen-2-video-mobile.mp4') }}" autoplay muted
            playsinline></video>
    </div>
</div>

<!-- Gift Container Section - Shows after video -->
<div class="gift-container" id="giftContainer">
    <form method="POST" action="{{ route('demo.logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
        </button>
    </form>
    <img src="{{ asset('images/overlayPuzzle.png') }}" class="overlayPuzzle" />

    <div class="giftBox">
        <div class="logoBox">
           <img src="{{ asset('images/logo-golden.png') }}" class="logo" />
        </div>

        <div class="boxes">
            @foreach($categories as $key => $category)
                <a href="{{ route('demo.gifts.byCategory', $category) }}" class="category-link shape-{{  $key+1 }}" data-category="{{ $category->name }}">
                  <div class="flip-container">
                    <div class="flipper">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image" />
                        <span class="category-name">{{ $category->name }}</span>
                        <img src="{{ asset('images/arrow.png') }}" class="Donation" />
                    </div>
                  </div>
                </a>
            @endforeach
        </div>

        <div class="backBtn">
            <a href="{{ route('demo.journey') }}">
                <img src="{{ asset('images/back.png') }}" />
            </a>
        </div>
            <img class="choose-bottom" src="{{ asset('images/choose-bttom.png') }}" alt="">
    </div>
</div>

<script>
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

// Show modal after page loads
document.addEventListener('DOMContentLoaded', function() {
    // Show demo notice modal after a short delay
    setTimeout(() => {
        showDemoNotice();
    }, 800);
    
    // Original video control logic
    // Video control logic
    const videoDesktop = document.getElementById("afterVideo");
    const videoMobile = document.getElementById("afterVideomobile");
    const videoPage = document.getElementById("videoPage");
    const giftContainer = document.getElementById("giftContainer");
    const startTime = 1;  // Start at 1 second
    const endTime = 16;  // Stop at 16 seconds (adjust as needed)
    let videoEnded = false; // Flag to prevent multiple triggers

    // Check if video was already watched
    const videoWatchedKey = 'giftLabelVideoWatched';
    const videoAlreadyWatched = localStorage.getItem(videoWatchedKey) === 'true';

    // Function to directly show categories without video
    function showCategoriesDirectly() {
        // Hide video page immediately
        if (videoPage) {
            videoPage.style.display = 'none';
        }
        // Show gift container
        if (giftContainer) {
            giftContainer.classList.add('show');
            // Show category boxes
            setTimeout(() => {
                showCategoryBoxes();
                // Trigger flip animation
                setTimeout(() => {
                    triggerFlipAnimation();
                }, 1000);
            }, 100);
        }
    }

    // Function to smoothly show category boxes before flip
    function showCategoryBoxes() {
        const flipContainers = document.querySelectorAll('.flip-container');
        flipContainers.forEach((container, index) => {
            // Stagger the fade-in for each box
            setTimeout(() => {
                container.classList.add('ready');
            }, index * 150); // 150ms delay between each box
        });
    }

    // Function to trigger flip animation on category boxes
    function triggerFlipAnimation() {
        const flippers = document.querySelectorAll('.flipper');
        flippers.forEach((flipper, index) => {
            // Stagger the animation for each category box
            setTimeout(() => {
                flipper.classList.add('animate');
            }, index * 200); // 200ms delay between each box
        });
    }

    // Function to handle video end with smooth transition
    function handleVideoEnd() {
        // Mark video as watched in localStorage
        localStorage.setItem(videoWatchedKey, 'true');

        // Add fade out animation to video page
        videoPage.classList.add('hide');

        // After fade out completes, show gift container with fade in
        setTimeout(() => {
            giftContainer.classList.add('show');
            // First, smoothly show the category boxes
            setTimeout(() => {
                showCategoryBoxes();
                // Then trigger flip animation after boxes are fully visible
                // Wait enough time for all boxes to fade in (3 boxes * 150ms + 600ms buffer)
                setTimeout(() => {
                    triggerFlipAnimation();
                }, 1000); // Wait for all boxes to be fully visible before flipping
            }, 300); // Small delay after container appears
        }, 300); // Small delay for smooth transition
    }

    // Function to check if video reached endTime
    function checkEndTime(video) {
        if (video.currentTime >= endTime && !videoEnded) {
            videoEnded = true;
            // Smoothly fade out video before pausing
            video.style.transition = 'opacity 0.5s ease-out';
            video.style.opacity = '0';
            setTimeout(() => {
                video.pause();
                handleVideoEnd();
            }, 100); // Small delay for smooth fade
        }
    }

    // If video already watched, show categories directly
    if (videoAlreadyWatched) {
        showCategoriesDirectly();
    } else {
        // Desktop video handler
        if (videoDesktop) {
            videoDesktop.addEventListener("loadedmetadata", () => {
                videoDesktop.currentTime = startTime;
                videoDesktop.play().catch(err => {
                    console.log('Video autoplay prevented:', err);
                });
            });

            // Check for endTime during playback
            videoDesktop.addEventListener("timeupdate", () => {
                checkEndTime(videoDesktop);
            });

            // Fallback: Let video play completely if endTime is not reached
            videoDesktop.addEventListener("ended", () => {
                if (!videoEnded) {
                    videoEnded = true;
                    handleVideoEnd();
                }
            });
        }

        // Mobile video handler
        if (videoMobile) {
            videoMobile.addEventListener("loadedmetadata", () => {
                videoMobile.currentTime = startTime;
                videoMobile.play().catch(err => {
                    console.log('Video autoplay prevented:', err);
                });
            });

            // Check for endTime during playback
            videoMobile.addEventListener("timeupdate", () => {
                checkEndTime(videoMobile);
            });

            // Fallback: Let video play completely if endTime is not reached
            videoMobile.addEventListener("ended", () => {
                if (!videoEnded) {
                    videoEnded = true;
                    handleVideoEnd();
                }
            });
        }
    }

    // Category links click handler
    const categoryLinks = document.querySelectorAll('.category-link');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const categoryName = this.getAttribute('data-category');
            if (typeof toastr !== 'undefined') {
                toastr.success('Loading ' + categoryName + ' gifts...');
            }
        });
    });
});
</script>

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


