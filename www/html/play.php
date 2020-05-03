<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Play clearkey example</title>

    <script src="js/dash.all.debug.js"></script>

    <script  class="code">
        function init() {
            const protData = {
                "org.w3.clearkey": {
                    "clearkeys": {
                        "oW5AK5BW43HzbTSKpiu3SQ": "hyN9IKGfWKdAwFaE5pm0qg"
                    }
                }
            };
            var video,
                player,
                url = "/encrypted_videos/55/stream.mpd";

            video = document.querySelector("video");
            player = dashjs.MediaPlayer().create();
            player.initialize(video, url, true);
            player.setProtectionData(protData);
        }
    </script>

    <style>
        video {
            width: 640px;
            height: 360px;
        }
    </style>
</head>
<body>
<div >
    <video controls="true">
    </video>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        init();
    });
</script>
</body>
</html>
