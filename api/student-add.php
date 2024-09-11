<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid Request');
    require 'authCheck.php';
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $marks = mysqli_real_escape_string($conn, $_POST['marks']);
    $user_id = $user->id;

    if (empty($name) || empty($subject) || empty($marks)) throw new Exception('Invalid Request Data');

    $alreadyExists = "select * from students where name='$name' and subject='$subject' and user_id=$user_id";

    $res = $conn->query($alreadyExists);
    if ($res->num_rows > 0) {

        $sql = "update students set marks='$marks' where name='$name' and subject='$subject' and user_id=$user_id";
    } else {
        $sql = "insert into students (name,subject,marks,user_id) values ('$name', '$subject', '$marks', $user_id)";
    }


    if ($conn->query($sql) == TRUE) {
        echo json_encode(["success" => true, 'message' => 'Success']);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
