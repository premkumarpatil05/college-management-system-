<!DOCTYPE html>
<html>
<head>
<title>Smart Campus System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
margin:0;
font-family:'Segoe UI',sans-serif;
background:#0f2027;
color:white;
}

/* NAVBAR */
.navbar{
background:#111;
padding:15px 30px;
}

.navbar-brand{
color:#00c6ff !important;
font-weight:bold;
font-size:22px;
}

/* HERO */
.hero{
height:90vh;
display:flex;
justify-content:center;
align-items:center;
flex-direction:column;
text-align:center;
}

.hero h1{
font-size:45px;
font-weight:700;
}

.hero p{
color:#bbb;
margin-top:10px;
}

.btn-main{
margin-top:25px;
padding:14px 40px;
border-radius:30px;
background:#00c6ff;
border:none;
color:black;
font-weight:600;
font-size:18px;
transition:0.3s;
}

.btn-main:hover{
background:#0099cc;
transform:scale(1.05);
}

/* FEATURES */
.features{
background:#16222a;
padding:60px 20px;
}

.feature-box{
background:#1f2e38;
padding:25px;
border-radius:12px;
text-align:center;
transition:0.3s;
}

.feature-box:hover{
background:#243b4a;
transform:translateY(-8px);
}

/* FOOTER */
.footer{
background:#111;
text-align:center;
padding:15px;
font-size:14px;
color:#aaa;
}

@media(max-width:768px){
.hero h1{font-size:28px;}
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark">
<a class="navbar-brand" href="#">🎓 Smart Campus System</a>

<div class="ms-auto">
<a href="login.php" class="btn btn-outline-light btn-sm">Login</a>
</div>
</nav>

<!-- HERO -->
<div class="hero">
<h1>Welcome to Smart Campus</h1>
<p>Advanced Student Teacher Management Web System</p>

<a href="login.php">
<button class="btn-main">Enter Portal</button>
</a>
</div>

<!-- FEATURES -->
<div class="features container">
<div class="row g-4">

<div class="col-md-4">
<div class="feature-box">
<h5>👨‍🎓 Student Panel</h5>
<p>Attendance, assignments and study material</p>
</div>
</div>

<div class="col-md-4">
<div class="feature-box">
<h5>👨‍🏫 Teacher Panel</h5>
<p>Upload notes, manage students and attendance</p>
</div>
</div>

<div class="col-md-4">
<div class="feature-box">
<h5>🛠 Admin Panel</h5>
<p>Full system management and control</p>
</div>
</div>

</div>
</div>

<!-- FOOTER -->
<div class="footer">
Developed by Premkumar 🚀
</div>

</body>
</html>