<?php

if ($_GET["content_id"] && is_numeric($_GET["content_id"])) {
    $content_id = $_GET["content_id"];

    # "key" and "kid" should be retrieved from a database (lookup for content_id)
    $video_details_array = 
        array(
            "url" => "http://localhost:8080/encrypted_videos/$content_id/stream.mpd",
            "key" => "hyN9IKGfWKdAwFaE5pm0qg",
            "kid" => "oW5AK5BW43HzbTSKpiu3SQ"
        );
    header("Content-Type: application/json");
    echo json_encode($video_details_array);

    }
else die ("unknown content id");
?>
