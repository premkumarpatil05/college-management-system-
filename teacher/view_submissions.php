<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
    header("Location: ../login.php");
    exit();
}

$teacher = $_SESSION['teacher'];
$teacher_subject = $_SESSION['subject'];

$sql = "SELECT * FROM submissions 
        WHERE subject='$teacher_subject' 
        ORDER BY id DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Submissions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#0f2027;color:white;font-family:Segoe UI;}
.container{margin-top:40px;}
.table{background:#111;}
.btn-view{background:#28a745;border:none;}
.btn-download{background:#007bff;border:none;}
</style>
</head>

<body>

<div class="container">
<h2>📂 Student Assignment Submissions</h2>
<p>Subject: <b><?php echo $teacher_subject; ?></b></p>

<table class="table table-dark table-bordered mt-4 text-center align-middle">
<tr>
<th>Student</th>
<th>Subject</th>
<th>Assignment</th>
<th>Action</th>
<th>Date</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
echo "<tr>
<td>".$row['student_name']."</td>
<td>".$row['subject']."</td>
<td>".$row['assignment']."</td>
<td>

<a class='btn btn-view btn-sm me-2' target='_blank' 
href='../student/uploads/".$row['file_name']."'>
View
</a>

<a class='btn btn-download btn-sm' 
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