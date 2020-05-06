<?php

include 'config/vars.php';    

if (isset($_POST["input_content_id"])) {
    if (is_numeric($_POST["input_content_id"])) {
        $uploaded_id = (int) $_POST["input_content_id"];

        # Generate new content id
        $content_id = (int) file_get_contents($packaged_content_id_file);
        $content_id++;

        $key_hex    = rtrim(bin2hex(base64_decode($_POST["key"])), '=');
        $key_id_hex = rtrim(bin2hex(base64_decode($_POST["kid"])), '=');
        exec(
            "/var/www/scripts/package.sh $uploaded_id $content_id $key_id_hex $key_hex",
            $output,
            $result
        );
        # Script executed sucessfully or not
        if ($result == 0) {

            # Write new content id
            file_put_contents($packaged_content_id_file, $content_id);

	    # Write content id, key and kid in a file (or in a database)
	    $new_video_keys = $content_id.",".$_POST['key'].",".$_POST['kid'].PHP_EOL;
            file_put_contents($content_keys_file, $new_video_keys, FILE_APPEND);

	    # Delete unencrypted files
	    unlink ("temp/$uploaded_id.mp4");
	    unlink ("temp/$uploaded_id-video-fragmented.mp4");

	    # Send id for the new packaged content
            $generated_video_id_array = 
                array("packaged_content_id" => $content_id);
            header("Content-Type: application/json");
            echo json_encode($generated_video_id_array);
        } else {
            die ("video cot not be encrypted");
        }
    } else {
        die ("unknown content id");
    }
} else {
?>

<form action="/packaged_content" method="POST">
  <label for="input_content_id">Content id:</label>
  <input type="text" id="input_content_id" name="input_content_id">
  <label for="key">Key:</label>
  <input type="text" id="key" name="key">
  <label for="kid">Key ID:</label>
  <input type="text" id="kid" name="kid">
  <input type="submit" value="Generate encrypted video">
</form>

<?php
}
?>
