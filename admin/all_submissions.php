<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM submissions ORDER BY id DESC";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>All Submissions - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#0f2027;color:white;font-family:Segoe UI;}
.container{margin-top:40px;}
.table{background:#111;}
</style>
</head>

<body>

<div class="container">
<h2>📂 All Student Assignment Submissions</h2>

<table class="table table-dark table-bordered text-center align-middle mt-4">
<tr>
<th>ID</th>
<th>Student</th>
<th>Subject</th>
<th>Assignment</th>
<th>View</th>
<th>Download</th>
<th>Date</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
echo "<tr>
<td>".$row['id']."</td>
<td>".$row['student_name']."</td>
<td>".$row['subject']."</td>
<td>".$row['assignment']."</td>

<td>
<a class='btn btn-success btn-sm' target='_blank'
href='../student/uploads/".$row['file_name']."'>View</a>
</td>

<td>
<a class='btn btn-info btn-sm'
href='../student/uploads/".$row['file_name']."' download>
Download
</a>
</td>

<td>".$row['submission_date']."</td>
</tr>";
}
?>

</table>

<a href='dashboard.php' class="btn btn-warning">⬅ Back Dashboard</a>

</div>

</body>
</html>