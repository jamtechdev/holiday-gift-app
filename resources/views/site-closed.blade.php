<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Closed - Graphtech Holiday Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: "Montserrat", sans-serif;
        }

        .site-closed-container {
            min-height: 100vh;
            width: 100%;
            padding: 2rem 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated snowflakes */
        .snowflake {
            position: absolute;
            top: -10px;
            color: white;
            font-size: 1.5rem;
            animation: fall linear infinite;
            opacity: 0.7;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.7;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Twinkling stars */
        .star {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            animation: twinkle 2s infinite;
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.5);
            }
        }

        /* Floating gift boxes */
        .gift-box {
            position: absolute;
            width: 60px;
            height: 60px;
            opacity: 0.2;
            animation: float 6s ease-in-out infinite;
        }

        .gift-box::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #dc2626, #ea580c);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .gift-box::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 8px;
            background: #fbbf24;
            transform: translateY(-50%);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .closed-message-container {
            max-width: 750px;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 70px 60px;
            box-shadow: 
                0 25px 70px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            text-align: center;
            position: relative;
            z-index: 10;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Christmas tree icon */
        .christmas-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 2.5rem;
            position: relative;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-10px) scale(1.05);
            }
        }

        .christmas-tree {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .tree-part {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
        }

        .tree-top {
            bottom: 80px;
            border-bottom: 30px solid #16a34a;
            animation: glow 2s ease-in-out infinite;
        }

        .tree-middle {
            bottom: 50px;
            border-bottom: 35px solid #22c55e;
            animation: glow 2s ease-in-out infinite 0.3s;
        }

        .tree-bottom {
            bottom: 0;
            border-bottom: 40px solid #15803d;
            animation: glow 2s ease-in-out infinite 0.6s;
        }

        .tree-trunk {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 15px;
            height: 30px;
            background: #92400e;
            border-radius: 4px;
        }

        .tree-star {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 20px solid #fbbf24;
            animation: sparkle 1.5s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% {
                filter: brightness(1);
            }
            50% {
                filter: brightness(1.3);
            }
        }

        @keyframes sparkle {
            0%, 100% {
                transform: translateX(-50%) scale(1) rotate(0deg);
                opacity: 1;
            }
            50% {
                transform: translateX(-50%) scale(1.2) rotate(180deg);
                opacity: 0.8;
            }
        }

        .closed-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #dc2626, #ea580c, #dc2626);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            line-height: 1.3;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        .closed-message-text {
            font-size: 1.2rem;
            color: #475569;
            margin-bottom: 2.5rem;
            line-height: 1.8;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .closed-email {
            font-size: 1.2rem;
            color: #334155;
            margin-bottom: 3rem;
            line-height: 1.8;
            animation: fadeIn 1s ease-out 0.5s both;
        }

        .closed-email a {
            color: #dc2626;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            display: inline-block;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(234, 88, 12, 0.1));
            border: 2px solid transparent;
        }

        .closed-email a:hover {
            color: #ea580c;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.15), rgba(234, 88, 12, 0.15));
            border-color: #dc2626;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
        }

        .closed-thanks {
            font-size: 1.1rem;
            color: #64748b;
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 2px solid #e2e8f0;
            font-style: italic;
            animation: fadeIn 1s ease-out 0.7s both;
        }

        /* Decorative elements */
        .decoration {
            position: absolute;
            font-size: 2rem;
            opacity: 0.3;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @media screen and (max-width: 768px) {
            .closed-message-container {
                padding: 50px 35px;
                margin: 1rem;
                border-radius: 25px;
            }
            
            .christmas-icon {
                width: 100px;
                height: 100px;
                margin-bottom: 2rem;
            }
            
            .closed-title {
                font-size: 2rem;
                margin-bottom: 1.25rem;
            }
            
            .closed-message-text {
                font-size: 1.05rem;
                margin-bottom: 2rem;
            }
            
            .closed-email {
                font-size: 1.05rem;
                margin-bottom: 2.5rem;
            }
            
            .closed-thanks {
                font-size: 1rem;
                margin-top: 2.5rem;
                padding-top: 2rem;
            }

            .snowflake {
                font-size: 1.2rem;
            }

            .gift-box {
                width: 50px;
                height: 50px;
            }
        }

        @media screen and (max-width: 480px) {
            .site-closed-container {
                padding: 1rem;
            }

            .closed-message-container {
                padding: 40px 25px;
            }

            .christmas-icon {
                width: 80px;
                height: 80px;
            }

            .closed-title {
                font-size: 1.6rem;
            }

            .closed-message-text,
            .closed-email {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="site-closed-container">
        <!-- Animated snowflakes -->
        <div class="snowflake" style="left: 10%; animation-duration: 10s;">❄</div>
        <div class="snowflake" style="left: 20%; animation-duration: 12s; animation-delay: 1s;">❅</div>
        <div class="snowflake" style="left: 30%; animation-duration: 11s; animation-delay: 2s;">❆</div>
        <div class="snowflake" style="left: 40%; animation-duration: 13s; animation-delay: 0.5s;">❄</div>
        <div class="snowflake" style="left: 50%; animation-duration: 10s; animation-delay: 1.5s;">❅</div>
        <div class="snowflake" style="left: 60%; animation-duration: 12s; animation-delay: 2.5s;">❆</div>
        <div class="snowflake" style="left: 70%; animation-duration: 11s; animation-delay: 0.8s;">❄</div>
        <div class="snowflake" style="left: 80%; animation-duration: 13s; animation-delay: 1.8s;">❅</div>
        <div class="snowflake" style="left: 90%; animation-duration: 10s; animation-delay: 0.3s;">❆</div>

        <!-- Twinkling stars -->
        <div class="star" style="top: 15%; left: 15%; animation-delay: 0s;"></div>
        <div class="star" style="top: 25%; left: 85%; animation-delay: 0.5s;"></div>
        <div class="star" style="top: 35%; left: 25%; animation-delay: 1s;"></div>
        <div class="star" style="top: 45%; left: 75%; animation-delay: 1.5s;"></div>
        <div class="star" style="top: 55%; left: 10%; animation-delay: 0.3s;"></div>
        <div class="star" style="top: 65%; left: 90%; animation-delay: 0.8s;"></div>
        <div class="star" style="top: 75%; left: 30%; animation-delay: 1.2s;"></div>
        <div class="star" style="top: 85%; left: 70%; animation-delay: 0.6s;"></div>

        <!-- Floating gift boxes -->
        <div class="gift-box" style="left: 5%; top: 20%; animation-delay: 0s;"></div>
        <div class="gift-box" style="left: 85%; top: 40%; animation-delay: 2s;"></div>
        <div class="gift-box" style="left: 10%; top: 70%; animation-delay: 4s;"></div>
        <div class="gift-box" style="left: 90%; top: 80%; animation-delay: 1s;"></div>

        <div class="closed-message-container">
            <div class="christmas-icon">
                <div class="christmas-tree">
                    <div class="tree-star"></div>
                    <div class="tree-part tree-top"></div>
                    <div class="tree-part tree-middle"></div>
                    <div class="tree-part tree-bottom"></div>
                    <div class="tree-trunk"></div>
                </div>
            </div>
            
            <div class="closed-message">
                <h1 class="closed-title">
                    The Graphtech Holiday Web Shop is now closed for the season.
                </h1>
                
                <p class="closed-message-text">
                    If you need immediate assistance, please email us at:
                </p>
                
                <p class="closed-email">
                    <a href="mailto:info@thinkgraphtech.com">info@thinkgraphtech.com</a>
                </p>
                
                <p class="closed-thanks">
                    Thank you to everyone who participated! 🎁✨
                </p>
            </div>
        </div>
    </div>

    <script>
        // Add more dynamic snowflakes
        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.className = 'snowflake';
            snowflake.innerHTML = ['❄', '❅', '❆'][Math.floor(Math.random() * 3)];
            snowflake.style.left = Math.random() * 100 + '%';
            snowflake.style.animationDuration = (Math.random() * 5 + 8) + 's';
            snowflake.style.animationDelay = Math.random() * 3 + 's';
            document.querySelector('.site-closed-container').appendChild(snowflake);
            
            setTimeout(() => {
                snowflake.remove();
            }, 15000);
        }

        // Create snowflakes periodically
        setInterval(createSnowflake, 500);

        // Add sparkle effect to email link on hover
        document.querySelector('.closed-email a')?.addEventListener('mouseenter', function() {
            this.style.animation = 'sparkle 0.5s ease-in-out';
        });
    </script>
</body>
</html>
