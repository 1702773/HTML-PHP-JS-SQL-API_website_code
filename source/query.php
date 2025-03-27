<?php
$link = mysqli_connect("10.5.0.6", "tank", "tanklee", "user_test");
mysqli_set_charset($link, "utf8mb4");
if (!$link) die("Connection failed.");

$sql = "SELECT * FROM user WHERE 1";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <title>User List</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f4f4f4;
      display: flex; justify-content: center; align-items: center;
      height: 100vh; margin: 0;
    }
    .container {
      background: #fff; padding: 25px; border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      max-width: 600px; width: 90%;
      text-align: center;
    }
    table {
      width: 100%; border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 10px; text-align: center;
    }
    th {
      background-color: #4CAF50; color: white;
    }
    a {
      display: block; margin-top: 15px; color: #333;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>User List</h2>
  <table>
    <tr>
      <th>Username</th>
      <th>Number</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= htmlspecialchars($row["name"]) ?></td>
      <td><?= htmlspecialchars($row["number"]) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <a href="index.html">Return to Home</a>
</div>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($link);
