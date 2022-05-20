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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="ams.css?v=<?php echo time(); ?>">
    <head><title>Retrieve</title></head>
    <body>
    <div class="nav-bar">


<ul class="nav-links">
    <li> <a href="../index.php"> Home </a></li>
    <li> <a href="ams_view.php"> View </a></li>
    <li> <a href="../registration/logout.Php"> Logout </a></li>


</ul>


</div>
<form class="search" action="search.php" method="post">
        
        <select class="form-select select" aria-label="Default select example" name="search_field" required> 
            <option value="fullname" selected>Full Name</option>
            <option value="date">Date</option>
            
        </select>
        <input type="text" placeholder="Enter your search keyword" name="search_keyword" required>
       
        <input class="btn-search btn-primary" type="submit" name="search" value="Search">
    </form>
    
    
        
    <table class="table table-dark"  border="1">
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Status</th>
            <th>Submit</th>
            
            
        </tr>
        
        <?php foreach ($result as $row){ ?>
            <tr>
            <form class="form" method="post" action="">
            
                <td><?php echo$row['id']?></td>
                <td><?php echo $row['fullname']?></td>
                <td>
                
                    Present <input type="radio" name = "attendance[<?php echo $row["fullname"]?>]" value="Present" >
                    Absent<input type="radio" name = "attendance[<?php echo $row["fullname"]?>]" value="Absent" >
                </td>

                <td>
                <input type="submit" class="btn btn-primary" value ="Take Attendance">
                </form>

                </td>
                
                
                
            </tr>
            

<?php 

 


} 



?>



<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $att = $_POST["attendance"];
        $date = date("Y/m/d");

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
                    // header("location: ams_view.php");
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
                    // header("location: ams_view.php");
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
