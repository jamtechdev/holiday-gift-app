<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin: 0;
        }

        .video-page {
            min-height: 100vh;

            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 41, 59, 0.9));
            color: #fff;
        }

        .videoContainer video {
            width: 100%;
        }

        @media screen and (min-width:668px) {
            .videoContainer {
                width: 100%;
                max-width: 1440px;
                margin: 0 auto;
            }



            .mobileVideo {
                display: none;
            }
        }

        @media screen and (max-width:667.99px) {
            .desktopVideo {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="video-page">
        <div class="videoContainer">
            <video type="video/mp4" id="afterVideo" class=" desktopVideo"
                src="{{ asset('images//videos/screen-2-video-desktop.mp4') }} " controls autoplay muted
                playsinline></video>
            <video type="video/mp4" id="afterVideomobile" class=" mobileVideo"
                src="{{ asset('images//videos/screen-2-video-mobile.mp4') }} " controls autoplay muted
                playsinline></video>
        </div>
    </div>


    <script>
        const video = document.getElementsById("afterVideo");
        // const video2 = document.getElementsById("afterVideomobile");
        const startTime = 1;  // Start at 5 seconds
        const endTime = 16.5;   // Stop at 15 seconds

        video.addEventListener("loadedmetadata", () => {
            video.currentTime = startTime;
            video.play();

            // video2.currentTime = startTime;
            // video2.play();
        });

        video.addEventListener("timeupdate", () => {
            if (video.currentTime >= endTime) {
                video.pause(); // stop playback
            }


        });


    </script>
</body>

</html>