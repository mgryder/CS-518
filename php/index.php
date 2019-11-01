<?php
	//written using example code provided by Professor Jian Wu
	
	session_start();
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';
	
	if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] != true) 
	{
		echo '<form action="signup.php" method="post">
				<input type="submit" value="Sign Up">
			  </form> 
			  <form action="login.php" method="post">
				<input type="submit" value="Login">
			  </form>';
	} 
	else 
	{
		 echo "Welcome ",$_SESSION['userID'], "!";
		 echo '<form action="profile.php" method="post">
				<input type="submit" value="Profile">
			  </form>';
	}
?>
<html>
	<head>
		<title>Gryder Gaming Database</title>
	</head>
	<body>
		<form action="search.php" method="post">
			Search here: <input type="text" name="keywords">
			<input type="submit" value="search">
		</form>
		<form action="advanced.php" method="post">
			<input type="submit" value="advanced search">
		</form>
		<form action="addDoc.php" method="post">
			<input type="submit" value="add">
		</form>
	</body>
</html>