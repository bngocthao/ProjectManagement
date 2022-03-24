<?php
	setcookie('login_user','' , time()-10, '/');
    header('Location: ./login.php');
?>