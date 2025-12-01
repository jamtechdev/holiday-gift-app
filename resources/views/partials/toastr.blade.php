<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    /* Toastr Theme - Enhanced UI */
    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 999999;
    }

    .toast {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        min-width: 320px;
        max-width: 500px;
        padding: 16px 20px 16px 60px;
        margin-bottom: 12px;
    }

    /* Ensure toastr's fadeOut works properly */
    #toast-container .toast {
        opacity: 1;
    }

    .toast:hover {
        transform: translateX(-2px);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.18), 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .toast-success {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .toast-success:hover {
        box-shadow: 0 6px 24px rgba(16, 185, 129, 0.2), 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .toast-error {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 20px rgba(239, 68, 68, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .toast-error:hover {
        box-shadow: 0 6px 24px rgba(239, 68, 68, 0.2), 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .toast-info {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .toast-info:hover {
        box-shadow: 0 6px 24px rgba(59, 130, 246, 0.2), 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .toast-info .toast-message {
        color: #3b82f6;
        font-weight: 600;
    }

    .toast-warning {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 20px rgba(245, 158, 11, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .toast-warning:hover {
        box-shadow: 0 6px 24px rgba(245, 158, 11, 0.2), 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .toast-warning .toast-message {
        color: #f59e0b;
        font-weight: 600;
    }

    /* Icon container - Show icons for success and error */
    .toast::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
        font-size: 20px;
        font-weight: bold;
        line-height: 24px;
        text-align: center;
    }
    
    .toast-success::before {
        content: '✓';
        color: #10b981;
    }
    
    .toast-error::before {
        content: '✕';
        color: #ef4444;
    }
    
    .toast-info::before,
    .toast-warning::before {
        display: none;
    }

    .toast-title {
        display: none;
    }

    .toast-message {
        color: #1f2937;
        font-size: 15px;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
        word-wrap: break-word;
        letter-spacing: -0.01em;
    }

    .toast-success .toast-message {
        color: #10b981;
        font-weight: 600;
    }

    .toast-error .toast-message {
        color: #1f2937;
        font-weight: 500;
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

    /* Progress Bar Styling - Only Red for Error, Green for Success */
    #toast-container > .toast .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        opacity: 1;
    }

    .toast-success .toast-progress {
        background-color: #10b981 !important;
    }

    .toast-error .toast-progress {
        background-color: #ef4444 !important;
    }

    /* Hide progress bar for info and warning */
    .toast-info .toast-progress,
    .toast-warning .toast-progress {
        display: none !important;
    }

    /* Close Button - Hidden */
    .toast-close-button {
        display: none !important;
    }

    /* Remove snowflake animation */
    .toast::after {
        display: none;
    }

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
            padding: 14px 18px;
        }

        .toast-message {
            font-size: 14px;
        }
    }
</style>

<!-- jQuery (required for toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Wait for DOM and toastr to be fully loaded
    $(document).ready(function() {
        // Configure toastr BEFORE showing any toasts
        if (typeof toastr !== 'undefined') {
            // Configure toastr with proper auto-hide settings
            toastr.options = {
                closeButton: false,
                debug: false,
                newestOnTop: true,
                progressBar: true,  // Show progress bar when hiding
                positionClass: "toast-top-right",
                preventDuplicates: true,
                onclick: null,
                showDuration: 300,
                hideDuration: 300,
                timeOut: 6000,  // Auto-hide after 6 seconds (increased from 4)
                extendedTimeOut: 2000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: true
            };

            // Wait for loader to finish before showing toasts (minimum 2 seconds)
            // const loaderDelay = 2000;
            // const startTime = Date.now();

            const showToasts = () => {
                // const elapsed = Date.now() - startTime;
                // const remaining = Math.max(0, loaderDelay - elapsed);
                
                // setTimeout(() => {
                    // Show toast for session flash messages
                    @if(session('success'))
                        toastr.success("{{ session('success') }}");
                    @endif

                    @if(session('error'))
                        toastr.error("{{ session('error') }}");
                    @endif

                    @if(session('status'))
                        toastr.success("{{ session('status') }}");
                    @endif

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            toastr.error("{{ $error }}");
                        @endforeach
                    @endif
                // }, remaining);
            };

            // Wait for page load and minimum delay
            if (document.readyState === 'complete') {
                showToasts();
            } else {
                window.addEventListener('load', showToasts);
                // Fallback
                // setTimeout(showToasts, loaderDelay);
            }

            // Use MutationObserver to convert emails to links when toast appears
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && node.classList && node.classList.contains('toast')) {
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

