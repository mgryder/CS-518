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
		  <form action="" method="post">
			Search here: <input type="text" name="keywords">
			<input type="submit" value="search">
		  </form>';
	if(isset($_POST["keywords"]))
	{	
		$keywords=filter_var($_POST["keywords"], FILTER_SANITIZE_STRING);
		echo 'Results for: ', $keywords, '<br><br>';
		$params = [
			'index' => 'games',
			'body' => [
				'query' => [
					'match' => [
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
			$result[$i]=$response['hits']['hits'][$i]['_source'];
			$i++;
		}
		if(empty($result))
		{
			echo "No results found";
		}
		else
		{
			$clearTable="TRUNCATE TABLE results";
			$query_result=$conn->query($clearTable) or die("Unable to clear table");
			foreach($result as $key => $value)
			{
				//echo "contains: ", $_POST["keywords"], "<br>";
				$name=$value['name'];
				$cat=$value['genres'];
				$plat=$value['platforms'];
				$sql = "INSERT INTO $userTable VALUES (NULL, '$name', '$cat', '$plat')";
				//echo "$sql";
			$query_result = $conn->query($sql) or die( "SQL Query ERROR. Result can not be retrieved.");
			}
		}
	}
	if(isset($_GET['keywords']))
	{
		$keywords=$_GET['keywords'];
		echo 'Results for: ', $keywords, '<br><br>';
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
		$sql = "SELECT id, name, cat, plat FROM results where id = '$i'";
		$doc = $conn->query($sql);
		if ($doc) {
            while ($line = $doc->fetch_assoc()) {
				echo "<br>";
				$c=1;
				echo "contains: ", $keywords, "<br>";
				foreach ($line as $cell) {
					if($c==1)
					{
						echo "<a href='doc.php?id=$cell'>Follow link</a><br>";
					}
					else
					{
						echo "$cell<br>";
					}
					$c++;
				}
			}
        }
		$i++;
	}
	echo "<br><a href='{$_SERVER['PHP_SELF']}?page=1&keywords=$keywords'>First</a>
		<a href='{$_SERVER['PHP_SELF']}?page=$prev&keywords=$keywords'>Prev</a>
		<a href='{$_SERVER['PHP_SELF']}?page=$next&keywords=$keywords'>Next</a>";
	
	
	//print_r($response);
?>
<html>
	<head>
		<title>Results Page</title>
	</head>
	<body>
		
	</body>
</html>