<?php
	//written using example code provided by Professor Jian Wu
	
	$server = "localhost";
	$sqlUsername = "admin";
	$sqlPassword = "monarchs";
	$databaseName = "cs518";
			
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

	function authenticateUser($connection, $username, $password)
	{ 
	  $userTable = "accounts"; 

	  if (!isset($username) || !isset($password))
	  {
		return false;
	  }

	  $pa = md5($password);  
	  
	  $sql = "SELECT * FROM $userTable WHERE user = '$username' AND pass = '$pa'";
	  
      $query_result = $connection->query($sql);
      if (!$query_result) 
	  {
          echo "Sorry, query is wrong";
          echo $sql;
      }

      $nrows = $query_result->num_rows;
	  if ( $nrows != 1)
	  {
		return false;
	  }
	  else
	  {
		return true;
	  }
	}

?>
