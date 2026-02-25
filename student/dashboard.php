<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_id'])){
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$name = $_SESSION['student_name'];

// COUNTS (example queries)
$subject_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM subjects");
$assignment_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM assignments");
$attendance_percent = 85; // demo (later dynamic bana sakte)

$subjects = mysqli_fetch_assoc($subject_result)['total'];
$assignments = mysqli_fetch_assoc($assignment_result)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#141e30;font-family:Segoe UI;color:white;}
.sidebar{height:100vh;background:#111;padding:20px;position:fixed;width:220px;}
.sidebar h3{color:#00ffe7;text-align:center;margin-bottom:30px;}
.sidebar a{display:block;color:#ccc;padding:12px;text-decoration:none;margin-bottom:10px;border-radius:8px;transition:0.3s;}
.sidebar a:hover{background:#00c6ff;color:white;}
.main{margin-left:240px;padding:20px;}
.card-box{background:linear-gradient(135deg,#00c6ff,#0072ff);padding:25px;border-radius:15px;text-align:center;transition:0.3s;}
.card-box:hover{transform:translateY(-8px);}
.count{font-size:35px;font-weight:bold;}
</style>
</head>

<body>

<div class="sidebar">
<h3>Student Panel</h3>
<a href="#">🏠 Dashboard</a>
<a href="student_profile.php">👤 Profile</a>
<a href="subjects.php">📚 Subjects</a>
<a href="assignment.php">📝 Assignments</a>
<a href="upload.php">📝 Assignments Upload</a>
<a href="attendance.php">📊 Attendance</a>
<a href="view_marks.php">📈 View Marks</a>
<a href="notices.php">📢 Notice Board</a>
<a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">

<h2>Welcome <?php echo $name; ?> 🎓</h2>

<div class="row g-4 mt-3">

<div class="col-md-4">
<div class="card-box">
<div class="count" id="subjects">0</div>
Total Subjects
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<div class="count" id="assignments">0</div>
Assignments
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<div class="count" id="attendance">0</div>
Attendance %
</div>
</div>

</div>
</div>

<script>
function animate(id,end){
let obj=document.getElementById(id);
let current=0;
let increment=Math.ceil(end/40);
let timer=setInterval(function(){
current+=increment;
if(current>=end){current=end;clearInterval(timer);}
obj.innerHTML=current;
},40);
}

animate("subjects", <?php echo $subjects; ?>);
animate("assignments", <?php echo $assignments; ?>);
animate("attendance", <?php echo $attendance_percent; ?>);
</script>

</body>
</html>