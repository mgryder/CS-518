<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php';
	
	session_start();
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';
	
	if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] != true) 
	{
		header('Location: login.php');
		exit;
	}
	else 
	{
        if(isset($_POST['newEmail']))
		{
			$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

			$uid = $_SESSION['userID'];
			$email = $_POST['newEmail'];
			$sql = "UPDATE accounts SET email='$email' WHERE user = '$uid'";
			$conn->query($sql);
			$conn->close();
			header('Location: profile.php');
			exit;
		}
	}
?>
<html>
	<head>
		<title>Update email</title>
	</head>
	<body>
		<form action="" method="post">
			New email: <input type="text" name="newEmail">
			<input type="submit" value="Change email">
		</form>
	</body>
</html>