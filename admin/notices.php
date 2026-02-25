<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

// ADD NOTICE
if(isset($_POST['add_notice'])){
$title=$_POST['title'];
$message=$_POST['message'];
$date=$_POST['date'];
$sender="Admin";

mysqli_query($conn,"INSERT INTO notices(title,message,date,sender,subject)
VALUES('$title','$message','$date','$sender','All')");

header("Location: notices.php");
}

// DELETE
if(isset($_GET['delete'])){
$id=$_GET['delete'];
mysqli_query($conn,"DELETE FROM notices WHERE id=$id");
header("Location: notices.php");
}

// FETCH EDIT DATA
$edit_data=null;
if(isset($_GET['edit'])){
$eid=$_GET['edit'];
$res=mysqli_query($conn,"SELECT * FROM notices WHERE id=$eid");
$edit_data=mysqli_fetch_assoc($res);
}

// UPDATE NOTICE
if(isset($_POST['update_notice'])){
$id=$_POST['id'];
$title=$_POST['title'];
$message=$_POST['message'];
$date=$_POST['date'];

mysqli_query($conn,"UPDATE notices 
SET title='$title', message='$message', date='$date' 
WHERE id=$id");

header("Location: notices.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Notice Management</title>
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
.notice-card{
background:rgba(255,255,255,0.08);
padding:15px;
border-radius:12px;
margin-bottom:15px;
}
.notice-card h5{color:#00ffe7;}
</style>
</head>

<body>
<div class="container mt-4">

<h2 class="mb-4">📢 Notice Management</h2>

<!-- ADD / EDIT NOTICE -->
<div class="box">
<h5><?php echo $edit_data ? "Edit Notice" : "Add Notice"; ?></h5>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $edit_data['id'] ?? ''; ?>">

<div class="mb-2">
<label>Title</label>
<input type="text" name="title" class="form-control" required 
value="<?php echo $edit_data['title'] ?? ''; ?>">
</div>

<div class="mb-2">
<label>Date</label>
<input type="date" name="date" class="form-control" required 
value="<?php echo $edit_data['date'] ?? ''; ?>">
</div>

<div class="mb-2">
<label>Message</label>
<textarea name="message" class="form-control" required><?php echo $edit_data['message'] ?? ''; ?></textarea>
</div>

<button 
name="<?php echo $edit_data ? 'update_notice' : 'add_notice'; ?>" 
class="btn btn-success w-100">
<?php echo $edit_data ? "Update Notice" : "Add Notice"; ?>
</button>

</form>
</div>

<!-- NOTICE LIST -->
<div class="box">
<h5>All Notices</h5>

<?php
$q=mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
while($row=mysqli_fetch_assoc($q)){
?>

<div class="notice-card">
<h5><?php echo $row['title']; ?></h5>
<p><?php echo $row['message']; ?></p>
<small>
By: <?php echo $row['sender']; ?> | 
Date: <?php echo $row['date']; ?>
</small><br>

<a href="notices.php?edit=<?php echo $row['id']; ?>" 
class="btn btn-warning btn-sm mt-2">Edit</a>

<a href="notices.php?delete=<?php echo $row['id']; ?>" 
class="btn btn-danger btn-sm mt-2">Delete</a>
</div>

<?php } ?>

</div>

<a href="dashboard.php" class="btn btn-light">← Back Dashboard</a>

</div>
</body>
</html>