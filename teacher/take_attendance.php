<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
header("Location: ../login.php");
exit();
}

$email=$_SESSION['teacher'];

# Teacher subject
$t=mysqli_query($conn,"SELECT * FROM teachers WHERE email='$email'");
$teacher=mysqli_fetch_assoc($t);
$subject=$teacher['subject'];

if(empty($subject)){
echo "<div style='color:red;padding:20px;'>Subject not assigned by admin.</div>";
exit();
}

# SAVE
if(isset($_POST['save'])){
$date=$_POST['date'];

foreach($_POST['status'] as $name=>$status){
mysqli_query($conn,"INSERT INTO attendance(student_name,subject,date,status)
VALUES('$name','$subject','$date','$status')");
}
echo "<script>alert('Attendance Saved')</script>";
}

# DELETE
if(isset($_GET['delete'])){
$id=$_GET['delete'];
mysqli_query($conn,"DELETE FROM attendance WHERE id=$id");
header("Location: take_attendance.php");
}

# UPDATE
if(isset($_POST['update'])){
$id=$_POST['id'];
$status=$_POST['status'];

mysqli_query($conn,"UPDATE attendance SET status='$status' WHERE id=$id");
echo "<script>alert('Updated')</script>";
}

# DATE FILTER
$filter_date="";
if(isset($_GET['filter_date'])){
$filter_date=$_GET['filter_date'];
}

# PERCENTAGE
$total=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM attendance WHERE subject='$subject'"))['t'];
$present=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as p FROM attendance WHERE subject='$subject' AND status='Present'"))['p'];

$percent=0;
if($total>0){ $percent=round(($present/$total)*100); }
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f2f2f2;font-family:Segoe UI;}
.box{background:white;padding:20px;margin-top:25px;border-radius:10px;}
</style>
</head>

<body>
<div class="container">

<div class="box">
<h3>Take Attendance (<?php echo $subject; ?>)</h3>

<form method="post">
<label>Date</label>
<input type="date" name="date" class="form-control mb-3" required>

<table class="table table-bordered">
<tr>
<th>Name</th><th>Present</th><th>Absent</th>
</tr>

<?php
$s=mysqli_query($conn,"SELECT * FROM students");
while($stu=mysqli_fetch_assoc($s)){
$name=$stu['name'];
?>
<tr>
<td><?php echo $name; ?></td>
<td><input type="radio" name="status[<?php echo $name;?>]" value="Present" required></td>
<td><input type="radio" name="status[<?php echo $name;?>]" value="Absent" required></td>
</tr>
<?php } ?>
</table>

<button name="save" class="btn btn-primary">Save Attendance</button>
</form>
</div>

<!-- PERCENTAGE -->
<div class="box">
<h4>Overall Attendance: <?php echo $percent; ?>%</h4>
</div>

<!-- FILTER -->
<div class="box">
<form method="get" class="row">
<div class="col-md-4">
<input type="date" name="filter_date" class="form-control" value="<?php echo $filter_date;?>">
</div>
<div class="col-md-2">
<button class="btn btn-success">Filter</button>
</div>
<div class="col-md-2">
<a href="take_attendance.php" class="btn btn-dark">Reset</a>
</div>
</form>
</div>

<!-- LIST -->
<div class="box">
<h4>Attendance Records</h4>

<table class="table table-bordered">
<tr>
<th>Student</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
if(!empty($filter_date)){
$q=mysqli_query($conn,"SELECT * FROM attendance WHERE subject='$subject' AND date='$filter_date' ORDER BY id DESC");
}else{
$q=mysqli_query($conn,"SELECT * FROM attendance WHERE subject='$subject' ORDER BY id DESC");
}

while($r=mysqli_fetch_assoc($q)){
?>

<tr>
<td><?php echo $r['student_name']; ?></td>
<td><?php echo $r['date']; ?></td>
<td>
<form method="post" class="d-flex">
<input type="hidden" name="id" value="<?php echo $r['id']; ?>">
<select name="status" class="form-control">
<option <?php if($r['status']=="Present") echo "selected";?>>Present</option>
<option <?php if($r['status']=="Absent") echo "selected";?>>Absent</option>
</select>
<button name="update" class="btn btn-warning btn-sm ms-1">Update</button>
</form>
</td>

<td>
<a href="?delete=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
</td>

</tr>

<?php } ?>
</table>

</div>

</div>
</body>
</html>