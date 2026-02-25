<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
    header("Location: ../login.php");
    exit();
}

$email=$_SESSION['teacher'];

$t=mysqli_query($conn,"SELECT * FROM teachers WHERE email='$email'");
$row=mysqli_fetch_assoc($t);
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#141e30,#243b55);
font-family:Segoe UI;
color:white;
}

.profile-card{
background:rgba(0,0,0,0.65);
padding:30px;
border-radius:15px;
max-width:500px;
margin:auto;
margin-top:60px;
text-align:center;
}

.avatar{
width:90px;
height:90px;
border-radius:50%;
background:#00c6ff;
display:flex;
align-items:center;
justify-content:center;
font-size:35px;
margin:auto;
margin-bottom:15px;
}

.info{
background:#ffffff15;
padding:10px;
border-radius:8px;
margin-bottom:10px;
}
</style>
</head>

<body>

<div class="profile-card">

<div class="avatar">
<?php echo strtoupper(substr($row['name'],0,1)); ?>
</div>

<h3><?php echo $row['name']; ?></h3>
<p>Teacher</p>

<div class="info">📧 <?php echo $row['email']; ?></div>
<div class="info">📚 Subject: <?php echo $row['subject']; ?></div>

<br>

<a href="dashboard.php" class="btn btn-info">Back Dashboard</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>

</div>

</body>
</html>