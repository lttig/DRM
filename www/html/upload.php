<?php

include "config/vars.php";

if(! isset($_POST["submit"])) {
?>

<!DOCTYPE html>
<html>
<body>

<form action="upload_input_content" method="post" enctype="multipart/form-data">
    Select video to upload:
    <input type="file" name="upload_input_content" id="upload_input_content">
    <input type="submit" value="Upload video" name="submit">
</form>
</body>
</html>

<?php

} else {
    # Read new content id
    $input_id = (int) file_get_contents($input_content_id_file);
    $input_id++;
    $target_dir = "temp/";
    $target_file = "$target_dir$input_id.mp4";

    if (move_uploaded_file($_FILES["upload_input_content"]["tmp_name"], $target_file)) {

        # Test if the file is a video
        exec(
            "/usr/local/Bento4/bin/mp4dump $target_file|wc -l",
            $output,
            $result
        );
        # No lines in output means the file is not a video
        if ( (int) $output[0] > 0) {
            # Write new content id
    	    file_put_contents($input_content_id_file, $input_id);

            $content_array = array("input_content_id"=>$input_id);
            header("Content-Type: application/json");
            echo json_encode($content_array);
        } else {
          # Delete the uploaded file
          unlink ($target_file);
          # Send the message to the user
          die ("The file is not a valid video");
        }
    } else {
        echo "Sorry, there was an error uploading your video.";
    }
}
?>
