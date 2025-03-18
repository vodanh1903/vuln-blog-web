<?php include "pagination.php" ?>
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

    <title>VulnBlog</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1 class="logo-text"><span>Vuln</span>Blog</h1>
        </div>
        <!-- <i class="fa fa-bars menu-toggle"></i> -->
        <ul class="nav">
            <li><a href="#" class="logout">Logout</a></li>
        </ul>
    </header>
    <div class="content clearfix">
        <div class="main-content">
            <h1 class="recent-post-title">Recent Posts</h1>

            <div class="post">
                <img src="images/hacker.jpg" alt="" class="post-image">
                <div class="post-preview">
                    <h1><a href="#">Hacker in Russia</a></h1>
                    <i class="far fa-user"> User</i>
                    &nbsp;
                    <i class="far fa-calendar"> Mar 18, 2025</i>
                    <p class="preview-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Odio excepturi exercitationem labore praesentium iste. 
                        Tempore laudantium nobis ea numquam repudiandae. 
                        Itaque aspernatur in, tempore fugit ab vitae dolor assumenda asperiores?
                    </p>
                    <a href="#" class="btn read-more">Read More</a>
                    <?php
                        while($row = $result->fetch_assoc()){
                           ?>
                                <p>
                                    <?php 
                                        echo $row["blog_name"];
                                        echo "User" . $row["date"];
                                    ?>
                                </p> 
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <div class="section search">
                <h2 class="section-title">Search</h2>
                <form action="#" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>

            <div class="section topics">
                <h2 class="section-title">Topics</h2>
                <ul>
                    <li><a href="#">Poems</a></li>
                    <li><a href="#">Quotes</a></li>
                    <li><a href="#">Fiction</a></li>
                    <li><a href="#">Biography</a></li>
                    <li><a href="#">Motivation</a></li>
                    <li><a href="#">Inspiration</a></li>
                    <li><a href="#">Life Lessons</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>