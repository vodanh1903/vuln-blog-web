<?php
    include "database/db_connect.php";

    $start = 0;
    $rows_per_page = 4; 
    $result = $conn->query("SELECT * FROM blogs LIMIT 0, 4");
