<?php
session_start();
include("../config.php");

$id = intval($_GET['id']);
$v = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM videos WHERE id=$id"));

@unlink("../assets/" . $v['thumbnail']);
@unlink("../assets/" . $v['video']);

mysqli_query($conn, "DELETE FROM videos WHERE id=$id");

header("Location: manage_videos.php");
exit;
