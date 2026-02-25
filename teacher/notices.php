<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
header("Location: ../login.php");
exit();
}

$notice = mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Notice Board</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#0f2027;color:white;font-family:Segoe UI;}
.container{margin-top:40px;}
.notice{background:#111;padding:15px;border-radius:10px;margin-bottom:15px;}
</style>
</head>

<body>

<div class="container">
<h2>📢 Notice Board</h2>

<?php
while($n=mysqli_fetch_assoc($notice)){
echo "<div class='notice'>
<h5>".$n['title']."</h5>
<p>".$n['message']."</p>
<small>".$n['date']."</small>
</div>";
}
?>

<a href="dashboard.php" class="btn btn-warning">⬅ Back Dashboard</a>

</div>

</body>
</html>