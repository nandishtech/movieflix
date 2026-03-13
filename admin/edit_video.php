<?php
include("admin_layout.php");
include("../config.php");

$id = intval($_GET['id']);
$v = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM videos WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    mysqli_query($conn, "UPDATE videos SET 
        title='{$_POST['title']}',
        category='{$_POST['category']}'
        WHERE id=$id");

    header("Location: manage_videos.php");
}
?>

<h1>Edit Video</h1>

<form method="post">
    <input type="text" name="title" value="<?= $v['title'] ?>" required><br><br>

    <select name="category">
        <option value="movie" <?= $v['category']=='movie'?'selected':'' ?>>Movie</option>
        <option value="anime" <?= $v['category']=='anime'?'selected':'' ?>>Anime</option>
        <option value="series" <?= $v['category']=='series'?'selected':'' ?>>Series</option>
    </select><br><br>

    <button class="btn">Update</button>
    <a href="manage_videos.php" class="btn">Back</a>
</form>

</div>
</div>
</body>
</html>
