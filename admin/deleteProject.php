<?php

include_once 'dbh.php';

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get id
$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql_Task = "delete from project where id_project='$id'";

if(mysqli_query($conn,$sql_Task)){
    header("Location: index002.php");
} else{
    echo "ERROR: Hush! Sorry $sql_Task. " 
        . mysqli_error($conn);
}

mysqli_close($conn);