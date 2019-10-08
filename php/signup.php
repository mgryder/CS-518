<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php';

	session_start();
	$errorMessage = 'Create a user account';
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';

	if (isset($_POST['txtUserId']) && isset($_POST['txtPassword']) && isset($_POST['retxtPassword'])) {

		$loginUserId = $_POST['txtUserId'];
		$loginPassword = $_POST['txtPassword'];
		$reLoginPassword = $_POST['retxtPassword'];
		$email = $_POST['email'];
		
		if ($loginPassword == $reLoginPassword) 
		{
            $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
		
			$userTable = "accounts"; 

			$ps = md5($loginPassword);

			$sql = "INSERT INTO $userTable VALUES ('$email', '$loginUserId', '$ps')";
		
            $query_result = $conn->query($sql) or die( "SQL Query ERROR. User can not be created.");

			header('Location: login.php');
			exit;
		} 
		else 
		{
			$errorMessage = "Passwords do not match";
		}
	}
?>

<html>
	<head>
		<title>Sign-in</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body>
		<Strong> <?php echo $errorMessage ?> </Strong>

		<form action="" method="post" name="frmLogin" id="frmLogin">
		 <table width="300" border="1" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		   <td width="150">Email Address</td>
		   <td><input name="email" type="text" id="email"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">Username</td>
		   <td><input name="txtUserId" type="text" id="txtUserId"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">Password</td>
		   <td><input name="txtPassword" type="password" id="txtPassword"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">Retype Password</td>
		   <td><input name="retxtPassword" type="password" id="retxtPassword"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">&nbsp;</td>
		   <td><input name="btnLogin" type="submit" id="btnLogin" value="Sign Up"></td>
		  </tr>
		 </table>
		</form>
	</body>
</html>