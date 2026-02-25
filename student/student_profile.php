<?php
session_start();
$conn = mysqli_connect("localhost","root","","edumanage_db");

if(!isset($_SESSION['student_id'])){
    echo "<h2 style='text-align:center;margin-top:50px;'>Login First</h2>";
    exit;
}

$student_id = $_SESSION['student_id'];

$query = "SELECT * FROM students WHERE student_id='$student_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

if(!$row){
    echo "Student not found in database";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

<style>
body{
font-family:Poppins;
margin:0;
background:linear-gradient(to right,#1e3c72,#2a5298);
}

.container{
width:90%;
max-width:900px;
margin:30px auto;
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.header{text-align:center;}

.profile{
width:100px;
height:100px;
border-radius:50%;
background:#ddd;
margin:auto;
font-size:40px;
display:flex;
align-items:center;
justify-content:center;
}

.stats{
display:flex;
flex-wrap:wrap;
gap:10px;
margin-top:25px;
}

.card{
flex:1 1 45%;
background:#f4f6f9;
padding:15px;
text-align:center;
border-radius:12px;
box-shadow:0 5px 10px rgba(0,0,0,0.1);
}

.info{
margin-top:25px;
background:#f4f6f9;
padding:20px;
border-radius:12px;
}

@media(max-width:600px){
.card{flex:1 1 100%;}
}
</style>
</head>

<body>

<div class="container">

<div class="header">
<div class="profile">🎓</div>
<h2><?php echo $row['name']; ?></h2>
<p><?php echo $row['course']; ?></p>
<p><b>ID:</b> <?php echo $row['student_id']; ?></p>
</div>

<div class="stats">
<div class="card">
<h3>Email</h3>
<p><?php echo $row['email']; ?></p>
</div>

<div class="card">
<h3>Mobile</h3>
<p><?php echo $row['mobile']; ?></p>
</div>

<div class="card">
<h3>Joined</h3>
<p><?php echo date("d M Y", strtotime($row['created_at'])); ?></p>
</div>

<div class="card">
<h3>Status</h3>
<p>Active</p>
</div>
</div>

<div class="info">
<h3>Student Details</h3>
<p><b>Name:</b> <?php echo $row['name']; ?></p>
<p><b>Course:</b> <?php echo $row['course']; ?></p>
<p><b>Email:</b> <?php echo $row['email']; ?></p>
<p><b>Mobile:</b> <?php echo $row['mobile']; ?></p>
</div>

</div>
</body>
</html>