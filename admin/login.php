<?php
session_start();
include("../config.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    $admin = mysqli_fetch_assoc($q);

    if ($admin) {

        // ✅ IF PASSWORD IS PLAIN TEXT
        if ($password === $admin['password']) {

            // Convert to HASH automatically
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE admin SET password='$newHash' WHERE username='$username'");

            $_SESSION['admin'] = $username;
            header("Location: manage_videos.php");
            exit;
        }

        // ✅ IF PASSWORD IS HASHED
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: manage_videos.php");
            exit;
        }
    }

    $error = "Invalid login details";
}
?>

<!-- UI BELOW IS UNCHANGED -->

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
    margin:0;
    height:100vh;
    background: radial-gradient(circle at center, #111, #000);
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
    color:#fff;
}

.box{
    width:360px;
    padding:40px;
    background:rgba(0,0,0,0.85);
    border-radius:10px;
    box-shadow:0 0 40px rgba(229,9,20,0.5);
}

h2{
    text-align:center;
    color:#e50914;
}

input,button{
    width:100%;
    padding:12px;
    margin-top:15px;
    background:#111;
    border:1px solid #333;
    color:#fff;
    border-radius:5px;
}

button{
    background:linear-gradient(145deg,#e50914,#b20710);
    font-weight:bold;
    cursor:pointer;
}

a{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#e50914;
    text-decoration:none;
}

.error{
    text-align:center;
    color:#ff4c4c;
}
</style>
</head>

<body>

<div class="box">
<h2>Admin Login</h2>

<?php if($error) echo "<div class='error'>$error</div>"; ?>

<form method="post">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>

<a href="forgot_password.php">Forgot Password?</a>
</div>

</body>
</html>
