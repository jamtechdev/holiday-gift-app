<div id="global-loader" class="loader-overlay">
    <div class="loader-container">
        <div class="gift-box">
            <div class="gift-lid">🎁</div>
            <div class="gift-sparkles">
                <span>✨</span>
                <span>⭐</span>
                <span>✨</span>
                <span>💫</span>
            </div>
        </div>
        <div class="loader-progress">
            <div class="progress-bar"></div>
        </div>
        <p class="loader-text">Preparing Holiday Magic...</p>
    </div>
</div>

<style>
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.3) 0, transparent 20%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.25) 0, transparent 18%),
            radial-gradient(circle at 65% 70%, rgba(255, 255, 255, 0.22) 0, transparent 22%),
            linear-gradient(180deg, rgba(207, 212, 221, 0.9), rgba(146, 154, 168, 0.88));
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        transition: opacity 0.3s ease-out;
    }

    .loader-container {
        text-align: center;
        color: white;
    }

    .gift-box {
        position: relative;
        margin-bottom: 2rem;
    }

    .gift-lid {
        font-size: 5rem;
        animation: giftFloat 2s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
    }

    @keyframes giftFloat {

        0%,
        100% {
            transform: translateY(0px) rotate(-2deg);
        }

        50% {
            transform: translateY(-15px) rotate(2deg);
        }
    }

    .gift-sparkles {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120px;
        height: 120px;
    }

    .gift-sparkles span {
        position: absolute;
        font-size: 1.5rem;
        animation: sparkle 1.5s ease-in-out infinite;
    }

    .gift-sparkles span:nth-child(1) {
        top: 0;
        left: 50%;
        animation-delay: 0s;
    }

    .gift-sparkles span:nth-child(2) {
        top: 50%;
        right: 0;
        animation-delay: 0.3s;
    }

    .gift-sparkles span:nth-child(3) {
        bottom: 0;
        left: 50%;
        animation-delay: 0.6s;
    }

    .gift-sparkles span:nth-child(4) {
        top: 50%;
        left: 0;
        animation-delay: 0.9s;
    }

    @keyframes sparkle {

        0%,
        100% {
            opacity: 0;
            transform: scale(0.5);
        }

        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }

    .loader-progress {
        width: 200px;
        height: 4px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
        margin: 0 auto 1rem;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #fff, rgba(255, 255, 255, 0.8));
        border-radius: 2px;
        animation: progress 2s ease-in-out infinite;
    }

    @keyframes progress {
        0% {
            width: 0%;
        }

        50% {
            width: 70%;
        }

        100% {
            width: 100%;
        }
    }

    .loader-text {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        opacity: 0.95;
        animation: textPulse 2s ease-in-out infinite;
    }

    @keyframes textPulse {

        0%,
        100% {
            opacity: 0.7;
        }

        50% {
            opacity: 1;
        }
    }

    .loader-hidden {
        opacity: 0;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loader = document.getElementById('global-loader');
        if (!loader) return;

        const hideLoader = () => {
            if (loader.classList.contains('loader-hidden')) return;
            loader.classList.add('loader-hidden');
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        };

        window.addEventListener('load', hideLoader);
        // Fallback in case 'load' never fires (e.g. cached assets)
        setTimeout(hideLoader, 1500);
    });
</script>