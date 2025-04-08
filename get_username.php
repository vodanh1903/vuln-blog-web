<?php 
    require_once 'database/db_connect.php';

    session_start();

    if (empty($_SESSION['id'])) {
        header("Location: login.php");
    }

    $id = $_SESSION['id'];
    $query = $conn->query("SELECT username FROM userdata WHERE id ='$id'");
    $get_username = $query->fetch_assoc();
?>