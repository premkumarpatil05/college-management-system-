<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_id'])){
    echo "Login First";
    exit;
}

$student_id = $_SESSION['student_id'];

$query = "SELECT * FROM marks WHERE student_id='$student_id' ORDER BY exam_date DESC";
$result = mysqli_query($conn,$query);

$total_marks = 0;
$total_obtained = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>College Result</title>
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
max-width:1000px;
margin:40px auto;
background:rgba(255,255,255,0.95);
padding:25px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.6);
}

h2{
text-align:center;
margin-bottom:10px;
}

.printbtn{
display:block;
margin:10px auto 20px auto;
padding:10px 25px;
background:#2a5298;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#2a5298;
color:white;
padding:12px;
}

td{
padding:10px;
text-align:center;
border-bottom:1px solid #ddd;
}

tr:hover{
background:#f4f6f9;
}

.summary{
margin-top:20px;
padding:15px;
background:#f4f6f9;
border-radius:10px;
text-align:center;
font-weight:600;
font-size:18px;
}

/* print clean */
@media print{
body{
background:white;
}
body::before{
display:none;
}
.printbtn{
display:none;
}
.container{
box-shadow:none;
margin-top:10px;
}
}
</style>
</head>
<body>

<div class="container">
<h2>🎓 College Academic Result</h2>

<button class="printbtn" onclick="window.print()">🖨 Print Result</button>

<table>
<tr>
<th>Subject</th>
<th>Marks Obtained</th>
<th>Total Marks</th>
<th>Exam</th>
<th>Exam Date</th>
</tr>

<?php 
while($row=mysqli_fetch_assoc($result)) { 

$total_marks += $row['total_marks'];
$total_obtained += $row['marks'];
?>

<tr>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['marks']; ?></td>
<td><?php echo $row['total_marks']; ?></td>
<td><?php echo $row['exam_type']; ?></td>
<td>
<?php 
if(!empty($row['exam_date'])){
echo date("d M Y", strtotime($row['exam_date']));
}else{
echo "-";
}
?>
</td>
</tr>

<?php } ?>
</table>

<div class="summary">
Total Marks Obtained: <?php echo $total_obtained; ?><br>
Total Maximum Marks: <?php echo $total_marks; ?>
</div>

</div>
</body>
</html>