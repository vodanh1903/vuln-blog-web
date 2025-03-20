<?php
    require 'database/db_connect.php';

    $messagesuccess = "";
    $messageemail = "";
    $messageuser = "";
    
    if (isset($_POST['register-btn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $checkemail = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
        $checkemail->bind_param("s", $email);
        $checkemail->execute();
        $checkemail->store_result();

        $checkusername = $conn->prepare("SELECT username FROM userdata WHERE username = ?");
        $checkusername->bind_param("s", $username);
        $checkusername->execute();
        $checkusername->store_result();

        if ($checkemail->num_rows > 0 && $checkusername->num_rows > 0) {
            $messageuser = "Username đã tồn tại!";
            $messageemail = "Email đã tồn tại!";
            echo "<script>document.getElementById(\"username-error\").innerHTML = \"Username đã tồn tại!\"</script>";
            echo "<script>document.getElementById(\"email-error\").innerHTML = \"Email đã tồn tại!\"</script>";
        } elseif ($checkemail->num_rows > 0) {
            $messageemail = "Email đã tồn tại!";
        } elseif ($checkusername->num_rows > 0) {
            $messageuser = "Username đã tồn tại!";
        } else {
            $password = md5($password);
            $query = $conn->prepare("INSERT INTO userdata (username, email, password) VALUES (?, ?, ?)");
            $query->bind_param("sss", $username, $email, $password);
            
            if ($query->execute()) {
                $messagesuccess = "Tạo tài khoản thành công!";
            }

            $query->close();
        }
        
        $checkemail->close();
        $checkusername->close();
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

    <title>Register</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1 class="logo-text"><span>Vuln</span>Blog</h1>
        </div>
    </header>

    <div class="auth-content">

        <form action="register.php" method="post">
            <h2 class="form-title">Register</h2>

            <div>
                <label>Username</label>
                <input type="text" name="username" class="text-input">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" class="text-input">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" class="text-input">
            </div>
            <div>
                <button type="submit" name="register-btn" class="btn btn-big">Register</button>
            </div>
            <p>Or <a href="login.php">Sign In</a></p>
        </form>

    </div>
</body>
</html>