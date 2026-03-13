<?php
session_start();
include("../config.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,"SELECT id FROM users WHERE username='$u'");
    if(mysqli_num_rows($check) > 0){
        $error = "Username already exists";
    } else {
        mysqli_query($conn,"INSERT INTO users(username,email,password) VALUES('$u','$e','$p')");
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>MovieFlix | Register</title>

<style>
body{
    margin:0;
    background:#000;
    color:#fff;
    font-family:Arial, Helvetica, sans-serif;
    overflow:hidden;
}

/* BACKGROUND */
#bg{
    position:fixed;
    inset:0;
    pointer-events:none;
    z-index:0;
}

/* CENTER ROTATING WATERMARK */
#center-logo{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    font-size:140px;
    font-weight:900;
    letter-spacing:10px;
    color:rgba(255,0,0,0.08);
    text-shadow:0 0 40px rgba(255,0,0,0.2);
    animation: spin 40s linear infinite;
}

@keyframes spin{
    from{ transform:translate(-50%,-50%) rotate(0deg); }
    to{ transform:translate(-50%,-50%) rotate(360deg); }
}

/* FALLING LETTERS */
.fall-letter{
    position:absolute;
    font-weight:900;
    color:rgba(255,0,0,0.18);
    text-shadow:0 0 12px rgba(255,0,0,0.2);
    animation: fall linear forwards;
}

@keyframes fall{
    from{ transform:translateY(-120px); }
    to{ transform:translateY(110vh); }
}

/* REGISTER BOX */
.center{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    position:relative;
    z-index:2;
}

.box{
    width:360px;
    background:rgba(0,0,0,0.85);
    padding:40px;
    border-radius:10px;
    box-shadow:0 0 40px rgba(255,0,0,0.6);
}

.box h1{
    color:#e50914;
    text-align:center;
    margin-bottom:25px;
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

.error{
    color:#ff4c4c;
    text-align:center;
}
</style>
</head>

<body>

<div id="bg">
    <div id="center-logo">MOVIEFLIX</div>
</div>

<div class="center">
<div class="box">
<h1>Register</h1>

<?php if($error) echo "<div class='error'>$error</div>"; ?>

<form method="post">
    <input name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Create Account</button>
</form>
</div>
</div>

<script>
const bg = document.getElementById("bg");
const text = "MOVIEFLIX";

function spawnLetter(){
    const l = document.createElement("div");
    l.className = "fall-letter";
    l.innerText = text[Math.floor(Math.random()*text.length)];

    const w = window.innerWidth;
    const centerL = w * 0.35;
    const centerR = w * 0.65;

    let x;
    do { x = Math.random() * w; }
    while (x > centerL && x < centerR);

    l.style.left = x + "px";
    l.style.top = "-100px";
    l.style.fontSize = (50 + Math.random()*40) + "px";
    l.style.animationDuration = (8 + Math.random()*6) + "s";

    bg.appendChild(l);
    setTimeout(()=>l.remove(),16000);
}

for(let i=0;i<30;i++) spawnLetter();
setInterval(spawnLetter,320);
</script>

</body>
</html>
