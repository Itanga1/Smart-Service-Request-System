<?php
include '../../config/database.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM requests WHERE id = '$id'";
  if (mysqli_query($db, $sql)) {
    header('Location: ../views/userDashboard.php');
  }
}
