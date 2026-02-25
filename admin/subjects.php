```php
<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

# ADD SUBJECT
if(isset($_POST['add'])){
$name=$_POST['subject'];
$code=$_POST['code'];
$course=$_POST['course'];
$teacher=$_POST['teacher'];

mysqli_query($conn,"INSERT INTO subjects(subject_name,subject_code,course,teacher_id)
VALUES('$name','$code','$course','$teacher')");
header("Location: subjects.php");
}

# DELETE
if(isset($_GET['delete'])){
$id=$_GET['delete'];
mysqli_query($conn,"DELETE FROM subjects WHERE id=$id");
header("Location: subjects.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Subject Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
font-family:Segoe UI;
color:white;
}
.box{
background:rgba(0,0,0,0.65);
padding:20px;
border-radius:15px;
margin-bottom:25px;
}
.form-control{
background:#ffffff15;
border:none;
color:white;
}
label{color:#00ffe7;font-size:13px;}
</style>
</head>

<body>
<div class="container mt-4">

<h2 class="mb-4">📚 Subject Management</h2>

<!-- ADD SUBJECT -->
<div class="box">
<form method="POST">
<div class="row">

<div class="col-md-3 col-12 mb-2">
<label>Subject Name</label>
<input type="text" name="subject" class="form-control" required>
</div>

<div class="col-md-2 col-12 mb-2">
<label>Code</label>
<input type="text" name="code" class="form-control" required>
</div>

<div class="col-md-3 col-12 mb-2">
<label>Course</label>
<input type="text" name="course" class="form-control" required>
</div>

<div class="col-md-3 col-12 mb-2">
<label>Assign Teacher</label>
<select name="teacher" class="form-control" required>
<option value="">Select</option>
<?php
$t=mysqli_query($conn,"SELECT * FROM teachers");
while($tt=mysqli_fetch_assoc($t)){
echo "<option value='".$tt['id']."'>".$tt['name']."</option>";
}
?>
</select>
</div>

<div class="col-md-1 col-12 mt-4">
<button name="add" class="btn btn-success w-100">Add</button>
</div>

</div>
</form>
</div>

<!-- LIST -->
<div class="box">
<div class="table-responsive">
<table class="table table-dark table-bordered">
<tr>
<th>ID</th>
<th>Subject</th>
<th>Code</th>
<th>Course</th>
<th>Teacher</th>
<th>Action</th>
</tr>

<?php
$q=mysqli_query($conn,"SELECT subjects.*, teachers.name as tname 
FROM subjects 
LEFT JOIN teachers ON subjects.teacher_id=teachers.id
ORDER BY id DESC");

while($r=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?php echo $r['id']; ?></td>
<td><?php echo $r['subject_name']; ?></td>
<td><?php echo $r['subject_code']; ?></td>
<td><?php echo $r['course']; ?></td>
<td><?php echo $r['tname']; ?></td>
<td>
<a href="subjects.php?delete=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>

<a href="dashboard.php" class="btn btn-light">← Back Dashboard</a>

</div>
</body>
</html>
```
