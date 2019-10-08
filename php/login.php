<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php';

	session_start();
	$errorMessage = '';
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';

	if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
		$loginUserId = $_POST['txtUserId'];
		$loginPassword = $_POST['txtPassword'];
		
        $connection = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
		
		if (authenticateUser($connection, $loginUserId, $loginPassword))
		{	
			$_SESSION['db_is_logged_in'] = true;
			$_SESSION['userID'] = $loginUserId;
			
			header('Location: index.php');
			exit;
		} else {
			$errorMessage = 'Wrong username or password';
		}
	}
?>

<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<Strong> <?php echo $errorMessage ?> </Strong>
		Don't have an account? <a href="signup.php">Sign up here</a>.
		<br>
		Forgot password? <a href="editPass.php">Reset password</a>
		<form action="" method="post" name="frmLogin" id="frmLogin">
			 <table width="400" border="1" align="center" cellpadding="2" cellspacing="2">
				  <tr>
					<td width="150">User ID</td>
					<td><input name="txtUserId" type="text" id="txtUserId"></td>
				  </tr>
				  <tr>
					<td width="150">Password</td>
					<td><input name="txtPassword" type="password" id="txtPassword"></td>
				  </tr>
				  <tr>
					<td width="150">&nbsp;</td>
					<td><input name="btnLogin" type="submit" id="btnLogin" value="Login"></td>
				  </tr>
			 </table>
		</form>
	</body>
</html>
