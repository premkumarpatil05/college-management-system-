```php
<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

// COUNTS
$student_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM students");
$teacher_result = mysqli_query($conn,"SELECT COUNT(*) as total FROM teachers");
$course_result  = mysqli_query($conn,"SELECT COUNT(*) as total FROM subjects");

$students = mysqli_fetch_assoc($student_result)['total'];
$teachers = mysqli_fetch_assoc($teacher_result)['total'];
$courses  = mysqli_fetch_assoc($course_result)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#0f2027;
font-family:Segoe UI;
color:white;
}

/* SIDEBAR */
.sidebar{
height:100vh;
background:#111;
padding:20px;
position:fixed;
width:220px;
}

.sidebar h3{
color:#00ffe7;
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:#ccc;
padding:12px;
text-decoration:none;
margin-bottom:10px;
border-radius:8px;
transition:0.3s;
}

.sidebar a:hover{
background:#00c6ff;
color:white;
}

/* MAIN */
.main{
margin-left:240px;
padding:20px;
}

.card-box{
background: linear-gradient(135deg,#00c6ff,#0072ff);
padding:25px;
border-radius:15px;
text-align:center;
color:white;
transition:0.3s;
}

.card-box:hover{
transform:translateY(-8px);
box-shadow:0 0 20px rgba(0,0,0,0.4);
}

.count{
font-size:35px;
font-weight:bold;
}

.topbar{
display:flex;
justify-content:space-between;
margin-bottom:20px;
}

/* MOBILE FIX */
@media(max-width:768px){
.sidebar{
position:relative;
width:100%;
height:auto;
}
.main{
margin-left:0;
}
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<h3>Admin Panel</h3>

<a href="#">🏠 Dashboard</a>
<a href="students.php">👨‍🎓 Students</a>
<a href="teachers.php">👨‍🏫 Teachers</a>
<a href="subjects.php">📚 Subjects</a>
<a href="all_submissions.php">📂 All Submissions</a>
<a href="notices.php">📢 Notices</a>
<a href="../logout.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="topbar">
<h2>Welcome <?php echo $_SESSION['admin']; ?> 😎</h2>
<h5 id="clock"></h5>
</div>

<div class="row g-4">

<div class="col-md-4 col-12">
<div class="card-box">
<div class="count" id="students">0</div>
Total Students
</div>
</div>

<div class="col-md-4 col-12">
<div class="card-box">
<div class="count" id="teachers">0</div>
Total Teachers
</div>
</div>

<div class="col-md-4 col-12">
<div class="card-box">
<div class="count" id="courses">0</div>
Total Subjects
</div>
</div>

</div>

</div>

<!-- CLOCK -->
<script>
function updateClock(){
let now=new Date();
document.getElementById("clock").innerHTML=now.toLocaleTimeString();
}
setInterval(updateClock,1000);
</script>

<!-- COUNT ANIMATION -->
<script>
function animate(id,end){
let obj=document.getElementById(id);
let current=0;
let increment=Math.ceil(end/40);

let timer=setInterval(function(){
current+=increment;
if(current>=end){
current=end;
clearInterval(timer);
}
obj.innerHTML=current;
},40);
}

animate("students", <?php echo $students; ?>);
animate("teachers", <?php echo $teachers; ?>);
animate("courses", <?php echo $courses; ?>);
</script>

</body>
</html>
```
