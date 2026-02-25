<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
header("Location: ../login.php");
exit();
}

$email=$_SESSION['teacher'];
$t=mysqli_query($conn,"SELECT * FROM teachers WHERE email='$email'");
$teacher=mysqli_fetch_assoc($t);
$subject=$teacher['subject'];

# SAVE
if(isset($_POST['save'])){
$student=$_POST['student'];
$status=$_POST['status'];
$date=date("Y-m-d");

mysqli_query($conn,"INSERT INTO attendance(student_name,subject,date,status)
VALUES('$student','$subject','$date','$status')");

echo "<script>alert('Attendance Saved')</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);color:white;font-family:Segoe UI;}
.box{background:#00000080;padding:20px;border-radius:15px;margin-top:30px;}
</style>
</head>

<body>
<div class="container">

<h2 class="mt-4">📊 Mark Attendance (<?php echo $subject; ?>)</h2>

<div class="box">
<form method="post">

<label>Student Name</label>
<input type="text" name="student" class="form-control mb-3" required>

<label>Status</label>
<select name="status" class="form-control mb-3">
<option value="Present">Present</option>
<option value="Absent">Absent</option>
</select>

<button name="save" class="btn btn-success">Save Attendance</button>
<a href="dashboard.php" class="btn btn-light">Back</a>

</form>
</div>

<hr>

<h4>Today's Attendance</h4>

<table class="table table-dark table-bordered">
<tr>
<th>Student</th>
<th>Subject</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php
$q=mysqli_query($conn,"SELECT * FROM attendance WHERE subject='$subject' ORDER BY id DESC");
while($r=mysqli_fetch_assoc($q)){
?>

<tr>
<td><?php echo $r['student_name']; ?></td>
<td><?php echo $r['subject']; ?></td>
<td><?php echo $r['date']; ?></td>
<td><?php echo $r['status']; ?></td>
</tr>

<?php } ?>
</table>

</div>
</body>
</html>