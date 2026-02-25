```php
<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

// ADD
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
.box{
background:rgba(0,0,0,0.6);
padding:20px;
border-radius:15px;
margin-bottom:25px;
}
</style>
</head>

<body>
<div class="container mt-4">

<h2 class="mb-4">🎓 Student Management</h2>

<!-- ADD STUDENT -->
<div class="box">
<form method="POST" class="row">
<div class="col-md-2 col-12"><input type="text" name="student_id" class="form-control" placeholder="Student ID" required></div>
<div class="col-md-2 col-12"><input type="text" name="name" class="form-control" placeholder="Name" required></div>
<div class="col-md-2 col-12"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
<div class="col-md-2 col-12"><input type="text" name="mobile" class="form-control" placeholder="Mobile" required></div>
<div class="col-md-2 col-12"><input type="text" name="course" class="form-control" placeholder="Course" required></div>
<div class="col-md-2 col-12"><input type="text" name="password" class="form-control" placeholder="Password" required></div>
<div class="col-12 mt-2"><button name="add_student" class="btn btn-success w-100">Add Student</button></div>
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
```
