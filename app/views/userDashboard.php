<?php
session_start();
if (isset($_SESSION['username'])) {
  if ($_SESSION['user_role'] != 'user') {
    header('Location: adminDashboard.php');
    exit;
  }
} else {
  header('Location: login.html');
  exit;
}
include '../models/read_user_requests.php';
include '../../config/database.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM requests WHERE user_id = '$user_id'";
$result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../public/assets/css/styles.css">
  <title>Document</title>
</head>

<body>
  <!-- <div class="formContainer" id="updateRequest">
    <form onsubmit="hideUpdateRequest()" action="../models/updateUserRequest.php" method="POST">
      <label>Title</label>
      <input type="text" placeholder="Enter the title" name="title" required>
      <label>Category</label>
      <select name="category" required>
        <option value="">Select Service Category</option>
        <option value="it support">IT Support</option>
        <option value="maintenance">Maintenance</option>
        <option value="admin tasks">Admin Tasks</option>
      </select>
      <label>Description</label>
      <textarea name="description" placeholder="Describe the requested Service" required></textarea>
      <button type="submit">Apply Changes</button>
    </form>
  </div> -->
  <a href="../../auth/logout.php">Logout ➜</a>
  <h1 class="title">Service Request</h1>
  <form action="../models/create_request.php" method="POST" id="serviceRequestForm">
    <label>Title</label>
    <input type="text" placeholder="Enter the title" name="title" required>
    <label>Category</label>
    <select name="category" required>
      <option value="">Select Service Category</option>
      <option value="it support">IT Support</option>
      <option value="maintenance">Maintenance</option>
      <option value="admin tasks">Admin Tasks</option>
    </select>
    <label>Description</label>
    <textarea name="description" placeholder="Describe the requested Service" required></textarea>
    <button type="submit">Submit</button>
  </form>
  <div style="display: <?php if (mysqli_num_rows($result) > 0) {
                          echo "block";
                        } else {
                          echo "none";
                        } ?>" class="requestsContainer">
    <h2 style="text-align: center; margin: 0;">Requests</h2>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class=\"request\">";
      echo "<h3>Category: {$row['category']}</h3>";
      echo "<h3>Title: {$row['title']}</h3>";
      echo "<h6>{$row['created_at']}</h6>";
      echo "<p>{$row['description']}</p>";
      echo "<h3>Response:</h3>";
      $id = $row['id'];
      $sql1 = "SELECT * FROM responses WHERE request_id = '$id'";
      $result1 = mysqli_query($db, $sql1);
      if (mysqli_num_rows($result1) > 0) {
        $row1 = mysqli_fetch_assoc($result1);
        echo "<h6>{$row1['response_date']}</h6>";
        echo "<p>{$row1['response_message']}</p>";
      }

      echo "<div class=\"buttonContainer\">";
      /* if (mysqli_num_rows($result1) == 0) { */
      echo "<a href=\"../models/update_request.php?id={$row['id']}\">Update</a>";
      /* } */
      echo "<a href=\"../models/delete_request.php?id={$row['id']}\">Delete</a>";
      echo "</div>";
      echo "<span class=\"status\">{$row['status']}</span>";
      echo "</div>";
    }
    ?>
  </div>
  <script src="../../public/assets/js/script.js"></script>
</body>

</html>