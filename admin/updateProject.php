<?php
    require_once('./dbh.php');
    $id = $_POST['id_project'];
    $name = $_POST['name_project'];
    $des = $_POST['des_project'];
 
    if(isset($_POST['updateProject']))
    {
       $query_update = "UPDATE project set project_name= '$name',
                                    project_des= '$des'
                                    WHERE id_project='$id'";                                                          
        if($conn -> query($query_update) === TRUE)
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            echo "Update Fail! <br> ERROR:".$conn->error;
        }
   }else{
       echo "Lỗi: ".$conn->error;
   }


   // Remove Project
    if(isset($_POST['deletePJ']))
    {
        $query_delete = "DELETE FROM project WHERE id_project='$_POST[id_project]'";

        if($conn -> query($query_delete) === TRUE)
        {
            echo '<script type = "text/javascript"> alert("Update Success"); 
            </script>';
            header("Refresh:0; url=./index002.php");        }
        else
        {
            echo '<script type = "text/javascript"> alert("Delete fail"); history.go(-1); </script>';
        }
    }
?>