<?php
$conn = new mysqli("localhost", "root", "", "tailweb");
// $conn = new mysqli("103.21.58.4:3306", "spacex_db_user", "Vqpu194!8", "spacex");
// Check connection
if ($conn->connect_errno) {
  throw new Exception("Failed to connect to Database: " . $conn->connect_error);
  die();
  exit();
}