<?php

include "config/vars.php";

if ($_GET["content_id"] && is_numeric($_GET["content_id"])) {
    $content_id = $_GET["content_id"];

    # Retrieve "key" and "kid" (could be retrieved from a database)
    $file = fopen($content_keys_file,"r");
    $found = 0;
    while(! feof($file)) {
        list ($video_id, $key, $key_id) = explode(',',rtrim(fgets($file)));
        if ($content_id == $video_id) {
          $found=1;
          break;
        }
    }
    fclose($file);

    if ($found) {
?>

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
                        <?php echo "\"$key\": \"$key_id\""; ?>
                    }
                }
            };
            var video,
                player,
                url = "/encrypted_videos/<?php echo $content_id; ?>/stream.mpd";

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
<?php
    } else { 
        die("video not found");
    }
} else { 
    die("video not found");
}
?>
