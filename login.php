<?php
    require_once 'database/db_connect.php';

    session_start();

    $message = "";
    $data = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = $conn->query("SELECT username, password FROM userdata WHERE username ='$username' AND password ='$password'");

        if ($query->num_rows > 0) {
            $data = $query->fetch_assoc();
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            header("Location: index.php");
            $query->close();
        } else {
            $message = "Tài khoản hoặc mật khẩu không hợp lệ!";
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <title>Login</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1 class="logo-text"><span>Vuln</span>Blog</h1>
        </div>
    </header>

    <div class="auth-content">

        <form action="login.php" method="post">
            <h2 class="form-title">Login</h2>

            <div>
                <label>Username</label>
                <input type="text" name="username" class="text-input">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" class="text-input">
            </div>
            <div class="btn-logreg">
                <button type="submit" name="login-btn" class="btn btn-big">Login</button>
            </div>
        </form>

    </div>
</body>
</html>