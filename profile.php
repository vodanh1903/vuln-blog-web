<?php 
    require_once 'get_username.php';
    try {
        if (isset($_POST['username'])){
            $new_username = $_POST['username'];
            $query_current = $conn->query("UPDATE userdata SET username='$new_username' WHERE id='$id'");
            header("Refresh:0");
        }
    }
    catch (Exception $e){}
    
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

    <title>Profile</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1 class="logo-text"><a href="index.php"><span>Vuln</span>Blog</a></h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $get_username['username']; ?>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <div class="auth-content">
        
            <h2 class="form-title">Profile</h2>
        <form action="upload.php" method="post" class="profile-form sm-box" enctype="multipart/form-data">
            <div class="avatar-input-group center">
            
                <input type="file" name="avatar" id="avatar-input" class="avatar-input" onchange="this.form.submit()" style="display:none;">
                <button type="button" name="avatar" class="change-avatar-btn" onclick="document.getElementById('avatar-input').click();" style="background-image: url(images/avatar.jpg);">
                    <span>Change</span>
                </button>
                <br>
                <label>Profile Image (Optional)</label>
            </div>
        </form>
        <form action="#" method="post" class="profile-form sm-box">
            <div>
                <label>Username:</label>
                <input type="text" name="username" class="text-input" value="<?php echo $get_username['username']; ?>">
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="email" class="text-input">
            </div>
            <div>
                <label>Bio:</label>
                <textarea type="email" name="email" class="text-input" rows="4"></textarea>
            </div>
            <div class="btn-logreg">
                <button type="submit" name="login-btn" class="btn btn-big">Save</button>
            </div>
        </form>   
    </div>
</body>
</html>