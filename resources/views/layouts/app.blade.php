<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Holiday Gift App')</title>
    @vite(['resources/css/app.css'])

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('styles')

    <style>
        /* Christmas Toastr Theme - Enhanced UI */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999999;
        }

        .toast {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 50%, #c44569 100%);
            border: 4px solid #ff0000;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4),
                        0 0 30px rgba(255, 107, 107, 0.6),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: visible;
            min-width: 550px;
            max-width: 700px;
            padding: 12px 25px 12px 70px;
            margin-bottom: 15px;
            animation: slideInRight 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55),
                       giftBoxShake 0.8s ease-in-out 0.6s;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .toast:hover {
            transform: translateX(-5px) scale(1.02);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5),
                        0 0 40px rgba(255, 107, 107, 0.8),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .toast-success {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 50%, #37b24d 100%);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4),
                        0 0 30px rgba(81, 207, 102, 0.6),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .toast-success:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5),
                        0 0 40px rgba(81, 207, 102, 0.8),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .toast-error {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 50%, #c44569 100%);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4),
                        0 0 30px rgba(255, 107, 107, 0.6),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .toast-error:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5),
                        0 0 40px rgba(255, 107, 107, 0.8),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .toast-info {
            background: linear-gradient(135deg, #4dabf7 0%, #339af0 50%, #228be6 100%);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4),
                        0 0 30px rgba(77, 171, 247, 0.6),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .toast-info:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5),
                        0 0 40px rgba(77, 171, 247, 0.8),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .toast-warning {
            background: linear-gradient(135deg, #ffd43b 0%, #fcc419 50%, #fab005 100%);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4),
                        0 0 30px rgba(255, 212, 59, 0.6),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .toast-warning:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5),
                        0 0 40px rgba(255, 212, 59, 0.8),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        /* Red Icon Container */
        .toast::before {
            content: '❌';
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 36px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 0, 0, 0.2);
            border-radius: 50%;
            border: 2px solid #ff0000;
            animation: giftBounce 1.5s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
            filter: grayscale(0);
        }

        .toast-title {
            color: #fff;
            font-weight: 800;
            font-size: 18px;
            margin: 0 0 8px 0;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        .toast-message {
            color: #fff;
            font-size: 15px;
            margin: 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            line-height: 1.6;
            word-wrap: break-word;
        }

        /* Email link styling in toastr */
        .toast-message a[href^="mailto:"] {
            color: #ffd700 !important;
            font-weight: 700;
            text-decoration: none;
            padding: 4px 8px;
            background: rgba(255, 215, 0, 0.2);
            border-radius: 6px;
            border: 1px solid rgba(255, 215, 0, 0.4);
            display: inline-block;
            margin: 4px 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        }

        .toast-message a[href^="mailto:"]:hover {
            background: rgba(255, 215, 0, 0.3);
            border-color: rgba(255, 215, 0, 0.6);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        /* Progress Bar Styling */
        .toast-progress {
            background: rgba(255, 255, 255, 0.3) !important;
            height: 4px !important;
            border-radius: 0 0 16px 16px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Close Button */
        .toast-close-button {
            color: #fff !important;
            opacity: 0.9 !important;
            font-size: 22px !important;
            font-weight: bold !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5) !important;
            transition: all 0.3s ease !important;
            right: 15px !important;
            top: 15px !important;
        }

        .toast-close-button:hover {
            opacity: 1 !important;
            transform: rotate(90deg) scale(1.2) !important;
        }

        /* Snowflake Animation - Multiple */
        .toast::after {
            content: '❄';
            position: absolute;
            top: -15px;
            right: 30px;
            font-size: 24px;
            animation: snowflake 4s linear infinite;
            opacity: 0.9;
            filter: drop-shadow(0 2px 4px rgba(255, 255, 255, 0.5));
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(500px) scale(0.8);
                opacity: 0;
            }
            60% {
                transform: translateX(-10px) scale(1.05);
            }
            100% {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        @keyframes giftBoxShake {
            0%, 100% { transform: rotate(0deg) scale(1); }
            10% { transform: rotate(-3deg) scale(1.02); }
            20% { transform: rotate(3deg) scale(1.02); }
            30% { transform: rotate(-2deg) scale(1.01); }
            40% { transform: rotate(2deg) scale(1.01); }
            50% { transform: rotate(0deg) scale(1); }
        }

        @keyframes giftBounce {
            0%, 100% {
                transform: translateY(-50%) scale(1) rotate(0deg);
            }
            25% {
                transform: translateY(-55%) scale(1.1) rotate(-5deg);
            }
            50% {
                transform: translateY(-50%) scale(1) rotate(0deg);
            }
            75% {
                transform: translateY(-55%) scale(1.1) rotate(5deg);
            }
        }

        @keyframes snowflake {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.9;
            }
            100% {
                transform: translateY(120px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Multiple snowflakes */
        .toast .snowflake {
            position: absolute;
            color: #fff;
            font-size: 14px;
            opacity: 0.7;
            animation: snowflake 5s linear infinite;
            filter: drop-shadow(0 1px 2px rgba(255, 255, 255, 0.6));
            pointer-events: none;
        }

        .toast .snowflake:nth-child(1) { right: 15%; animation-delay: 0s; font-size: 12px; }
        .toast .snowflake:nth-child(2) { right: 35%; animation-delay: 0.8s; font-size: 16px; }
        .toast .snowflake:nth-child(3) { right: 55%; animation-delay: 1.6s; font-size: 14px; }
        .toast .snowflake:nth-child(4) { right: 75%; animation-delay: 2.4s; font-size: 13px; }

        /* Responsive Design */
        @media (max-width: 768px) {
            #toast-container {
                right: 10px;
                left: 10px;
                top: 10px;
            }

            .toast {
                min-width: auto;
                width: 100%;
                max-width: 100%;
                padding: 12px 20px 12px 65px;
            }

            .toast::before {
                font-size: 28px;
                width: 45px;
                height: 45px;
                left: 15px;
            }

            .toast-title {
                font-size: 16px;
            }

            .toast-message {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @include('partials.loader')
    @yield('content')

    <!-- jQuery (required for toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Wait for DOM and toastr to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Christmas Toastr Configuration
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000000000",
                    "timeOut": "50000000",
                    "extendedTimeOut": "100000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": true
                };

                // Use MutationObserver to add snowflakes and convert emails to links when toast appears
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1 && node.classList && node.classList.contains('toast')) {
                                addSnowflakes(node);
                                // Convert email addresses to styled links
                                convertEmailsToLinks(node);
                            }
                        });
                    });
                });

                // Observe the toast container
                const toastContainer = document.getElementById('toast-container');
                if (toastContainer) {
                    observer.observe(toastContainer, { childList: true });
                } else {
                    // If container doesn't exist yet, wait a bit and try again
                    setTimeout(function() {
                        const container = document.getElementById('toast-container');
                        if (container) {
                            observer.observe(container, { childList: true });
                        }
                    }, 500);
                }
            }
        });

        function addSnowflakes(toast) {
            if (!toast) return;

            // Remove existing snowflakes
            const existing = toast.querySelectorAll('.snowflake');
            existing.forEach(el => el.remove());

            // Add new snowflakes
            for (let i = 0; i < 4; i++) {
                const snowflake = document.createElement('span');
                snowflake.className = 'snowflake';
                snowflake.innerHTML = '❄';
                snowflake.style.position = 'absolute';
                snowflake.style.right = (10 + i * 20) + '%';
                snowflake.style.top = '0';
                snowflake.style.animationDelay = (i * 0.5) + 's';
                toast.appendChild(snowflake);
            }
        }

        function convertEmailsToLinks(toast) {
            if (!toast) return;

            // Find the message element
            const messageElement = toast.querySelector('.toast-message');
            if (!messageElement) return;

            const text = messageElement.innerHTML;
            // Email regex pattern
            const emailRegex = /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9_-]+)/gi;

            // Check if email exists and is not already a link
            if (emailRegex.test(text) && !text.includes('<a href="mailto:')) {
                const newText = text.replace(emailRegex, function(email) {
                    return '<a href="mailto:' + email + '">' + email + '</a>';
                });
                messageElement.innerHTML = newText;
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
