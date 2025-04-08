<?php 
    require_once 'get_username.php';

    $query = $conn->prepare("SELECT * FROM blogs ORDER BY name");
    $query->execute();
    $resultSet = $query->get_result();
    $users = $resultSet->fetch_all(MYSQLI_ASSOC);

    $total_results = $resultSet->num_rows;
    $results_per_page = 2;
    $number_of_pages = ceil($total_results/$results_per_page);

    if(!isset($_GET['page'])){
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $offset = ($page-1)*$results_per_page;

    $sql = "SELECT * FROM blogs WHERE public=TRUE ORDER BY name LIMIT $offset, $results_per_page";

    $query_current = $conn->prepare($sql);
    $query_current->execute();
    $resultSet = $query_current->get_result();
    $rows = $resultSet->fetch_all(MYSQLI_ASSOC);
    
    try {
        if (isset($_POST['search'])){
            $searchq = $_POST['search'];
            $query_current = $conn->query("SELECT * FROM blogs WHERE name LIKE '%$searchq%' OR content LIKE '%$searchq%' AND public=TRUE ORDER BY name LIMIT $offset, $results_per_page");
            $rows = $query_current->fetch_all(MYSQLI_ASSOC);
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

    <title>VulnBlog</title>
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
    <div class="content clearfix">
        <div class="main-content">
            <h1 class="recent-post-title">Recent Posts</h1>
            
            <?php foreach($rows as $row){ 
                    echo    '<div class="post">';
                    echo        '<img src="images/'.$row['images'].'.jpg" alt="" class="post-image">';
                    echo        '<div class="post-preview">';
                    echo            '<h1><a href="#">'.$row['name'].'</a></h1>';
                    echo            '<i class="far fa-user"> User</i>';
                    echo            '&nbsp;';
                    echo            '<i class="far fa-calendar"> Mar 18, 2025</i>';
                    echo            '<p class="preview-text">';
                    echo                $row['content'];
                    echo            '</p>';
                    echo            '<a href="#" class="btn read-more">Read More</a>';
                    echo        '</div>';
                    echo    '</div>';
                }
                echo    '<div class="pagination">';
                            for($page=1; $page<=$number_of_pages; $page++){
                                echo '<a class="page-numbers" href="index.php?page='.$page.'" style="padding: 5px 15px; border: 1px solid black; margin-right: 5px;">'.$page.'</a>';
                            }
                echo    '</div>';
            ?> 
            
        </div>
        
        <div class="sidebar">
            <div class="section search">
                <h2 class="section-title">Search</h2>
                <form action="" method="post">
                    <input type="text" name="search" class="text-input" placeholder="Search...">
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