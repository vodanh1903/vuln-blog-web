<?php
if (isset($_COOKIE['session'])) {
    unset($_COOKIE['session']); 
    setcookie('session', '', -1, '/');
    header("Location: login.php");
    return true;
} else {
    return false;
}
?>