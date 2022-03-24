<?php

require_once('./dbh.php');
// $id = $_POST['id_user'];
// $username = $_POST['username'];
// $fullname = $_POST['fullname'];
$level = $_GET['level'];
$uid = $_GET["uid"];
if(isset($_GET['updateLevel']))
{
   $query_update = "UPDATE user set level= '$level',
                                WHERE id_user='$uid'";                                                          
    if($conn -> query($query_update) === TRUE)
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        echo "Update Fail! <br> ERROR:".$conn->error;
    }
}else{
   echo "ERROR: ".$conn->error;
}
?>