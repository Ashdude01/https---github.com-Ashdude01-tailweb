<?php
require 'constant.php';
require('vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

try {
    require 'dbConn.php';
    if ((preg_match('/\blogin.php\b/', $_SERVER['PHP_SELF'])) || preg_match('/\bregister.php\b/', $_SERVER['PHP_SELF'])) {
        if (isset($_COOKIE['auth_token']))  header("Location: index.php");
    } else {
        if (!isset($_COOKIE['auth_token']) || empty($_COOKIE['auth_token'])) throw new Exception('Authentication Error');
        $token = $_COOKIE['auth_token'];
        $decoded = JWT::decode($token, new Key(secret_key, 'HS256'));
        $user = $decoded->user;
    }
} catch (Exception $e) {
    header("Location: login.php");
}
