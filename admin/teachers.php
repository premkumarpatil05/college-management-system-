```php
<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

// ADD TEACHER
if(isset($_POST['add_teacher'])){
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];

mysqli_query($conn,"INSERT INTO teachers(name,email,subject,mobile,password)
VALUES('$name','$email','$subject','$mobile','$password')");
header("Location: teachers.php");
}

// DELETE
if(isset($_GET['delete'])){
$id=$_GET['delete'];
mysqli_query($conn,"DELETE FROM teachers WHERE id=$id");
header("Location: teachers.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Management</title>
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

.form-control{
background:#ffffff15;
border:none;
color:white;
}

label{
font-size:13px;
color:#00ffe7;
}
</style>
</head>

<body>
<div class="container mt-4">

<h2 class="mb-4">👨‍🏫 Teacher Management</h2>

<!-- ADD TEACHER -->
<div class="box">
<h5>Add Teacher</h5>

<form method="POST">
<div class="row">

<div class="col-md-4 col-12 mb-2">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Subject</label>
<input type="text" name="subject" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control" required>
</div>

<div class="col-md-4 col-12 mb-2">
<label>Password</label>
<input type="text" name="password" class="form-control" required>
</div>

<div class="col-12 mt-3">
<button name="add_teacher" class="btn btn-success w-100">Add Teacher</button>
</div>

</div>
</form>
</div>

<!-- SEARCH -->
<div class="box">
<form method="GET">
<input type="text" name="search" class="form-control" placeholder="🔍 Search teacher">
</form>
</div>

<!-- LIST -->
<div class="box">
<div class="table-responsive">
<table class="table table-dark table-bordered">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Mobile</th>
<th>Password</th>
<th>Action</th>
</tr>

<?php
$search="";
if(isset($_GET['search'])){
$search=$_GET['search'];
$query="SELECT * FROM teachers WHERE name LIKE '%$search%' OR subject LIKE '%$search%' ORDER BY id DESC";
}else{
$query="SELECT * FROM teachers ORDER BY id DESC";
}

$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['mobile']; ?></td>
<td><?php echo $row['password']; ?></td>
<td>
<a href="teachers.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
