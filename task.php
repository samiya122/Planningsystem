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






if($_SERVER['REQUEST_METHOD']=='POST'){
    require_once "connectdbs.php";
    if(isset($_POST["add_task"])){
    $taskName= $_POST["taskName"];
    $taskStart= $_POST["start"];
    $taskEnd= $_POST["end"];
    $taskStatus = $_POST["status"];
    $projectID = $_POST["projectID"];
    


      $selectedMember = explode(",", $_POST["memberIDAndName"]);
      $memberID = $selectedMember[0];
      $memberName = $selectedMember[1];





    $sql = "INSERT INTO `Tasks` (taskName, taskStart, taskEnd, status, projectID, memberID, memberName, UserID) VALUES ('$taskName', '$taskStart', '$taskEnd', '$taskStatus','$projectID', '$memberID', '$memberName', '$userids')";
    $result = mysqli_query($connection,$sql);
    if($result){
        

       

        $_SESSION['current'] = "Data inserted";
        header('location:task.php');
    }else{
        echo 'error';
    }


  }
}





 $query = "SELECT taskID, taskName, taskStart, taskEnd, status, projectID, memberName FROM `Tasks` WHERE UserID=$userids";
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
                <li><a href="task.php">Tasks</a></li>
            </ul>
        </div>

        <div class="container-lg">
            <div class="container3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#projectModal" class="btn btn-primary mb-3">Add Task</a>
                
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col">Task ID</th>
                            <th class="col">Task Description</th>
                            <th class="col">Start Date</th>
                            <th class="col">End Date</th>
                            <th class="col">status</th>
                            <th class="col">Project ID</th>
                            <th class="col">Assign to  Member Name</th>
                            <th class="col">Operation</th>


                        </tr>  
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                           while($row = mysqli_fetch_assoc($result))
                           {               

                        ?>  

                        <td><?php echo $row["taskID"] ?> </td>
                        <td><?php echo $row["taskName"] ?> </td>
                        <td><?php echo $row["taskStart"] ?> </td>
                        <td><?php echo $row["taskEnd"] ?> </td>
                        <td><?php echo $row["status"] ?> </td>
                        <td><?php echo $row["projectID"] ?> </td>
                        <td><?php echo $row["memberName"] ?> </td>
                        <td><a href="delete.php?taskID=<?php echo $row["taskID"]; ?>" class="btn btn-danger">Delete</a></td>

                       


                          

                        </tr>
                        <?php
                        
                            }
                        ?>    

                        
                       
                       
                    </tbody>
                </table>
            </div>
        </div>

        <div class="logout-container">
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </div>
   
    
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" >
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Task Name</label>
                            <input type="text" class="form-control" name="taskName" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Start Date</label>
                            <input type="date" class="form-control" name="start" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">End date</label>
                            <input type="date" class="form-control" name="end" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">status</label>
                            <input type="text" class="form-control" name="status" required>
                        </div>
                        <div class="form-group mb-3">
                          <label for="">Project ID and Name </label>
                        
                          <select class="form-select" name="projectID" required>
                            <?php
                            $projectQuery = "SELECT projectID, projectName FROM `Project` WHERE UserID = $userids";
                            $projectResult = mysqli_query($connection, $projectQuery);

                            while ($projectRow = mysqli_fetch_assoc($projectResult)) {
                                echo "<option value='{$projectRow["projectID"]}'>{$projectRow["projectID"]} & {$projectRow["projectName"]} </option>";
                            }
                            ?>
                          </select>
                      </div>
                      <div class="form-group mb-3">
                          <label for="">Assign to Member ID and Name </label>
                          <select class="form-select" name="memberIDAndName" required>
                            <?php
                            $memberQuery = "SELECT ID, memberName FROM `MembersOfProject` WHERE UserID = $userids";
                            $memberResult = mysqli_query($connection, $memberQuery);

                            while ($memberRow = mysqli_fetch_assoc($memberResult)) {
                                echo "<option value='{$memberRow["ID"]},{$memberRow["memberName"]}'>{$memberRow["ID"]} & {$memberRow["memberName"]} </option>";                            }
                            ?>
                          </select>
                      </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_task" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
               
            
            </div>
        </div>
    </div>
</body>
</html>