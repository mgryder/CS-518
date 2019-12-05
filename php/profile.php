<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php'; 
	require 'vendor/autoload.php';
 
	session_start();
	$client = Elasticsearch\ClientBuilder::create()->build();
	
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

		$table = "accounts2";
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
		$sql = "SELECT id FROM $table where user = '$uid'";
		$query_result = $conn->query($sql);
		while ($line = $query_result->fetch_assoc()) {
			foreach ($line as $cell) {
				$id=$cell;
			}
		}
		if(isset($_GET['id']))
		{
			//echo "Delete<br>";
			$delete=$_GET['id'];
			$sql="DELETE FROM games WHERE id=$id AND gameId=$delete";
			//echo $sql;
			$query_result = $conn->query($sql) or die( "SQL Query ERROR. Link can not be deleted.");
		}
		if(isset($_POST['link']))
		{
			//echo "I'm here";
			$link=$_POST['link'];
			$saveLink="INSERT INTO games VALUES ('$id', '$link')";
			$query_result = $conn->query($saveLink) or die( "SQL Query ERROR. Link can not be saved.");
		}
		$sql = "SELECT game, gameId FROM games where id = '$id'";

        $query_result = $conn->query($sql);
        if (!$query_result) {
            echo "Query is wrong: $sql";
            die;
        }
		echo "<br>";
		echo "<table border=1>";
		echo "<tr>";
			
		echo "<th>Link</th>";
		echo "<th>Game</th>";
		echo "<th>Platform</th>";
		echo "<th>Genre</th>";
		echo "<th>Remove</th>";
		echo "</tr>";
			
		while ($line = $query_result->fetch_assoc()) {
			echo "<tr>\n";
			$c=1;
			foreach ($line as $cell) {
				if($c==1)
				{
					echo "<td> <a href='$cell'>$cell</a></td>";
				}
				else
				{
					$params=[
						'index' => 'games',
						'id' => $cell
					];
					$docs=$client->get($params);
					$name=$docs['_source']['name'];
					$cat=$docs['_source']['genres'];
					$plat=$docs['_source']['platforms'];
					echo "<td>$name</td>";
					echo "<td>$plat</td>";
					echo "<td>$cat</td>";
					echo "<td><a href='profile.php?id=$cell'>Delete</a></td>";
				}
				$c++;
			}
			echo "</tr>\n";
		}
		echo "</table>";
		echo "<br>";
		
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
		<!--<form action="" method="post">
			Paste link: <input type="text" name="link">
			<input type="submit" value="save">
		</form>-->
	</body>	
</html>

