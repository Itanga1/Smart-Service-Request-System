<?php
include '../../config/database.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM requests WHERE user_id = '$user_id'";
$result = mysqli_query($db, $sql);
