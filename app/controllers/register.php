<?php
include '../../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "INSERT INTO users (name, email, password,role) VALUES ('$username','$email','$password','user')";

  if (mysqli_query($db, $sql)) {
    header('Location: ../views/login.html');
  }
}
