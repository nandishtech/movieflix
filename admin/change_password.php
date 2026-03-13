<?php
session_start();
include("../config.php");
include("admin_layout.php"); // IMPORTANT

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $msg = "Passwords do not match";
    } else {

        $user = $_SESSION['admin'];
        $q = mysqli_query($conn, "SELECT password FROM admin WHERE username='$user'");
        $row = mysqli_fetch_assoc($q);

        if (password_verify($old, $row['password']) || $old === $row['password']) {

            $hash = password_hash($new, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE admin SET password='$hash' WHERE username='$user'");
            $msg = "Password updated successfully";

        } else {
            $msg = "Old password incorrect";
        }
    }
}
?>

<div class="admin-content">
    <h2>Change Password</h2>

    <?php if($msg) echo "<p class='success'>$msg</p>"; ?>

    <form method="POST">
        <input type="password" name="old_password" placeholder="Old Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Update Password</button>
    </form>
</div>
