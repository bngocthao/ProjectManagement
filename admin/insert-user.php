<?php
    require_once('./dbh.php');
    $level = $_POST['level'];
    $fullName = $_POST['fullname'];
    $userName = $_POST['username'];
    $pass = md5($_POST['password']);

    $result = $conn->query("INSERT INTO user(level, fullname, username, password)
                            VALUES('$level','$fullName', '$userName','$pass')");

    if($result===true)
    {
        setcookie('register_noti', 'Add user success' , time()+3 , '/');
		header('Location: ./index002.php');
    }else{
        setcookie('register_noti', 'Add user fail' , time()+3 , '/');
        header('Location: ./index002.php');
    }
?>