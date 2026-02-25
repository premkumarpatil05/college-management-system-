<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
    header("Location: ../login.php");
    exit();
}

$email=$_SESSION['teacher'];

// teacher id
$t=mysqli_query($conn,"SELECT * FROM teachers WHERE email='$email'");
$teacher=mysqli_fetch_assoc($t);
$tid=$teacher['id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>My Subjects</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#141e30,#243b55);
font-family:Segoe UI;
color:white;
}
.box{
background:rgba(0,0,0,0.65);
padding:20px;
border-radius:15px;
margin-bottom:25px;
}
</style>
</head>

<body>

<div class="container mt-4">

<h2 class="mb-4">📚 My Subjects</h2>

<div class="box">
<div class="table-responsive">
<table class="table table-dark table-bordered">
<tr>
<th>ID</th>
<th>Subject</th>
<th>Code</th>
<th>Course</th>
</tr>

<?php
$q=mysqli_query($conn,"SELECT * FROM subjects WHERE teacher_id='$tid'");
while($r=mysqli_fetch_assoc($q)){
?>

<tr>
<td><?php echo $r['id']; ?></td>
<td><?php echo $r['subject_name']; ?></td>
<td><?php echo $r['subject_code']; ?></td>
<td><?php echo $r['course']; ?></td>
</tr>

<?php } ?>

</table>
</div>
</div>

<a href="dashboard.php" class="btn btn-light">← Back Dashboard</a>

</div>
</body>
</html>