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
$tid=$teacher['id'];

# ADD ASSIGNMENT
if(isset($_POST['add'])){

$subject=$_POST['subject'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$last_date=$_POST['last_date']; // deadline
$date=date("Y-m-d");

if($subject==""){
echo "<script>alert('Select subject first');</script>";
}else{

mysqli_query($conn,"INSERT INTO assignments
(subject_id,title,description,date,last_date,teacher_id)
VALUES('$subject','$title','$desc','$date','$last_date','$tid')");

echo "<script>alert('Assignment Uploaded Successfully');</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Assignment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:linear-gradient(135deg,#141e30,#243b55);color:white;font-family:Segoe UI;}
.box{background:#00000080;padding:20px;border-radius:15px;margin-top:25px;}
</style>
</head>

<body>
<div class="container">

<h2 class="mt-4">📝 Upload Subject Assignment</h2>

<div class="box">
<form method="post">

<label>Select Subject</label>
<select name="subject" class="form-control mb-3" required>
<option value="">Select Subject</option>

<?php
$s=mysqli_query($conn,"SELECT * FROM subjects WHERE teacher_id='$tid'");
while($sub=mysqli_fetch_assoc($s)){
echo "<option value='".$sub['id']."'>".$sub['subject_name']."</option>";
}
?>
</select>

<label>Title</label>
<input type="text" name="title" class="form-control mb-3" required>

<label>Description</label>
<textarea name="desc" class="form-control mb-3" required></textarea>

<label>Last Date</label>
<input type="date" name="last_date" class="form-control mb-3" required>

<button name="add" class="btn btn-success">Upload</button>
<a href="dashboard.php" class="btn btn-light">Back</a>

</form>
</div>

<div class="box">
<h4>My Assignments</h4>

<table class="table table-dark table-bordered">
<tr>
<th>ID</th>
<th>Subject</th>
<th>Title</th>
<th>Upload Date</th>
<th>Last Date</th>
</tr>

<?php
$q=mysqli_query($conn,"
SELECT assignments.*, subjects.subject_name 
FROM assignments 
JOIN subjects ON assignments.subject_id=subjects.id
WHERE assignments.teacher_id='$tid'
ORDER BY assignments.id DESC");

while($r=mysqli_fetch_assoc($q)){
?>

<tr>
<td><?php echo $r['id']; ?></td>
<td><?php echo $r['subject_name']; ?></td>
<td><?php echo $r['title']; ?></td>
<td><?php echo $r['date']; ?></td>
<td>
<?php 
echo $r['last_date']; 

if(strtotime($r['last_date']) < strtotime(date("Y-m-d"))){
echo " <span class='badge bg-danger'>Expired</span>";
}else{
echo " <span class='badge bg-success'>Active</span>";
}
?>
</td>
</tr>

<?php } ?>
</table>
</div>

</div>
</body>
</html>