<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_id'])){
header("Location: ../login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Assignments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#141e30;color:white;font-family:Segoe UI;}
.box{background:#00000080;padding:20px;border-radius:15px;margin-top:25px;}
</style>
</head>

<body>
<div class="container">

<h2 class="mt-4">📚 All Assignments</h2>

<div class="box">

<table class="table table-dark table-bordered">
<tr>
<th>Subject</th>
<th>Title</th>
<th>Description</th>
<th>Date</th>
</tr>

<?php
$q=mysqli_query($conn,"
SELECT assignments.*, subjects.subject_name 
FROM assignments 
JOIN subjects ON assignments.subject_id=subjects.id
ORDER BY id DESC");

while($r=mysqli_fetch_assoc($q)){
?>

<tr>
<td><?php echo $r['subject_name']; ?></td>
<td><?php echo $r['title']; ?></td>
<td><?php echo $r['description']; ?></td>
<td><?php echo $r['date']; ?></td>
</tr>

<?php } ?>
</table>

</div>
</div>
</body>
</html>