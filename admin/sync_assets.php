<?php
include("../config.php");

$folder = "../assets/";
$files = scandir($folder);

foreach ($files as $file) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    // only video files
    if (in_array(strtolower($ext), ["mp4","webm","ogg"])) {

        // check if already in DB
        $check = mysqli_query($conn, "SELECT id FROM videos WHERE video='$file'");
        if (mysqli_num_rows($check) == 0) {

            $title = pathinfo($file, PATHINFO_FILENAME);

            mysqli_query($conn, "INSERT INTO videos (title, category, thumbnail, video)
            VALUES ('$title','movie','default.jpg','$file')");
        }
    }
}

echo "Assets synced successfully ✅";
