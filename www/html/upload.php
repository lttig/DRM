<?php
$target_dir = "temp/";
$target_file = $target_dir . '1.mp4';

if(! isset($_POST["submit"])) {
    die ("no file chosen");
}

if (move_uploaded_file($_FILES["upload_input_content"]["tmp_name"], $target_file)) {
    $content_array = array("input_content_id"=>1);
    header("Content-Type: application/json");
    echo json_encode($content_array);
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>
