<?php 
session_start();
if ($_SESSION["roles"]=="student"){
    header("location:ams_view.php");
};

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../registration/login.Php");
}

$roles = "student";

require_once "config.php";

$sql = "SELECT * FROM users WHERE roles = 'student' ";
$result=mysqli_query($conn,$sql);

 

?>



<html>
    <link rel="stylesheet" href="ams.css?v=<?php echo time(); ?>">
    <head><title>Retrieve</title></head>
    <body>
    <div class="nav-bar">


<ul class="nav-links">
    <li> <a href="../index.php"> Home </a></li>
    <li> <a href="../registration/login.Php"> Logout </a></li>


</ul>


</div>
    <form class="form" method="post" action="">
    <input type="date" name="date">
        
    <table class="table" border="1">
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Status</th>
            
            
        </tr>
        
        <?php foreach ($result as $row){ ?>
            <tr>
                
            
                <td><?php echo$row['id']?></td>
                <td><?php echo $row['fullname']?></td>
                <td>
                    Present <input type="radio" name = "attendance[<?php echo $row["fullname"]?>]" value="Present" >
                    Absent<input type="radio" name = "attendance[<?php echo $row["fullname"]?>]" value="Absent" >
                </td>
                
                
                
            </tr>
            

<?php 

 


} 



?>

    <input type="submit" value ="Take Attendance">
</form>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $att = $_POST["attendance"];
        $date = $_POST["date"];

        foreach($att as $key => $value){
            if($value=="Present"){
        
            $sql = "INSERT INTO attendance (name, date, status) VALUES (?,?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_date, $param_status);
    
                // Set these parameters
                $param_name = $key;
                $param_date = $date;
                $param_status = "Present";
                
                
    
                // Try to execute the query
                if (mysqli_stmt_execute($stmt)) {
                    header("location: ams_view.php");
                } else {
                    echo "Something went wrong... cannot redirect!";
                }
                
            }
           
            mysqli_stmt_close($stmt);
            
        }
        else {
            $sql = "INSERT INTO attendance (name, date, status) VALUES (?,?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_date, $param_status);
    
                // Set these parameters
                $param_name = $key;
                $param_date = $date;
                $param_status = "Absent";
                
                
    
                // Try to execute the query
                if (mysqli_stmt_execute($stmt)) {
                    header("location: ams_view.php");
                } else {
                    echo "Something went wrong... cannot redirect!";
                }
                
            }
            mysqli_stmt_close($stmt);
            
        }
        mysqli_close($conn);


        }
    }
            
            
        

    

?>
    </table>
    <script src="script.js"></script>
    </body>
    </html>
