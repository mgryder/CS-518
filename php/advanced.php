<?php
	require 'vendor/autoload.php';
	
	require 'authentication.php';
	
	session_start();
	$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
	$userTable = "results";
	$client = Elasticsearch\ClientBuilder::create()->build();
	
	echo '<header style="background-color:green; height:10%">
			  <h1>Gryder Gaming Database</h1>
		  </header>
		  <form action="index.php" method="post">
			  <input type="submit" value="home">
		  </form>
		  <form action="" method="post" name="advanced" id="advanced">
			<table width="300" border="1" align="center" cellpadding="2" cellspacing="2">
			<tr>
			 <td width="150">Name</td>
			 <td><input name="name" type="text" id="name"></td>
			</tr>
		  
			<tr>
			 <td width="150">Category</td>
		     <td><input name="cat" type="text" id="cat"></td>
			</tr>
		  
			<tr>
			 <td width="150">Platform</td>
			 <td><input name="plat" type="text" id="plat"></td>
			</tr>
		  
			<tr>
			 <td width="150">&nbsp;</td>
			 <td><input name="btnLogin" type="submit" id="btnLogin" value="Search"></td>
			</tr>
			</table>
		</form>','<br><br>';
	
	if(isset($_POST["name"]))
	{
		$clearTable="TRUNCATE TABLE results";
		$query_result=$conn->query($clearTable) or die("Unable to clear table");
		$keywords=filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	
		$params = [
			'index' => 'games',
			'body' => [
				'query' => [
					'fuzzy' => [
						'name' => $keywords
					]
				]
			]
		];
		$response = $client->search($params);
		$hits=count($response['hits']['hits']);
		$result=null;
		$i=0;
	
		while($i<$hits)
		{
			$result[$i]=$response['hits']['hits'][$i]['_id'];
			$i++;
		}
		if(empty($result))
		{
			echo "No results found for ".$keywords."<br>";
		}
		else
		{
			foreach($result as $key => $value)
			{
				$params=[
					'index' => 'games',
					'id' => $value
				];
				$docs=$client->get($params);
				//echo "contains: ", $_POST["name"], "<br>";
				$name=$docs['_source']['name'];
				$cat=$docs['_source']['genres'];
				$plat=$docs['_source']['platforms'];
				$sql = "INSERT INTO $userTable VALUES (NULL, '$name', '$cat', '$plat', '$value')";
				//echo "$sql";
				$query_result = $conn->query($sql) or die( "SQL Query ERROR. Result can not be retrieved.");
			}
		}
	
		//print_r($response);
	}
	if(isset($_POST["cat"]))
	{
		$keywords=filter_var($_POST["cat"], FILTER_SANITIZE_STRING);
	
		$params = [
			'index' => 'games',
			'body' => [
				'query' => [
					'fuzzy' => [
						'genres' => $keywords
					]
				]
			]
		];
		$response = $client->search($params);
		$hits=count($response['hits']['hits']);
		$result=null;
		$i=0;
	
		while($i<$hits)
		{
			$result[$i]=$response['hits']['hits'][$i]['_id'];
			$i++;
		}
		if(empty($result))
		{
			echo "No results found for ".$keywords."<br>";
		}
		else
		{
			foreach($result as $key => $value)
			{
				$params=[
					'index' => 'games',
					'id' => $value
				];
				$docs=$client->get($params);
				//echo "contains: ", $_POST["cat"], "<br>";
				$name=$docs['_source']['name'];
				$cat=$docs['_source']['genres'];
				$plat=$docs['_source']['platforms'];
				$sql = "INSERT INTO $userTable VALUES (NULL, '$name', '$cat', '$plat', '$value')";
				//echo "$sql";
				$query_result = $conn->query($sql) or die( "SQL Query ERROR. Result can not be retrieved.");
			}
		}
		
	
		//print_r($response);
	}
	if(isset($_POST["plat"]))
	{
		$keywords=filter_var($_POST["plat"], FILTER_SANITIZE_STRING);
	
		$params = [
			'index' => 'games',
			'body' => [
				'query' => [
					'fuzzy' => [
						'platforms' => $keywords
					]
				]
			]
		];
		$response = $client->search($params);
		$hits=count($response['hits']['hits']);
		$result=null;
		$i=0;
	
		while($i<$hits)
		{
			$result[$i]=$response['hits']['hits'][$i]['_id'];
			$i++;
		}
		if(empty($result))
		{
			echo "No results found for ".$keywords."<br>";
		}
		else
		{
			foreach($result as $key => $value)
			{
				$params=[
					'index' => 'games',
					'id' => $value
				];
				$docs=$client->get($params);
				//echo "contains: ", $_POST["plat"], "<br>";
				$name=$docs['_source']['name'];
				$cat=$docs['_source']['genres'];
				$plat=$docs['_source']['platforms'];
				$sql = "INSERT INTO $userTable VALUES (NULL, '$name', '$cat', '$plat', '$value')";
				//echo "$sql";
				$query_result = $conn->query($sql) or die( "SQL Query ERROR. Result can not be retrieved.");
			}
		}
	
		//print_r($response);
	}
	if(!(isset($_GET['page'])))
	{
		//echo "set to one";
		$page=1;
	}
	else
	{
		$page=$_GET['page'];
	}
	if($page<1)
	{
		//echo "set to one";
		$page=1;
	}
	$next=$page+1;
	$prev=$page-1;
	if($prev<1)
	{
		$prev=1;
	}
	$i=$page-1;
	$i=$i*5;
	$i=$i+1;
	$limit=$i+5;
	while($i<$limit)
	{
		$sql = "SELECT id, name, cat, plat, gameId FROM results where id = '$i'";
		$doc = $conn->query($sql);
		if ($doc) {
            while ($line = $doc->fetch_assoc()) {
				echo "<br>";
				$c=1;
				foreach ($line as $cell) {
					if($c==5)
					{
						echo "<a href='doc.php?id=$cell'>Follow link</a><br>";
					}
					else
					{
						if($c>1)
						{
							echo "$cell<br>";
						}
					}
					$c++;
				}
			}
        }
		$i++;
	}
	echo "<br><a href='{$_SERVER['PHP_SELF']}?page=1'>First</a>
		<a href='{$_SERVER['PHP_SELF']}?page=$prev'>Prev</a>
		<a href='{$_SERVER['PHP_SELF']}?page=$next'>Next</a>";
	
	
?>
<html>
	<head>
		<title>Advanced Search</title>
	</head>
	<body>
		
	</body>
</html>