<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ssrs';

$db = mysqli_connect($host, $user, $password, $database);
if ($db) {
} else {
  echo "Connection failed";
}
