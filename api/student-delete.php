<?php
header('Content-Type: application/json');
try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid Request');
    require 'authCheck.php';
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    if (is_null($id) || $id === '') throw new Exception('Invalid ID');
    $sql = "DELETE FROM students WHERE id=$id";

    if ($conn->query($sql) == TRUE) {
        echo json_encode(["success" => true, 'message' => 'Success']);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
