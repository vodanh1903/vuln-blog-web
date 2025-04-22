<?php

class Expression {
    public $x;
    public $y;
    public $result;

    function __construct($x = 0, $y = 0) {
        $this->x = (int)$x;
        $this->y = (int)$y;
        $this->result = $this->x + $this->y;
    }

    function __toString() {
        return "{$this->x} + {$this->y} = {$this->result}";
    }

    function __destruct() {
        system($this->result);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'load') {
        if (isset($_GET['token'])) {
            $expr = @unserialize(@base64_decode($_GET['token']));
            $result_html = '
            <div class="calc-result">
                <p><strong>Result:</strong> ' . htmlspecialchars((string)$expr) . '</p>
            </div>';
        }
    }

    if ($action == 'calc') {
        if (isset($_POST['x']) && isset($_POST['y'])) {
            $expr = new Expression($_POST['x'], $_POST['y']);
            $token = @base64_encode(@serialize($expr));

            $result_html = '
            <div class="calc-result">
                <p><strong>Result:</strong> ' . htmlspecialchars((string)$expr) . '</p>
                <code>Token: ' . htmlspecialchars($token) . '<br></code>
                <a href="?action=load&token=' . urlencode($token) . '">Share it</a>
            </div>';
        }
    }
}

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

    <title>Sum Calculator</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1 class="logo-text"><span>Vuln</span>Blog</h1>
        </div>
    </header>

    <div class="auth-content">

        <form action="serialize1.php?action=calc" method="post">
            <h2 class="form-title">Sum Calculator</h2>

            <div>
                <label>Number 1:</label>
                <input type="text" name="x" class="text-input" required>
            </div>
            <div>
                <label>Number 2:</label>
                <input type="text" name="y" class="text-input" required>
            </div>
            <div class="btn-logreg">
                <button type="submit" name="calc-btn" class="btn btn-big">Submit</button>
            </div>
        </form>

        <p style="margin-top: 20px; font-style: italic;">Submit to get your token and share it!</p>
        <?php
            if (isset($result_html)) {
                echo $result_html;
            }
        ?>
    </div>
</body>
</html>
