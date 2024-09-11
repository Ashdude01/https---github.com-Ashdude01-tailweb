<?php
header('Content-Type: application/json');
require('../vendor/autoload.php');

use Firebase\JWT\JWT;

try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid Request');
    if (!isset($_POST['username']) || !isset($_POST['password'])) throw new Exception("Invalid Username or Password");
    require '../dbConn.php';
    require '../constant.php';
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $admin = $conn->query("select * from user where username = '$username'");
    if ($admin->num_rows < 1) throw new Exception('Username Not Found');
    $data = $admin->fetch_assoc();
    $passVerify = password_verify($password, $data['password']);
    if ($passVerify) {
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+24 hours')->getTimestamp();      // Add 24 hours                                        // Retrieved from filtered POST data
        $payload = [
            'iat'  => $date->getTimestamp(),
            'nbg' => $date->getTimestamp(),         // Issued at: time when the token was generated
            'exp'  => $expire_at,                           // Expire
            'user' => $data,                     // User name
        ];

        $token = JWT::encode($payload, secret_key, 'HS256');
        $cookie_options = array(
            'expires' => $expire_at,
            'path' => '/',
            'domain' => '', // leading dot for compatibility or use subdomain
            'secure' => true,     // or false
            'httponly' => true,    // or false
            'samesite' => 'None' // None || Lax  || Strict
        );
        setcookie('auth_token', $token, $cookie_options);
        echo json_encode(['success' => true, 'message' => 'Login Successful']);
    } else {
        throw new Exception('Incorrect Email or Password');
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
