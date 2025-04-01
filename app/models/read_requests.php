<?php
include '../../config/database.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM requests WHERE status = 'pending'";
$result = mysqli_query($db, $sql);
