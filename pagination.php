<?php
    include "database/db_connect.php";

    $result = $conn->query("SELECT * FROM blogs LIMIT 0, 4");
