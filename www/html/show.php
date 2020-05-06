<?php

include "config/vars.php";

if ($_GET["content_id"] && is_numeric($_GET["content_id"])) {
    $content_id = $_GET["content_id"];

    # Retrieve "key" and "kid" (could be retrieved from a database)
    $file = fopen($content_keys_file,"r");
    $found = 0;
    while(! feof($file)) {
        list ($video_id, $key, $key_id) = explode(',',fgets($file));
	if ($content_id == $video_id) {
          $found=1;
	  break;
	}
    }
    fclose($file);

    if ($found) {
        $video_details_array = 
            array(
                "url" => "http://localhost:8080/encrypted_videos/$content_id/stream.mpd",
                "key" => $key,
                "kid" => $key_id
            );
        header("Content-Type: application/json");
        echo json_encode($video_details_array,  JSON_UNESCAPED_SLASHES);
    } else die ("content id not found");
} else die ("invalid content id");
?>
