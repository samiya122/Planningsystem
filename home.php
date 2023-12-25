<?php
session_start();
error_reporting(0);
include( "connectdbs.php");
$profile=$_SESSION['User_name'];
$userids=$_SESSION['User_id'];
if ($profile==true){

}
else
{
    header('location:signin.php');
}


$sql = "SELECT * FROM `register` WHERE username='$profile' AND UserID='$userID'";
  $result = mysqli_query($connection,$sql);
  $data=mysqli_fetch_assoc($result);
 /* $userID = mysqli_insert_id($connection);*/

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Home </title>
</head>

<body>
    <div class="container2">
        <div class="box2 title">
      <header>PROJECT   PLANNER</header>
      <h1><?php echo "Welcome back " . $profile . "!"; ?></h1>
      <h1><?php echo "your user id is " . $userids . "!"; ?></h1>
 

    </div> 

    <div class="nav">
        <ul>
            <li><a href="project.php">Projects</a></li>
            <li><a href="#">Members</a></li>
            <li><a href="#">Tasks</a></li>
        </ul>
   </div>

   <div class="logout-container">
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    
             

    
             
</body>

</html>