<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
header("Location: ../login.php");
exit();
}

$msg="";
$teacher_subject = $_SESSION['subject'];

if(isset($_POST['send'])){
$title=$_POST['title'];
$message=$_POST['message'];
$sender=$_SESSION['teacher'];
$subject=$teacher_subject;

mysqli_query($conn,"INSERT INTO notices(title,message,sender,subject) 
VALUES('$title','$message','$sender','$subject')");

$msg="Notice Sent Successfully";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Send Notice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#0f2027;color:white;font-family:Segoe UI;}
.container{margin-top:60px;width:500px;}
</style>
</head>
<body>

<div class="container">
<h2>📢 Send Notice (<?php echo $teacher_subject; ?>)</h2>
<p style="color:lightgreen;"><?php echo $msg; ?></p>

<form method="POST">
<input type="text" name="title" class="form-control mb-3" placeholder="Notice Title" required>
<textarea name="message" class="form-control mb-3" placeholder="Notice Message" required></textarea>
<button class="btn btn-success" name="send">Send Notice</button>
</form>

<a href="dashboard.php" class="btn btn-warning mt-3">⬅ Back</a>
</div>

</body>
</html>