<?php 
  
  session_start();
  include( "connectdbs.php");


  // include connection settings


    if(isset($_POST["submit"])){
      $userName = $_POST["username"];
      $passwords = $_POST["password"];
           $sql = "SELECT * FROM `register` WHERE username='$userName' AND  password='$passwords'";
           $result = mysqli_query($connection,$sql);
           $num=mysqli_num_rows($result);
         
             
            if ($num>0){
                
                $_SESSION['User_name'] =$userName;

              header('location:home.php');
              
            }else{
               echo 'invalis';
    
            }
        
            
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box login-box">
            <header>PROJECT PLANNER </header>
     
             <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="text" name="password" placeholder="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Signin" required>
                </div>
                <div class="sign-up-link">
                    <p>Don't have an account? <a href="register.php">Sign up</a> </p>
                </div>

            


             </form>
        </div>
     </div>
             
</body>

</html>