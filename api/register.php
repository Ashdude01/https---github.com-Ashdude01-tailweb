<?php
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid Request');
    if (!isset($_POST['password']) || !isset($_POST['name']) || !isset($_POST['username'])) throw new Exception("All fields are required");

    require '../dbConn.php';
    require '../constant.php';

    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);


    $alreadyExist = $conn->query("select id from user where username ='$username';");

    if ($alreadyExist->num_rows > 0) throw new Exception('This username is already taken');

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "insert into user (name, username, password) values ('$name', '$username', '$hash')";
    $conn->query($sql);
    echo json_encode(["success" => true, "message" => "Registration Successful, You can Login now"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
