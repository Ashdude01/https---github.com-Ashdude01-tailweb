<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid Request');
    require 'authCheck.php';
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $marks = mysqli_real_escape_string($conn, $_POST['marks']);
    $user_id = $user->id;


    if (empty($name) || empty($subject) || empty($marks)) throw new Exception('All fields required');

    $sql = "update students set name='$name', subject='$subject', marks='$marks' where id=$id and user_id=$user_id";

    if ($conn->query($sql) == TRUE) {
        echo json_encode(["success" => true, 'message' => 'Success']);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
