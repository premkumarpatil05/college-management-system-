<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_id'])){
    header("Location: ../login.php");
    exit();
}

$msg="";

if(isset($_POST['submit'])){

    $student = $_SESSION['student_name']; // logged in student
    $subject = $_POST['subject'];
    $assignment = $_POST['assignment'];

    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];

    $upload_folder = "uploads/";
    if(!is_dir($upload_folder)){
        mkdir($upload_folder);
    }

    move_uploaded_file($tmp_name, $upload_folder.$file_name);

    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO submissions(student_name,subject,assignment,file_name,submission_date)
            VALUES('$student','$subject','$assignment','$file_name','$date')";

    if(mysqli_query($conn,$sql)){
        $msg = "Assignment Submitted Successfully ✅";
    }else{
        $msg = "Upload Failed ❌";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>College Assignment Upload</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#0f172a;height:100vh;display:flex;justify-content:center;align-items:center;}
.container{background:#111827;padding:40px;width:400px;border-radius:15px;box-shadow:0 0 40px rgba(0,0,0,0.6);border:1px solid #1f2937;}
.header{text-align:center;margin-bottom:25px;}
.header h2{color:#38bdf8;font-weight:700;}
.header p{color:#9ca3af;font-size:13px;}
.success{text-align:center;color:#22c55e;margin-bottom:15px;font-weight:500;}
input{width:100%;padding:12px;margin:10px 0;border-radius:8px;border:1px solid #374151;background:#020617;color:white;}
input:focus{outline:none;border-color:#38bdf8;box-shadow:0 0 8px #38bdf8;}
button{width:100%;padding:12px;background:#38bdf8;border:none;border-radius:8px;color:black;font-size:16px;font-weight:600;cursor:pointer;transition:0.3s;}
button:hover{background:#0ea5e9;transform:scale(1.05);}
.footer{text-align:center;margin-top:20px;color:#6b7280;font-size:12px;}
</style>
</head>

<body>

<div class="container">

<div class="header">
<h2>🎓 College Assignment Submission</h2>
<p>Student Dashboard Panel</p>
</div>

<div class="success"><?php echo $msg; ?></div>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="subject" placeholder="Subject Name" required>
<input type="text" name="assignment" placeholder="Assignment Title" required>
<input type="file" name="file" required>

<button name="submit">Upload Assignment</button>

</form>

<div class="footer">
College Management System | Student Panel
</div>

</div>

</body>
</html>