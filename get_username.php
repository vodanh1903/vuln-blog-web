<?php 
    require_once 'database/db_connect.php';
    require __DIR__ . '/vendor/autoload.php';
    require_once 'test_jwt.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    if (empty($_COOKIE['session'])){
        header("Location: login.php");
        die();
    }

    $jwt = $_COOKIE['session'];
    list($headersB64, $payloadB64, $sig) = explode('.', $jwt);

    // $payloads = json_decode(base64_decode($payloadB64), true);
    // $username = $payloads['sub'];

    $headers = json_decode(base64_decode($headersB64), true);
    if ($headers['alg'] == 'none') {
        $payloads = json_decode(base64_decode($payloadB64), true);
        $username = $payloads['sub'];
    } else {
        try {
        $decoded = JWT::decode($jwt, new Key($publicKey, 'RS256'));
        $decoded_array = (array) $decoded;
        $username = $decoded_array['sub'];
        } catch (Exception $e) {}
    }
    
    
    $query = $conn->query("SELECT username FROM userdata WHERE username ='$username'");
    if ($query->num_rows > 0) {
        $get_username = $query->fetch_assoc();
    } else {
        header("Location: login.php");
        die();
    }
?>