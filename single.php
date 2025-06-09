<?php 
    require_once 'get_username.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $comment = $_POST['message'];
        
        $query = $conn->query("INSERT INTO `comment`(`name`,`comment`) VALUES ('$name','$comment')");

    }

    $query = $conn->query("SELECT * FROM `comment`");
    $rows = $query->fetch_all(MYSQLI_ASSOC);
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

    <div class="page-wrapper">
        <div class="content clearfix">
            <div class="main-content single">
                <h1 class="post-title">Title of the Post</h1>

                <div class="post-content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ullam distinctio dolor consequatur odio. Facilis odit distinctio perspiciatis delectus voluptatem necessitatibus! Id fugit aut distinctio sunt, doloremque reiciendis hic? Velit.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos odio cupiditate laborum consectetur cum iusto nisi ea eaque ipsam aperiam blanditiis tenetur odit excepturi reiciendis explicabo perferendis, repudiandae vitae delectus.</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae illo consequatur, harum, earum quasi quod quae expedita excepturi error est repellat facere beatae temporibus numquam minima quibusdam fuga iste natus!</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam rem quidem magni reiciendis fuga! Explicabo eveniet impedit vel adipisci! Dolore voluptates repellendus minus inventore quam porro cum culpa rerum corporis.</p>
                </div>
                <button type="submit" name="" class="btn">Show likes</button>
            </div>            

            <div class="sidebar single">

                <div class="section popular">
                    <h2 class="section-title">Popular</h2>
                    <div class="post clearfix">
                        <img src="images/hacker.jpg" alt="">
                        <a href="" class="title">How to become the best Hacker!</a>
                    </div>
                    <div class="post clearfix">
                        <img src="images/hacker.jpg" alt="">
                        <a href="" class="title">How to become the best Hacker!</a>
                    </div>
                    <div class="post clearfix">
                        <img src="images/hacker.jpg" alt="">
                        <a href="" class="title">How to become the best Hacker!</a>
                    </div>
                    <div class="post clearfix">
                        <img src="images/hacker.jpg" alt="">
                        <a href="" class="title">How to become the best Hacker!</a>
                    </div>
                    <div class="post clearfix">
                        <img src="images/hacker.jpg" alt="">
                        <a href="" class="title">How to become the best Hacker!</a>
                    </div>
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
            <div class="main-content comment">
                <h1 class="comment">Comment</h1>
                <?php foreach($rows as $row){
                    echo '<img src="images/avatar.jpg" alt="" class="avatar">';
                    echo '<p class="comment-name">' . $row['name'] . '</p>';
                    echo '<p class="comment-p">' . $row['comment'] . '</p>';
                }
                ?>
                <h2>Leave a comment</h2>
                <form action="" method="post">
                    <div class="section-comment">
                        <label>Comment:</label>
                        <textarea type="text" name="message" class="text-input" rows="6"></textarea>
                    </div>
                    <div class="section-comment">
                        <label>Name:</label>
                        <input type="text" name="name" class="text-input">
                    </div>
                    <div class="btn-comment">
                        <button type="submit" name="comment" class="btn">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>