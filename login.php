<?php
session_start();
include("db.php");

if(isset($_POST['login_btn']))
{
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ================= ADMIN LOGIN =================
    if($role=="Admin")
    {
        $query = "SELECT * FROM users 
                  WHERE email='$username' 
                  AND password='$password' 
                  AND role='admin'";

        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run)==1){
            $_SESSION['admin']=$username;
            header("Location: admin/dashboard.php");
            exit();
        }else{
            $error="Invalid Admin Login";
        }
    }

    // ================= TEACHER LOGIN =================
    elseif($role=="Teacher")
    {
        $query = "SELECT * FROM teachers 
                  WHERE email='$username' 
                  AND password='$password'";

        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run)==1){

            $row = mysqli_fetch_assoc($run);

            $_SESSION['teacher']=$row['email'];
            $_SESSION['teacher_name']=$row['name'];
            $_SESSION['subject']=$row['subject'];

            header("Location: teacher/dashboard.php");
            exit();

        }else{
            $error="Invalid Teacher Login";
        }
    }

    // ================= STUDENT LOGIN =================
    elseif($role=="Student")
    {
        $query = "SELECT * FROM students 
                  WHERE email='$username' 
                  AND password='$password'";

        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run)==1){

            $row = mysqli_fetch_assoc($run);

            // 🔥 IMPORTANT FIX
            $_SESSION['student_id'] = $row['student_id']; 
            $_SESSION['student_name'] = $row['name'];

            header("Location: student/dashboard.php");
            exit();

        }else{
            $error="Invalid Student Login";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduManage Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
margin:0;
font-family:Segoe UI;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.glass-card{
background:rgba(255,255,255,0.08);
padding:40px;
border-radius:20px;
backdrop-filter:blur(15px);
box-shadow:0 0 40px rgba(0,0,0,0.4);
width:360px;
color:white;
}

.gradient-text{
color:#00ffe7;
}

.form-control{
background:rgba(255,255,255,0.2);
border:none;
color:white;
}

.form-control::placeholder{
color:#ddd;
}

.btn-premium{
background:linear-gradient(90deg,#00c6ff,#0072ff);
border:none;
color:white;
padding:10px;
}
</style>
</head>

<body>

<div class="glass-card text-center">
<h2 class="gradient-text mb-3">EduManage Login</h2>
<p>Select your role</p>

<form method="POST">

<select name="role" class="form-control mb-3" required>
<option value="">Select Role</option>
<option>Admin</option>
<option>Teacher</option>
<option>Student</option>
</select>

<input type="text" name="username" class="form-control mb-3" placeholder="Email / Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button name="login_btn" class="btn btn-premium w-100">Login</button>

</form>

<a href="index.php" class="btn btn-light btn-sm mt-3">← Back Home</a>
</div>

</body>
</html>