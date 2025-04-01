<?php
session_start();
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $tile = $_POST['title'];
  $category = $_POST['category'];
  $description = $_POST['description'];
  $use_id = $_SESSION['user_id'];
  $status = 'pending';

  $sql = "INSERT INTO requests (user_id, title, description, category,status) VALUES ('$use_id','$tile','$description','$category','$status')";
  if (mysqli_query($db, $sql)) {
    header('Location: ../views/userDashboard.php');
  } else {
    echo "Request submisssion failed";
  }
}
