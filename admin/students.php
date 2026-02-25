```php
<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

// ADD STUDENT
if(isset($_POST['add_student'])){
$student_id=$_POST['student_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$course=$_POST['course'];
$password=$_POST['password'];

mysqli_query($conn,"INSERT INTO students(student_id,name,email,mobile,course,password)
VALUES('$student_id','$name','$email','$mobile','$course','$password')");
header("Location: students.php");
}

// DELETE
if(isset($_GET['delete'])){
$id=$_GET['delete'];
mysqli_query($conn,"DELETE FROM students WHERE id=$id");
header("Location: students.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
font-family:Segoe UI;
color:white;
}

/* BOX */
.box{
background:rgba(0,0,0,0.6);
padding:20px;
border-radius:15px;
margin-bottom:25px;
}

/* INPUT */
.form-control{
background:#ffffff15;
border:none;
color:white;
height:45px;
}

label{
font-size:13px;
color:#00ffe7;
}

/* MOBILE */
@media(max-width:768px){
.box{padding:15px;}
}
</style>
</head>

<body>
<div class="container mt-4">

<h2 class="mb-4">🎓 Student Management</h2>

<!-- ADD STUDENT MOBILE PERFECT -->
<div class="box">
<h5>Add Student</h5>

<form method="POST">
<div class="row">

<div class="col-md-4 col-12 mb-2">
<label>Student ID</label>
<input type="text" name="student_id" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Course</label>
<input type="text" name="course" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Password</label>
<input type="text" name="password" class="form-control" required>
</div>

<div class="col-12 mt-3">
<button name="add_student" class="btn btn-success w-100">Add Student</button>
</div>

</div>
</form>
</div>

<!-- SEARCH -->
<div class="box">
<form method="GET">
<input type="text" name="search" class="form-control" placeholder="🔍 Search by name or student id">
</form>
</div>

<!-- STUDENT LIST -->
<div class="box">
<div class="table-responsive">
<table class="table table-dark table-bordered">
<tr>
<th>ID</th>
<th>Student ID</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Course</th>
<th>Password</th>
<th>Action</th>
</tr>

<?php
$search="";
if(isset($_GET['search'])){
$search=$_GET['search'];
$query="SELECT * FROM students WHERE name LIKE '%$search%' OR student_id LIKE '%$search%' ORDER BY id DESC";
}else{
$query="SELECT * FROM students ORDER BY id DESC";
}

$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['mobile']; ?></td>
<td><?php echo $row['course']; ?></td>
<td><?php echo $row['password']; ?></td>
<td>
<a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
<a href="students.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
