<?php
require_once "config.php";
if(isset($_POST["search_keyword"]) && isset($_POST["search_field"])){
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "fullname"){
        $sql=" SELECT * FROM attendance WHERE name LIKE '%".$search_keyword . "%'";
        $result = mysqli_query($conn,$sql);
    } elseif ($search_field == "date"){
        $sql = " SELECT * FROM attendance WHERE date LIKE '%".$search_keyword . "%'";
        $result =mysqli_query($conn,$sql);
    } 
}
?>

<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="ams.css?v=<?php echo time(); ?>">
<head><title>Retrieve</title></head>
<body>
<div class="searchField"> 
<form class="search" action="search.php" method="post">

    
    <select class="form-select select" aria-label="Default select example" name="search_field" required>
        <option value ="fullname" selected> Full Name</option>
        <option value ="date" selected>Date</option>
       
    </select>
    <input type ="text" name="search_keyword" required>
    <input class="btn-search btn-primary" type ="submit" value="Search">
   
</form>
<a href="ams.php"><button class="btn-clear">Clear</button></a>
</div>

<table class="table table-dark" border="1">
    <tr>
        <th>id</th>
        
        <th>Full Name</th>
        <th>Date</th>
        <th>Attendance</th>
        
    </tr>
    <?php
    if (isset($result)) {
        if (mysqli_num_rows($result) == 0 ) {
            echo "<tr>";
            echo "<td colspan='7' > No Data found </td>";
            echo "</td>";
        }
    }
    ?>
    <?php if (isset($result)) { ?>
    <?php foreach ($result as $row){ ?>
    <tr>
        <td><?php echo$row['id']?></td>
        
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['date']?></td>
        <td><?php echo $row['status']?></td>
     
        </tr>
        <?php } ?>
    <?php } ?>
</table>
</body>
</html>