<?php
include '../../config/database.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM requests WHERE id = '$id'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $tile = $_POST['title'];
  $category = $_POST['category'];
  $description = $_POST['description'];

  $sql = "UPDATE requests SET title='$tile', description='$description', category='$category' WHERE id = '$id'";
  if (mysqli_query($db, $sql)) {
    header('Location: ../views/userDashboard.php');
  } else {
    echo "Request Update failed";
  }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../public/assets/css/styles.css">
  <title>Document</title>
</head>

<body>
  <div class="formContainer">
    <form action="" method="POST">
      <label>Title</label>
      <input value="<?php echo "{$row['title']}" ?>" type="text" placeholder="Enter the title" name="title" required>
      <label>Category</label>
      <select name="category" required>
        <option value="">Select Service Category</option>
        <option value="it support">IT Support</option>
        <option value="maintenance">Maintenance</option>
        <option value="admin tasks">Admin Tasks</option>
      </select>
      <label>Description</label>
      <textarea name="description" placeholder="Describe the requested Service " required><?php echo "{$row['description']}" ?></textarea>
      <button type="submit">Apply Changes</button>
    </form>
  </div>
</body>

</html>