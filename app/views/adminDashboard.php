<?php
session_start();
if (isset($_SESSION['username'])) {
  if ($_SESSION['user_role'] != 'admin') {
    header('Location: userDashboard.php');
    exit;
  }
} else {
  header('Location: login.html');
  exit;
}
include '../models/read_requests.php';
include '../../config/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../public/assets/css/styles.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <title>Document</title>
</head>

<body>
  <a href="../../auth/logout.php">Logout ➜</a>
  <h1 class="title">Admin Dashboard</h1>
  <form class="filterContainer" style="display: flex; justify-content: center; align-items: center; gap: 10px; padding: 60px 0px 40px 0px;">
    <span style="font-weight: bold; font-size: large">Filter by category: </span>
    <select name="" id="">
      <option value="maintenance">Maintenance</option>
      <option value="it support">IT Support</option>
      <option value="admin tasks">Admin Tasks</option>
    </select>
    <button id="filterButton" style="background-color: dodgerblue; color:white; font-weight: bold; padding: 10px 20px; border: none; border-radius: 20px; font-size: medium; cursor: pointer">Filter</button>
  </form>
  <button onclick="downloadPDF()" style="background-color: darkred;color:white;width: fit-content;font-weight: bold; align-self: flex-end; margin-right: 20%; padding: 10px 20px; border: none; font-size: medium; cursor: pointer">Donwload pdf</button>
  <div style="display: <?php if (mysqli_num_rows($result) > 0) {
                          echo "block";
                        } else {
                          echo "none";
                        } ?>" class="requestsContainer" id="content">
    <h2 style="text-align: center; margin: 0;">Pending Requests</h2>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {

      echo "<div class=\"request\">";
      echo "<h3>Title: {$row['title']}</h3>";
      echo "<h6>{$row['created_at']}</h6>";
      echo "<p>{$row['description']}</p>";
      echo "<h3>Response:</h3>";
      $id = $row['id'];
      $sql1 = "SELECT * FROM responses WHERE request_id = '$id'";
      $result1 = mysqli_query($db, $sql1);
      if (mysqli_num_rows($result1) == 0) {
        echo "<form action=\"../models/add_response.php?id={$row['id']}\" method=\"POST\">
      <input name=\"response\" class=\"responseInput\" type=\"text\" placeholder=\"Type Response\" required>
      <button class=\"responseButton\" type=\"submit\">Submit</button>
      </form>";
      } else {
        $row1 = mysqli_fetch_assoc($result1);
        echo "<h6>{$row1['response_date']}</h6>";
        echo "<p>{$row1['response_message']}</p>";
      }

      echo "<div class=\"buttonContainer\">
          <a href=\"../models/handle_resolved.php?id={$row['id']}\" style=\"background-color: dodgerblue\">Resolved</a>
        </div>";
      echo "<span class=\"status\">{$row['status']}</span>";
      echo "</div>";
    }
    ?>
  </div>
  <script>
    function downloadPDF() {
      const {
        jsPDF
      } = window.jspdf;
      let doc = new jsPDF();

      html2canvas(document.getElementById("content")).then(canvas => {
        let imgData = canvas.toDataURL("image/png");
        let imgWidth = 190; // Adjust width to fit PDF
        let imgHeight = (canvas.height * imgWidth) / canvas.width; // Keep aspect ratio

        doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
        doc.save("document.pdf");
      });
    }
  </script>
</body>

</html>