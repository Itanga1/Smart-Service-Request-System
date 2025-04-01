<?php
include '../../config/database.php';
session_start();
$admin_id = $_SESSION['user_id'];
if (isset($_GET['id'])) {
  $request_id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $response = $_POST['response'];
  $sql = "INSERT INTO responses (request_id,admin_id,response_message) VALUES ('$request_id','$admin_id','$response')";
  if (mysqli_query($db, $sql)) {
    header('Location: ../views/adminDashboard.php');
  }
}
