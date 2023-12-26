
<?php
include("connectdbs.php");

if (isset($_GET["projectID"])) {
    $projectID = $_GET["projectID"];


    $sqlRemoveTasks = "DELETE FROM `Tasks` WHERE projectID = $projectID";
    $resultRemoveTasks = mysqli_query($connection, $sqlRemoveTasks);

  
    $sqlRemoveMember = "DELETE FROM `MembersOfProject` WHERE projectID = $projectID";
    $resultRemoveMember = mysqli_query($connection, $sqlRemoveMember);


   
    $sqlDeleteProject = "DELETE FROM Project WHERE projectID = $projectID";
    $resultDeleteProject = mysqli_query($connection, $sqlDeleteProject);

    if ($resultDeleteProject) {
        header('location:create.php');
    } else {
        echo 'error';
    }
}
?>


<?php
include("connectdbs.php");

if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];

  
    $sqlRemoveTasksMember = "DELETE FROM `Tasks` WHERE memberID = $ID";
    $resultRemoveTasksMember = mysqli_query($connection, $sqlRemoveTasksMember);

  
    $sqlDeleteMember = "DELETE FROM `MembersOfProject` WHERE ID = $ID";
    $resultDeleteMember = mysqli_query($connection, $sqlDeleteMember);

    if ($resultDeleteMember) {
        header('location:member.php');
    } else {
        echo 'error';

    }
}
?>


<?php
include("connectdbs.php");

if (isset($_GET["taskID"])) {
    $taskID = $_GET["taskID"];

   
    $sqlDeleteTasks = "DELETE FROM `Tasks` WHERE taskID = $taskID";
    $resulDeleteTasks = mysqli_query($connection, $sqlDeleteTasks);

  
    if ($resulDeleteTasks) {
        header('location:task.php');
    } else {
        echo 'error';
    }
}
?>