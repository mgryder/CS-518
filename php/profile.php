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
        $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

		$table = "accounts";
		$uid = $_SESSION['userID'];
		$sql = "SELECT email, user FROM $table where user = '$uid'";

        $query_result = $conn->query($sql);
        if (!$query_result) {
            echo "Query is wrong: $sql";
            die;
        }

		echo "<table border=1>";
		echo "<tr>";
			
   		while ($fieldMetadata = $query_result->fetch_field()) 
		{
			echo "<th>".$fieldMetadata->name."</th>";
        }
		echo "</tr>";
			
		while ($line = $query_result->fetch_assoc()) {
			echo "<tr>\n";
			foreach ($line as $cell) {
				echo "<td> $cell </td>";
			}
			echo "</tr>\n";
		}
		echo "</table>";
		
        $conn->close();
	}
?>
<html>
	<head>
		<title>Profile</title>
	</head>
	<body>
		<form action="editProfile.php" method="post">
			<input type="submit" value="Update email">
		</form>
		<form action="logout.php" method="post">
			<input type="submit" value="logout">
		</form>
		<form action="index.php" method="post">
			<input type="submit" value="home">
		</form>
	</body>	
</html>

