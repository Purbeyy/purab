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
            <li> <a href="login.php"> Login </a></li>


        </ul>


    </div>
    
        <form action="" class="reg-form form-group" method="post"> 

        
            <label for="full_name"> Full Name </label>
            <input type="text" class="form-control" name="full_name" placeholder="Enter your full name"> <br>
            
            <label for="email"> Email </label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email"> <br>
            
            <label for="roles"> roles </label>
            <select class="form-control" name="roles">
            <option value="teacher">Teacher</option>    
            <option value="student">Student</option>
            </select>    
            
            <br>

            
            <label for="password">  Enter Password </label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password"> <br>
            
            <label for="confirm_password"> Confirm Password </label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your password"> <br>

            <button type="submit" class="btn btn-primary">Sign In</button>

        </form>

        
    

   
        
</body>
</html>
<?php
require_once "config.php";



$full_name = $email = $roles = $password = $confirm_password = "";
$full_name_err = $email_err = $roles_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST['full_name']))) {
        $full_name_err = "Full name cannot be blank";
    } 
    else {
        $full_name = trim($_POST['full_name']);
    }

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param full_name
            $param_email= trim($_POST['email']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken";
                    echo $email_err;
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


  
   
    if (empty(trim($_POST['roles']))) {
        $roles_err = "roles cannot be blank";
    } 
    else {
        $roles = trim($_POST['roles']);
    }


// Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }


// If there were no errors, go ahead and insert into the database
    if (empty($full_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (fullname, email, roles, password) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_full_name, $param_email, $param_roles, $param_password);

            // Set these parameters
            $param_full_name = $full_name;
            $param_email = $_POST["email"];
            $param_roles = $_POST["roles"];
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
            
        }
        mysqli_stmt_close($stmt);
        
    }
    mysqli_close($conn);
}

?>



