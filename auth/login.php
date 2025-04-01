<?php
session_start();
include '../config/database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = '$email' AND password= '$password'";
  $result = mysqli_query($db, $sql);
  $user = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $user['name'];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];
    if ($user['role'] == 'user') {
      header('location: ../app/views/userDashboard.php');
    } else if ($user['role'] == 'admin') {
      header('location: ../app/views/adminDashboard.php');
    }
  } else {
    header('location: ../app/views/login.html?error=Invalid username/password');
  }
}
