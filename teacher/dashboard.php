<?php
session_start();
include("../db.php");

if(!isset($_SESSION['teacher'])){
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['teacher'];
$teacher_subject = $_SESSION['subject'];

// COUNTS
$student_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM students");
$subject_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM subjects WHERE subject_name='$teacher_subject'");
$assignment_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM submissions WHERE subject='$teacher_subject'");

$students = mysqli_fetch_assoc($student_result)['total'];
$subjects = mysqli_fetch_assoc($subject_result)['total'];
$assignments = mysqli_fetch_assoc($assignment_result)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#0f2027;font-family:Segoe UI;color:white;}
.sidebar{height:100vh;background:#111;padding:20px;position:fixed;width:220px;}
.sidebar h3{color:#00ffe7;text-align:center;margin-bottom:30px;}
.sidebar a{display:block;color:#ccc;padding:12px;text-decoration:none;margin-bottom:10px;border-radius:8px;}
.sidebar a:hover{background:#00c6ff;color:white;}
.main{margin-left:240px;padding:20px;}
.card-box{background:linear-gradient(135deg,#00c6ff,#0072ff);padding:25px;border-radius:15px;text-align:center;}
.count{font-size:35px;font-weight:bold;}
</style>
</head>

<body>

<div class="sidebar">
<h3>Teacher Panel</h3>
<a href="#">🏠 Dashboard</a>
<a href="profile.php">My Profile</a>
<a href="students.php">👨‍🎓 Students</a>
<a href="take_attendance.php">📊 Attendance</a>
<a href="view_submissions.php">📂 View Submissions</a>
<a href="subjects.php">📚 Subjects</a>
<a href="assignment.php">📝 Upload Assignment</a>
<a href="add_marks.php">📈 Add Marks</a>
<a href="manage_marks.php">📊 Manage Marks</a>
<a href="send_notice.php">📢 Send Notice</a>
<a href="notices.php">📢 Notice Board</a>

<a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">

<h2>Welcome <?php echo $name; ?> 👨‍🏫</h2>
<p>Subject: <b><?php echo $teacher_subject; ?></b></p>

<div class="row g-4 mt-3">

<div class="col-md-4">
<div class="card-box">
<div class="count" id="students">0</div>
Total Students
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<div class="count" id="subjects">0</div>
My Subject
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<div class="count" id="assignments">0</div>
Assignments Submitted
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

animate("students", <?php echo $students; ?>);
animate("subjects", <?php echo $subjects; ?>);
animate("assignments", <?php echo $assignments; ?>);
</script>

</body>
</html>