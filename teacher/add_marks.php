<?php
session_start();
include("../db.php");

if(isset($_POST['submit']))
{
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    $total = $_POST['total'];
    $exam = $_POST['exam'];

    // safe exam date
    $exam_date = isset($_POST['exam_date']) ? $_POST['exam_date'] : '';

    $query = "INSERT INTO marks 
    (student_id,subject,marks,total_marks,exam_type,exam_date)
    VALUES 
    ('$student_id','$subject','$marks','$total','$exam','$exam_date')";

    if(mysqli_query($conn,$query)){
        echo "<script>alert('✅ Marks Added Successfully');</script>";
    }else{
        echo "<script>alert('Error adding marks');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Student Marks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

<style>
body{
margin:0;
font-family:Poppins;
background:url('images/college.jpg') no-repeat center center fixed;
background-size:cover;
}

body::before{
content:"";
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.7);
z-index:-1;
}

.container{
max-width:500px;
margin:60px auto;
background:rgba(255,255,255,0.95);
padding:30px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.6);
}

h2{
text-align:center;
margin-bottom:20px;
}

input,select{
width:100%;
padding:12px;
margin:10px 0;
border-radius:8px;
border:1px solid #ccc;
font-size:15px;
}

label{
font-weight:600;
}

button{
width:100%;
padding:12px;
background:linear-gradient(90deg,#00c6ff,#0072ff);
border:none;
color:white;
font-size:16px;
border-radius:8px;
cursor:pointer;
}

button:hover{
opacity:0.9;
}
</style>
</head>

<body>

<div class="container">
<h2>🎓 Add Student Marks</h2>

<form method="POST">

<input type="text" name="student_id" placeholder="Enter Student ID" required>

<input type="text" name="subject" placeholder="Subject Name" required>

<input type="number" name="marks" placeholder="Marks Obtained" required>

<input type="number" name="total" placeholder="Total Marks" required>

<select name="exam" required>
<option value="">Select Exam Type</option>
<option>Unit Test</option>
<option>Internal</option>
<option>Semester</option>
<option>Final Exam</option>
</select>

<label>Exam Date</label>
<input type="date" name="exam_date" required>

<button type="submit" name="submit">Add Marks</button>

</form>
</div>

</body>
</html>