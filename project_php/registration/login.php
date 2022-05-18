<?php
//This script will handle login
session_start();
if(isset($_SESSION['full_name']))
{
    header("location:welcome.Php");
    exit;
}
require_once "config.php";
$full_name = $password = "";
$err = "";
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST['full_name'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter full_name and password";
        echo $err;
    }
    else{
        $full_name = trim($_POST['full_name']);
        $password = trim($_POST['password']);
       
    }


    if(empty($err))
    {
        $sql = "SELECT id, fullname, roles,  password FROM users WHERE fullname = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_full_name);
        $param_full_name = $full_name;

// Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $full_name, $roles, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
// this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["full_name"] = $full_name;
                        $_SESSION["id"] = $id;
                        $_SESSION["roles"] = $roles;
                        $_SESSION["loggedin"] = true;

//Redirect user to welcome page
                        header("location:welcome.php");

                    }
                }

            }

        }
    }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="registration.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>AMS</title>
</head>
<body>
<div class="nav-bar">
   

        <ul class="nav-links">
            <li> <a href="../index.php"> Home </a></li>
            <li> <a href="register.php"> Register </a></li>


        </ul>


    </div>








    
    <form action="login.php"  class="log-form form-group" method="post">
        <label for="name">Full Name:</label>
        <input type="text" class="form-control" name="full_name" id="email" placeholder="Enter Full Name"> <br>

        

        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password"> <br>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>


</body>
</html>