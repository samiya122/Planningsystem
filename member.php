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




  // include connection settings


if($_SERVER['REQUEST_METHOD']=='POST'){
    require_once "connectdbs.php";
    if(isset($_POST["add_member"])){
    $memberName= $_POST["memberName"];
    $role = $_POST["role"];
    $projectID = $_POST["projectID"];
  


    $sql = "INSERT INTO `MembersOfProject` (memberName, role, projectID, UserID) VALUES ('$memberName', '$role', '$projectID','$userids')";
    $result = mysqli_query($connection,$sql);
    if($result){
        //displays ok sign

        $_SESSION['current'] = "Data inserted";
        header('location:member.php');
    }else{
        echo 'error';
    }


  }
}




    // get a list of all modules in the database

 $query = "SELECT * FROM `MembersOfProject` WHERE UserID=$userids";
 $result = mysqli_query($connection,$query);
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>project</title>
</head>




<body>
    <div class="container2">
        <div class="box2 title">
            <header>PROJECT PLANNER</header>
            <h1><?php echo "Welcome back " . $profile . "!"; ?></h1>
 
        </div> 

        <div class="nav">
            <ul>
                <li><a href="create.php">Projects</a></li>
                <li><a href="member.php">Members</a></li>
                <li><a href="#">Tasks</a></li>
            </ul>
        </div>

        <div class="container-lg">
            <div class="container3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#projectModal" class="btn btn-primary mb-3">Add Project Member</a>
                
                <!-- Your table code goes here -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col">Member Name</th>
                            <th class="col">Role</th>
                            <th class="col">Project ID</th>
                        </tr>  
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                           while($row = mysqli_fetch_assoc($result))
                           {               

                        ?>  

                        <td><?php echo $row["memberName"] ?> </td>
                        <td><?php echo $row["role"] ?> </td>
                        <td><?php echo $row["projectID"] ?> </td>
                       


                          

                        </tr>
                        <?php
                        
                            }
                        ?>    

                        
                       
                        <!-- Add more rows as needed -->
                    </tbody>
                    <!-- Table content -->
                </table>
            </div>
        </div>

        <div class="logout-container">
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </div>
   
    <!-- Modal  https://getbootstrap.com/docs/5.0/components/modal/(Used boostrap modal ) --> 
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" >
                    <div class="modal-body">
                        <!-- Modal content -->
                        <div class="form-group mb-3">
                            <label for="">Member Name</label>
                            <input type="text" class="form-control" name="memberName" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">role</label>
                            <input type="text" class="form-control" name="role" required>
                        </div>
                        <div class="form-group mb-3">
                        <label for="">Project ID</label>
                        <!-- Dropdown menu for Project ID -->
                        <select class="form-select" name="projectID" required>
                            <?php
                            // Fetch project IDs for the current user
                            $projectQuery = "SELECT projectID, projectName FROM `Project` WHERE UserID = $userids";
                            $projectResult = mysqli_query($connection, $projectQuery);

                            while ($projectRow = mysqli_fetch_assoc($projectResult)) {
                                echo "<option value='{$projectRow["projectID"]}'>{$projectRow["projectID"]} ,{$projectRow["projectName"]} </option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_member" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
               
            
            </div>
        </div>
    </div>
</body>
</html>