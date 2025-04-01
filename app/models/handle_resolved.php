<?php
include '../../config/database.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $status = 'Resolved';
  $sql = "UPDATE requests SET status = '$status' WHERE id = '$id'";
  if (mysqli_query($db, $sql)) {
    header('Location: ../views/adminDashboard.php');
  }
}
