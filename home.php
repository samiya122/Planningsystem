<?php
session_start();
error_reporting(0);
include( "connectdbs.php");
$profile=$_SESSION['User_name'];
if ($profile==true){

}
else
{
    header('location:signin.php');
}

echo "Welcome " .$profile;
$sql = "SELECT * FROM `register` WHERE username='$profile'";
  $result = mysqli_query($connection,$sql);
  $data=mysqli_fetch_assoc($result);

?>

<a href="logout.php">LOGOUT</a>