<?php
session_start();
include("../db.php");

// DELETE MARKS
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM marks WHERE id='$id'");
    echo "<script>alert('Deleted');window.location='manage_marks.php';</script>";
}

// UPDATE MARKS
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    $total = $_POST['total'];
    $exam = $_POST['exam'];
    $date = $_POST['exam_date'];

    mysqli_query($conn,"UPDATE marks SET 
    subject='$subject',
    marks='$marks',
    total_marks='$total',
    exam_type='$exam',
    exam_date='$date'
    WHERE id='$id'");

    echo "<script>alert('Updated');window.location='manage_marks.php';</script>";
}

$result = mysqli_query($conn,"SELECT * FROM marks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Marks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
font-family:Arial;
background:#eef2f7;
margin:0;
padding:20px;
}

table{
width:100%;
background:white;
border-collapse:collapse;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
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

a{
padding:6px 12px;
background:red;
color:white;
text-decoration:none;
border-radius:5px;
}

.editbtn{
background:green;
}
</style>
</head>
<body>

<h2>Manage Student Marks</h2>

<table>
<tr>
<th>ID</th>
<th>Student ID</th>
<th>Subject</th>
<th>Marks</th>
<th>Total</th>
<th>Exam</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<form method="POST">
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_id']; ?></td>

<td>
<input type="text" name="subject" value="<?php echo $row['subject']; ?>">
</td>

<td>
<input type="number" name="marks" value="<?php echo $row['marks']; ?>">
</td>

<td>
<input type="number" name="total" value="<?php echo $row['total_marks']; ?>">
</td>

<td>
<input type="text" name="exam" value="<?php echo $row['exam_type']; ?>">
</td>

<td>
<input type="date" name="exam_date" value="<?php echo $row['exam_date']; ?>">
</td>

<td>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<button name="update" class="editbtn">Update</button>
<a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
</td>
</form>
</tr>
<?php } ?>

</table>

</body>
</html>