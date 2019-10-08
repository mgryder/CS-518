<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php';
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';
	
	if(isset($_POST['email']))
	{
		$conn=new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
		$email=$_POST['email'];
		$sql="SELECT * FROM accounts WHERE email='$email'";
		$result=$conn->query($sql);
		if(!$result)
		{
			echo "invalid email";
		}
		else
		{
			$nrows = $result->num_rows;
			if ( $nrows != 1)
			{
				echo "invalid email";
			}
			else
			{
				header('Location: changePass.php');
				exit;
			}
		}
	}
	
	
?>
<html>
	<head>
		<title>Reset Password</title>
	</head>
	<body>
		<form action="" method="post">
			Enter email: <input type="text" name="email">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>