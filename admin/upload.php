<?php
include("../config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $category = $_POST['category'];

    $thumbnail_name = $_FILES['thumbnail']['name'];
    $thumbnail_tmp  = $_FILES['thumbnail']['tmp_name'];

    $video_name = $_FILES['video']['name'];
    $video_tmp  = $_FILES['video']['tmp_name'];

    // move files
    move_uploaded_file($thumbnail_tmp, "../assets/" . $thumbnail_name);
    move_uploaded_file($video_tmp, "../assets/" . $video_name);

    // insert into DB
    $sql = "INSERT INTO videos (title, category, thumbnail, video)
            VALUES ('$title','$category','$thumbnail_name','$video_name')";
    mysqli_query($conn, $sql);

    header("Location: manage_videos.php");
    exit;
}

include("admin_layout.php");
?>

<h1>Upload Video</h1>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Video Title" required><br><br>

    <select name="category">
        <option value="movie">Movie</option>
        <option value="anime">Anime</option>
        <option value="series">Series</option>
    </select><br><br>

    <input type="file" name="thumbnail" required><br><br>
    <input type="file" name="video" required><br><br>

    <button class="btn">Upload</button>
    <a href="manage_videos.php" class="btn">Back</a>
</form>

</div>
</div>
</body>
</html>
