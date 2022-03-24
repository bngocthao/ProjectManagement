<?php
    require_once('./dbh.php');
    if(isset($_POST['updateTS']))
    {
       $id = $_POST['id_task'];
       $task_name = $_POST['task_name'];
       $task_des = $_POST['task_des'];
       $task_pri = $_POST['task_pri'];
       $id_pro = $_POST['task_project'];
       $id_user = $_POST['task_user'];

       $query_update = "UPDATE task set task_name= '$task_name',
                                    task_des= '$task_des',
                                    task_pri= '$task_pri',
                                    id_project= '$id_pro',
                                    id_user= '$id_user'
                                    WHERE id_task = '$id'";                                                          
        if($conn -> query($query_update) === TRUE)
        {
           
            echo '<script type = "text/javascript"> alert("Update Success"); history.go(-2); </script>';
            // header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
        
            echo "Update Fail! <br> ERROR:".$conn->error;
            // echo '<script type = "text/javascript"> alert("Update fail"); history.go(-1); </script>';
        }
    }
?>
