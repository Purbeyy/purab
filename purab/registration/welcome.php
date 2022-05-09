<?php 
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.Php");
}
 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css?v=<?php echo time(); ?>">
    <title>Welcome</title>
</head>
<body>
    <div class="nav-bar">
        <ul class="nav-links">
            <li><a href="../attendance/ams.php">Attendance</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="wlc-main">
    <h1><a href="../attendance/ams.php"> <button class="wlc-btn">Go to Attendance</button> </a></h1>
</div>

    
</body>
</html>