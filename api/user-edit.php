<?php
header('Content-Type: application/json');
require('../vendor/autoload.php');

use Firebase\JWT\JWT;
try {
    require 'authCheck.php';
    if ($_SERVER['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid Request');
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rawPassword = mysqli_real_escape_string($conn, $_POST['password']);
    // if (strlen($rawPassword < 3)) throw new Exception('Choose a Strong Password');

    // Validating if the requested data belongs to logged in user
    $res = $conn->query("SELECT * FROM user WHERE id = $user->id");
    if ($res->num_rows != 1) throw new Exception('Invalid Request Data');
    $actual_user = $res->fetch_assoc();
    if ($user->username != $actual_user['username']) throw new Exception('You are not allowed');

    if (empty($rawPassword) || $rawPassword == ' ') {
        $sql = "update user set name='$name' where id = $user->id";
    } else {
        // hashingh password 
        $password = password_hash($rawPassword, PASSWORD_BCRYPT);

        $sql = "update user set name='$name', password='$password' where id = $user->id";
    }
    if ($conn->query($sql) == TRUE) {
        $decoded->user->name = $name;
        $decoded->user->username = $user->username;
        $decoded->user->id = $user->id;

        $user_updated  = json_decode(json_encode($decoded), true);
        $token = JWT::encode($user_updated, secret_key, 'HS256');
        $cookie_options = array(
            'expires' => $decoded->exp,
            'path' => '/',
            'domain' => '', // leading dot for compatibility or use subdomain
            'secure' => true,     // or false
            'httponly' => true,    // or false
            'samesite' => 'None' // None || Lax  || Strict
        );
        setcookie('auth_token', $token, $cookie_options);
        echo json_encode(["success" => true, 'message' => 'Success']);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
