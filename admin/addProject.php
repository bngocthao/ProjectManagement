<?php
    require_once('./dbh.php');
    $project_name = $_REQUEST['project_name'];
    $project_des = $_REQUEST['project_des'];   
    $deadline_project = $_REQUEST['deadline_project'];   
    $leader_project = $_REQUEST['leader_project'];


    $result = $conn->query("INSERT INTO project(project_name, project_des, deadline, leader)
                            VALUES('$project_name','$project_des','$deadline_project','$leader_project')");

    if($result===true)
    {
        $conn->query("UPDATE user SET level='2' WHERE id_user='$leader_project'");
        echo '<script type = "text/javascript"> alert("Add Success"); 
        </script>';
        header("Refresh:0; url=./index002.php");
    }else{
        echo '<script type = "text/javascript"> alert("Add Fail Project"); history.go(-1); </script>';
    }
?>

