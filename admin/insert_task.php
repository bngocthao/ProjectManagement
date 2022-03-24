<?php
    require_once('./dbh.php');

    $task_name = $_POST['task_name'];
    $task_des = $_POST['task_des'];
    $task_pri = $_POST['task_pri'];
    $id_project = $_POST['task_project'];
    $id_user = $_POST['task_user'];
    

    $result = $conn->query("INSERT INTO task(task_name, task_des, task_pri, id_project, id_user)
                            VALUES('$task_name','$task_des', '$task_pri','$id_project','$id_user')");

    if($result===true)
    {
        echo '<script type = "text/javascript"> alert("Adding Success"); 
        </script>';
        header("Refresh:0; url=./index002.php");
    }else{
        echo '<script type = "text/javascript"> alert("Task Add Fail"); history.go(-1); </script>';

    }
?>