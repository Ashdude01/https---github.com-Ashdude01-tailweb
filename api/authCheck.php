<?php
require('../vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../dbConn.php';
require '../constant.php';
if (!isset($_COOKIE['auth_token']) || empty($_COOKIE['auth_token'])) throw new Exception('Authentication Error');
$token = $_COOKIE['auth_token'];
$decoded = JWT::decode($token, new Key(secret_key, 'HS256'));
$user = $decoded->user;
if (!isset($user) || !isset($user->id) || !isset($user->username)) throw new Exception('Authentication Error');
