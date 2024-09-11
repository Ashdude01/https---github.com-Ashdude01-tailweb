<?php
if (!isset($_COOKIE['auth_token'])) {
    header("Location:login.php");
} else {
    setcookie('auth_token', "", time() - 3600, "/");
    header('Location: login.php');
}
