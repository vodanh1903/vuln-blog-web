<?php
$url = '';
if(!empty($_POST['postApi'])){

    $url = $_POST['postApi'];
    if (str_contains((parse_url($url, PHP_URL_QUERY)), 'postId')){
        echo 42;
    } else {
        echo file_get_contents($url);
    } 
}

?>