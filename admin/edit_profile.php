<?php
    require_once('./dbh.php');
    if(isset($_POST['updatePF']))
    {
       $query_update = "UPDATE user set  address= '$_POST[address]',
                                    gender= '$_POST[gender]',
                                    birthday= '$_POST[birthday]', 
                                    phone= '$_POST[phone]',
                                    email= '$_POST[email]' 
                                    WHERE id_user='$_POST[id_user]'";                           
        if($conn -> query($query_update) === TRUE)
        {
            echo '<script type = "text/javascript"> alert("Data Update"); history.go(-1); </script>';
        }
        else
        {
            echo '<script type = "text/javascript"> alert("Data Error"); history.go(-1); </script>';
        }
    }
?>