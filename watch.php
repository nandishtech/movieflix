<?php
session_start();
include("config.php");

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user/login.php");
    exit;
}

// Get video ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch video
$v = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM videos WHERE id=$id"));
if (!$v) {
    echo "Video not found";
    exit;
}

// Fetch last watched time
$user_id = $_SESSION['user_id'];
$history = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT last_time FROM watch_history WHERE user_id=$user_id AND video_id=$id"
));
$last_time = $history['last_time'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
<title><?= htmlspecialchars($v['title']) ?></title>

<style>
body {
    margin: 0;
    background: #000;
    color: #fff;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
}

h1 {
    margin: 20px 0;
}

video {
    width: 85%;
    max-width: 900px;
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(255,0,0,0.3);
}
</style>
</head>

<body>

<h1><?= htmlspecialchars($v['title']) ?></h1>

<video id="player" controls>
    <source src="assets/<?= htmlspecialchars($v['video']) ?>" type="video/mp4">
    Your browser does not support video.
</video>

<script>
const player = document.getElementById("player");

// Resume from last time
player.addEventListener("loadedmetadata", () => {
    player.currentTime = <?= $last_time ?>;
});

// Save progress
player.addEventListener("timeupdate", () => {
    fetch("save_progress.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            video_id: <?= $v['id'] ?>,
            time: player.currentTime
        })
    });
});
</script>

</body>
</html>
