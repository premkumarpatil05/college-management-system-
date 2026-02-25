<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_id'])){
header("Location: ../login.php");
exit();
}

$name=$_SESSION['student_name'];

# TOTAL
$total=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as t FROM attendance WHERE student_name='$name'"))['t'];

# PRESENT
$present=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as p FROM attendance WHERE student_name='$name' AND status='Present'"))['p'];

$percent=0;
if($total>0){ $percent=round(($present/$total)*100); }

# SUBJECT FILTER
$filter_subject="";
if(isset($_GET['subject'])){
$filter_subject=$_GET['subject'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Attendance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#141e30,#243b55);
color:white;
font-family:Segoe UI;
}
.box{
background:#00000080;
padding:20px;
border-radius:15px;
margin-top:25px;
}
.badge-big{
font-size:20px;
padding:10px 20px;
}
</style>
</head>

<body>

<div class="container">

<h2 class="mt-4">📊 My Attendance</h2>

<!-- PERCENTAGE -->
<div class="box text-center">
<h4>Overall Attendance</h4>
<span class="badge bg-success badge-big">
<?php echo $percent; ?>%
</span>
</div>

<!-- FILTER -->
<div class="box">
<form method="get" class="row g-2">
<div class="col-md-4">
<input type="text" name="subject" class="form-control" 
placeholder="Enter Subject Name"
value="<?php echo $filter_subject; ?>">
</div>
<div class="col-md-2">
<button class="btn btn-info">Filter</button>
</div>
<div class="col-md-2">
<a href="attendance.php" class="btn btn-dark">Reset</a>
</div>
</form>
</div>

<!-- ATTENDANCE LIST -->
<div class="box">

<table class="table table-dark table-bordered">
<tr>
<th>Subject</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php

if(!empty($filter_subject)){
$q=mysqli_query($conn,
"SELECT * FROM attendance 
WHERE student_name='$name' 
AND subject LIKE '%$filter_subject%' 
ORDER BY id DESC");
}else{
$q=mysqli_query($conn,
"SELECT * FROM attendance 
WHERE student_name='$name'
ORDER BY id DESC");
}

while($r=mysqli_fetch_assoc($q)){
?>

<tr>
<td><?php echo $r['subject']; ?></td>
<td><?php echo $r['date']; ?></td>
<td>
<?php
if($r['status']=="Present"){
echo "<span class='badge bg-success'>Present</span>";
}else{
echo "<span class='badge bg-danger'>Absent</span>";
}
?>
</td>
</tr>

<?php } ?>

</table>

</div>

<a href="dashboard.php" class="btn btn-light mt-3">← Back Dashboard</a>

</div>
</body>
</html>