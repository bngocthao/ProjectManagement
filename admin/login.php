<?php

	if(isset($_POST['submit_login']))
	{
		require_once('./dbh.php');
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$result = $conn->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
		if($result->num_rows>0)
		{
			$row = $result->fetch_assoc();
			setcookie('login_user', $row['id_user'] , 0, '/');
			header('Location: ./index002.php');
		}else{
			setcookie('thongbao_login', 'Sai tài khoản hoặc mật khẩu!', time()+3, '/');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="admin/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
	<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<span class="login100-form-title p-b-37">
				Sign In
			</span>
			<?php	
				if(isset($_COOKIE['thongbao_login'])){
					echo "<p style='color:red'>".$_COOKIE['thongbao_login']."</p>";
				}
			?>
			<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username">
				<input class="input100" type="text" name="username" placeholder="username" required>
				<span class="focus-input100"></span>
			</div>

			<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
				<input class="input100" type="password" name="password" placeholder="password" required>
				<span class="focus-input100"></span>
			</div>

			<div class="container-login100-form-btn">
				<button class="login100-form-btn" name="submit_login" value="loggedin">
					Sign In
				</button>
			</div>
		</div>
	</div>
</form>	
	

<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>