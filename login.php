<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – MovieFlix</title>
    <link rel="stylesheet" href="css/netflix_style.css">

    <style>
        /* Login Page Styles */
        .login-container {
            max-width: 400px;
            margin: 120px auto;
            background: rgba(0,0,0,0.75);
            padding: 40px;
            border-radius: 6px;
        }

        .login-container h2 {
            margin-bottom: 25px;
        }

        .login-container input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            background: #333;
            border: none;
            color: #fff;
            border-radius: 4px;
            font-size: 15px;
        }

        .login-container button {
            width: 100%;
            padding: 14px;
            background: #e50914;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-container button:hover {
            background: #f6121d;
        }

        .login-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #aaa;
        }

        .login-footer a {
            color: #fff;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>MovieFlix</h1>
</header>

<div class="login-container">
    <h2>Sign In</h2>

    <form method="post" action="#">
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Sign In</button>
    </form>

    <div class="login-footer">
        <p>New to MovieFlix? <a href="#">Sign up now</a></p>
    </div>
</div>

</body>
</html>
