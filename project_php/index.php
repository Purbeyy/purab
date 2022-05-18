<?php
session_start();
if(isset($_SESSION["full_name"])){
  header("location:registration/welcome.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<div class="nav-bar">


<marquee behavior="alternate" class="marquee">Attendance Management System by Purab Marahatta</marquee>


</div>
<hr class="hr">
<h1 class="head">Welcome to Attendance Management System</h1>
<div class="index-message">
  <button class="log-btn"><a href="registration/login.php">Login</a></button>
  <button class="reg-btn"> <a href="registration/register.php">Register</a></button>
</div>

    
</body>
</html>