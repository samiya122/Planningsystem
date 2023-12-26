<?php 




if($_SERVER['REQUEST_METHOD']=='POST'){
    include "connectdbs.php";
    if(isset($_POST["create"])){
    $userName = $_POST["username"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["number"];
    $passwords = $_POST["password"];

    $sql = "INSERT INTO `register` (username, email, phone_number, password) VALUES ('$userName', '$email', '$phoneNumber', '$passwords')";
    $result = mysqli_query($connection,$sql);
    if($result){
          
        echo "<script type='text/javascript'> alert('Succesfull register')</script>" ;
    }else{
        echo 'error';
    }


  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register </title>
</head>

<body>
    
    <div class="container">
        <div class="box login-box">
            <header>PROJECT PLANNER </header>
            <h1>Register </h1>
    
             <form action="register.php" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username"  id="username" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="number">Phone Number</label>
                    <input type="text" name="number" id="number" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="text" name="password"  id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="create" value="Register" required>
                </div>
                <div class="sign-up-link">
                    <p>Have an account? <a href="signin.php">Sign In</a> </p>
                </div>

            

             </form>
        </div>
     </div>
             
</body>

</html>