<?php 
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../registration/login.Php");
}



require_once "config.php";

$sql = "SELECT * FROM attendance ";
$result=mysqli_query($conn,$sql);

 

?>



<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="ams.css">
    <head><title>AMS View</title></head>
    <body>
    <div class="nav-bar">


<ul class="nav-links">
    <li> <a href="../index.php"> Home </a></li>
    <li> <a href="../registration/logout.Php"> Logout </a></li>


</ul>


</div>


        
        
    <table class="table  table-dark"" border="1">
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Date</th>
            <th>Status</th>
            
            
        </tr>
        
        <?php foreach ($result as $row){ ?>
            <tr>
                
            
                <td><?php echo$row['id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['date']?></td>
                <td><?php echo $row['status']?></td>
               
                
                
                
            </tr>
            

<?php 

 


} 


?>