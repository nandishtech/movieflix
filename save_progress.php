<?php
include("config.php");
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id) {
    $video_id = $data['video_id'];
    $time = $data['time'];

    mysqli_query($conn, "
    INSERT INTO watch_history (user_id, video_id, last_time)
    VALUES ($user_id, $video_id, $time)
    ON DUPLICATE KEY UPDATE last_time=$time
    ");
}
