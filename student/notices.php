<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_id'])){
header("Location: ../login.php");
exit();
}

$student_subject = $_SESSION['subject']; // student subject

// ⭐ FINAL QUERY (admin + teacher dono notice show)
$notice = mysqli_query($conn,"
SELECT * FROM notices 
WHERE subject='$student_subject' 
OR subject='All'
OR subject=''
ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Notice Board</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#0f2027;color:white;font-family:Segoe UI;}
.container{margin-top:40px;}
.notice{background:#111;padding:18px;border-radius:12px;margin-bottom:15px;}
.notice h5{color:#00ffe7;}
.date{font-size:13px;color:#bbb;}
</style>
</head>

<body>

<div class="container">
<h2>📢 Notice Board (<?php echo $student_subject; ?>)</h2>

<?php
while($n=mysqli_fetch_assoc($notice)){
echo "<div class='notice'>
<h5>".$n['title']."</h5>
<p>".$n['message']."</p>
<div class='date'>
Subject: <b>".$n['subject']."</b><br>
By: <b>".$n['sender']."</b> | ".$n['date']."
</div>
</div>";
}
?>

<a href="dashboard.php" class="btn btn-warning mt-3">⬅ Back Dashboard</a>

</div>

</body>
</html>