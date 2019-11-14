<?php
	require 'authentication.php';
	
	session_start();
	$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
	$userTable = "results";
	$id=$_GET['id'];
	$sql = "SELECT name FROM results where id = '$id'";
	$doc = $conn->query($sql);
	if ($doc) {
        while ($line = $doc->fetch_assoc()) {
			foreach ($line as $cell) {			
					$name=$cell;
			}
		}
    }
	echo '<header style="background-color:red; height:10%">
			  <h1>'.$name.'</h1>
		  </header>';
	$sql = "SELECT cat FROM results where id = '$id'";
	$doc = $conn->query($sql);
	if ($doc) {
        while ($line = $doc->fetch_assoc()) {
			foreach ($line as $cell) {			
					$cat=$cell;
			}
		}
    }
	$sql = "SELECT plat FROM results where id = '$id'";
	$doc = $conn->query($sql);
	if ($doc) {
        while ($line = $doc->fetch_assoc()) {
			foreach ($line as $cell) {			
					$plat=$cell;
			}
		}
    }
	echo $name." is a video game made for these platforms: ".$plat." and falls under these genres: ".$cat;
?>