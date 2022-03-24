<?php
// KIEM TRA DANG NHAP
if(isset($_COOKIE['login_user']))
{
    header('Location: ./index002.php');
}else{
    header('Location: ./login.php');
}
?>