<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php';
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';
	
    if(isset($_POST['newPass']) && isset($_POST['newPass2']))
	{
		$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
	
		$oldPass=md5($_POST['oldPass']);
		$pass = $_POST['newPass'];
		$pass2 = $_POST['newPass2'];
		$passEnc=md5($pass);
		if($pass!=$pass2)
		{
			echo "passwords do not match";
		}
		else
		{
			$sql = "UPDATE accounts2 SET pass='$passEnc' WHERE pass = '$oldPass'";
			echo "$sql";
			$conn->query($sql);
			$conn->close();
			header('Location: login.php');
			exit;
		}
	}
?>
<html>
	<head>
		<title>Change Password</title>
	</head>
	<body>
		<form action="" method="post">
			Old password: <input type="password" name="oldPass">
			New password: <input type="password" name="newPass">
			Retype new password: <input type="password" name="newPass2">
			<input type="submit" value="Change password">
		</form>
	</body>
</html>