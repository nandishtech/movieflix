<?php
include("../config.php");
$msg = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $q=mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
    if($row=mysqli_fetch_assoc($q)){
        $token=bin2hex(random_bytes(32));
        mysqli_query($conn,"UPDATE admin SET reset_token='$token' WHERE id='{$row['id']}'");
        $msg="Reset link: reset_password.php?token=$token";
    } else {
        $msg="Admin not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<style>
body{background:#000;color:#fff;font-family:Arial;
display:flex;justify-content:center;align-items:center;height:100vh;}
.box{background:#111;padding:30px;border-radius:10px;width:350px;}
input,button{width:100%;padding:12px;margin-top:15px;}
button{background:#e50914;border:none;color:#fff;}
.msg{text-align:center;color:#ffcc00;}
</style>
</head>
<body>

<div class="box">
<h2>Forgot Password</h2>
<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>
<form method="post">
<input name="username" placeholder="Admin Username" required>
<button>Generate Reset Link</button>
</form>
</div>

</body>
</html>
