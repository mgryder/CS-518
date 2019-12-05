<?php
	require 'authentication.php';
	require 'vendor/autoload.php';
	
	session_start();
	$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
	$userTable = "results";
	$client = Elasticsearch\ClientBuilder::create()->build();
	$id=$_GET['id'];
	//$sql = "SELECT name FROM results where id = '$id'";
	//echo $sql;
	//$doc = $conn->query($sql);
	$params=[
			'index' => 'games',
			'id' => $id
	];
	$docs=$client->get($params);
	$name=$docs['_source']['name'];
	$cat=$docs['_source']['genres'];
	$plat=$docs['_source']['platforms'];
	/*if ($doc) {
        while ($line = $doc->fetch_assoc()) {
			foreach ($line as $cell) {			
					$name=$cell;
			}
		}
    }*/
	echo '<header style="background-color:red; height:10%">
			  <h1>'.$name.'</h1>
		  </header>';
	//$sql = "SELECT cat FROM results where id = '$id'";
	//$doc = $conn->query($sql);
	/*if ($doc) {
        while ($line = $doc->fetch_assoc()) {
			foreach ($line as $cell) {			
					$cat=$cell;
			}
		}
    }*/
	//$sql = "SELECT plat FROM results where id = '$id'";
	//$doc = $conn->query($sql);
	/*if ($doc) {
        while ($line = $doc->fetch_assoc()) {
			foreach ($line as $cell) {			
					$plat=$cell;
			}
		}
    }*/
	if(isset($_GET['save']))
	{
		$save=$_GET['save'];
		if($save)
		{
			if (isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] == true)
			{
				$uid = $_SESSION['userID'];
				$sql = "SELECT id FROM accounts2 where user = '$uid'";
				$query_result = $conn->query($sql);
				while ($line = $query_result->fetch_assoc()) {
					foreach ($line as $cell) {
						$user=$cell;
					}
				}
				$sql="INSERT INTO games VALUES ('$user', 'doc.php?id=$id', '$id')";
				//echo $sql;
				$query_result = $conn->query($sql) or die( "SQL Query ERROR. Page can not be saved.");
			}
		}
	}
	echo "<a href='doc.php?id=$id&save=true'>Save Page</a><br>".$name." is a video game made for these platforms: ".$plat." and falls under these genres: ".$cat;
?>