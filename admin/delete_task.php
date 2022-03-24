<?php
include_once 'dbh.php';

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get id, lưu task vào mảng r tách ra
$id = mysqli_real_escape_string($conn, $_GET['idtask']);

$sql_Task = "delete from task where id_task='$id'";

if(mysqli_query($conn,$sql_Task)){
    echo '<script type = "text/javascript"> alert("Delete Success"); 
    </script>';
    header("Refresh:0; url=./index002.php");
} else{
    echo "ERROR: Hush! Sorry $sql_Task. " 
        . mysqli_error($conn);
}
mysqli_close($conn);