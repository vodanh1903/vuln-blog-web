<?php
    session_start();
    if ($_SESSION['is_admin']){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
        header("Location: profile.php");
    } else {
        echo 'You are not admin!';
    }
?>