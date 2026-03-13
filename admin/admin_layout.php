<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>MovieFlix Admin</title>

<style>
/* BASE */
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #000;
    color: #fff;
    overflow: hidden;
}

/* WATERMARK BACKGROUND */
body::before {
    content: "MOVIEFLIX";
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-20deg);
    font-size: 180px;
    font-weight: 900;
    color: rgba(255, 0, 0, 0.05);
    z-index: 0;
    animation: wave 8s ease-in-out infinite;
    text-shadow:
        0 0 20px rgba(255,0,0,0.15),
        0 0 40px rgba(255,0,0,0.1);
}

/* WATERMARK ANIMATION */
@keyframes wave {
    0%   { transform: translate(-50%, -50%) rotate(-20deg); }
    50%  { transform: translate(-48%, -52%) rotate(-18deg); }
    100% { transform: translate(-50%, -50%) rotate(-20deg); }
}

/* ADMIN LAYOUT */
.admin-container {
    display: flex;
    min-height: 100vh;
    position: relative;
    z-index: 2;
}

/* SIDEBAR */
.sidebar {
    width: 230px;
    background: rgba(10,10,10,0.95);
    padding: 25px;
    box-shadow: 4px 0 20px rgba(0,0,0,0.6);
}

.sidebar h2 {
    color: #e50914;
    margin-bottom: 30px;
    letter-spacing: 2px;
}

.sidebar a {
    display: block;
    padding: 14px;
    color: #bbb;
    text-decoration: none;
    border-radius: 6px;
    margin-bottom: 12px;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #e50914;
    color: #fff;
    transform: translateX(5px);
}

/* CONTENT AREA */
.content {
    flex: 1;
    padding: 40px;
    overflow-y: auto;
    position: relative;
}

/* HEADINGS */
h1 {
    font-size: 36px;
    margin-bottom: 20px;
    text-shadow: 0 0 15px rgba(255,0,0,0.2);
}

/* BUTTONS */
.btn {
    background: linear-gradient(145deg, #e50914, #b20710);
    color: #fff;
    padding: 12px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    box-shadow: 0 10px 20px rgba(0,0,0,0.4);
    transition: 0.3s;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.6);
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    background: rgba(15,15,15,0.85);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 14px;
    border-bottom: 1px solid #333;
}

th {
    background: rgba(255,255,255,0.05);
    text-transform: uppercase;
    font-size: 14px;
}

.actions a {
    color: #e50914;
    margin-right: 12px;
    text-decoration: none;
    font-weight: bold;
}

/* FORM */
input, select {
    width: 320px;
    padding: 12px;
    background: #111;
    border: 1px solid #333;
    color: #fff;
    border-radius: 5px;
    margin-bottom: 15px;
}
.password-wrapper {
    max-width: 450px;
    margin: auto;
    padding: 40px;
    background: rgba(0,0,0,0.6);
    border-radius: 10px;
    box-shadow: 0 0 20px red;
    text-align: center;
}

.password-wrapper h2 {
    margin-bottom: 20px;
}

.password-form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    background: #111;
    border: 1px solid #333;
    color: white;
    border-radius: 5px;
}

.password-form button {
    width: 100%;
    padding: 12px;
    background: red;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.back-btn {
    display: inline-block;
    margin-bottom: 15px;
    color: white;
    text-decoration: none;
    background: #222;
    padding: 8px 14px;
    border-radius: 5px;
}
.back-btn:hover {
    background: red;
}

.msg {
    margin-bottom: 10px;
    color: yellow;
}
.toggle-btn {
    position: fixed;
    top: 15px;
    left: 15px;
    background: red;
    color: white;
    border: none;
    padding: 10px 14px;
    font-size: 20px;
    cursor: pointer;
    z-index: 2000;
    border-radius: 6px;
}

.sidebar {
    width: 230px;
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    background: #0b0b0b;
    transition: transform 0.3s ease;
    z-index: 1000;
}

.sidebar.closed {
    transform: translateX(-100%);
}
.main-content {
    margin-left: 230px;
    padding: 30px;
    transition: margin-left 0.3s ease;
}

.main-content.full {
    margin-left: 0;
}
</style>
</head>

<body>
<button id="toggleSidebar" class="toggle-btn">☰</button>
<div class="main-content">
<div class="admin-container">
    <div class="sidebar">
        <h2>MovieFlix</h2>
        <a href="manage_videos.php">Manage Videos</a>
        <a href="upload.php">Upload Video</a>
        <a href="logout.php">Logout</a>
        <a href="change_password.php">🔒 Change Password</a>
   <script>
document.getElementById("toggleSidebar").addEventListener("click", function() {
    document.querySelector(".sidebar").classList.toggle("closed");
    document.querySelector(".main-content").classList.toggle("full");
});
</script>


    </div>

    <div class="content">
