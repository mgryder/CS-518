<?php
	require 'vendor/autoload.php';
	
	$client = Elasticsearch\ClientBuilder::create()->build();
	
	$keywords=filter_var($_POST["keywords"], FILTER_SANITIZE_STRING);
	
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
	
	echo '<header style="background-color:green; height:10%">
			  <h1>Gryder Gaming Database</h1>
		  </header>
		  <form action="index.php" method="post">
			  <input type="submit" value="home">
		  </form>
		  <form action="" method="post">
			Search here: <input type="text" name="keywords">
			<input type="submit" value="search">
		  </form>
		  Results for: ', $keywords, '<br><br>';
	foreach($result as $key => $value)
	{
		echo $value['name']."<br>";
		echo $value['genres']."<br>";
		echo $value['platforms']."<br><br>";
	}
	
	//print_r($response);
?>
<html>
	<head>
		<title>Results Page</title>
	</head>
	<body>
		
	</body>
</html>