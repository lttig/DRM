<?php

# supplementary checks required for "key" and "kid" parameters
if ($_POST["input_content_id"] && is_numeric($_POST["input_content_id"])) {
    $uploaded_id = $_POST["input_content_id"];

    # this parameter should be looked up as a mysqli_insert_id($connection);
    $generated_id = 55;

    # these values should be generated like this "openssl rand -hex 16"
    $key_hex    = bin2hex(base64_decode($_POST["key"]));
    $key_id_hex = bin2hex(base64_decode($_POST["kid"]));

    exec(
        "/var/www/scripts/package.sh $uploaded_id $generated_id $key_id_hex $key_hex",
        $output,
        $result
    );
    # Scripted executed sucessfully or not
    if ($result == 0) {
        $generated_video_id_array = 
            array("packaged_content_id" => 55);
        header("Content-Type: application/json");
        echo json_encode($generated_video_id_array);
    } else {
        die ("video cot not be encrypted");
    }
}
    else die ("unknown content id");
?>
