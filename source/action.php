<?php
$link = mysqli_connect("10.5.0.6", "tank", "tanklee", "user_test");
mysqli_set_charset($link, "utf8mb4");

if (!$link) {
    die("connection failed");
}else{
	echo "123123123123";
}

$action = $_POST["action"];
$name = $_POST["name"];
$number = $_POST["number"];  
echo $action;
echo $name;
echo $number;
#exit();
$stmt = null;
switch ($action) {
    case 'create':
        $sql = "INSERT INTO user (name, number) VALUES (?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "si", $name, $number);
        $msg = mysqli_stmt_execute($stmt) ? "create OK" : "create failed";
        break;

    case 'delete':
        $sql = "DELETE FROM user WHERE name = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $name);
        $msg = mysqli_stmt_execute($stmt) ? "delete OK" : "delete failed";
        break;

    case 'change':
        $sql = "UPDATE user SET number = ? WHERE name = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $number, $name);
        $msg = mysqli_stmt_execute($stmt) ? "update OK" : "update failed";
        break;

    default:
        $msg = "undefined action";
}

// 確認$stmt有被正確建立再關閉
if ($stmt) {
    mysqli_stmt_close($stmt);
}
mysqli_close($link);

echo "<h3>{$msg}</h3>";
echo "<a href='index.html'>return index.html</a>";
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>Result</title>
  <style>
    body{ font-family:Arial; background-color:#f4f4f4; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .container{ background:#fff; padding:30px; border-radius:12px; box-shadow:0 4px 8px rgba(0,0,0,0.2); width:300px; text-align:center; }
    a{display:block;margin-top:15px;color:#333;}
  </style>
</head>
<body>
<div class="container">
  <h3><?=htmlspecialchars($msg)?></h3>
  <a href='index.html'>Return Home</a>
</div>
</body>
</html>