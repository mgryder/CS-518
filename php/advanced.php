<?php
	require 'vendor/autoload.php';
	
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
		$keywords=filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	
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
		foreach($result as $key => $value)
		{
			echo $value['name']."<br>";
			echo $value['genres']."<br>";
			echo $value['platforms']."<br><br>";
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
					'match' => [
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
			$result[$i]=$response['hits']['hits'][$i]['_source'];
			$i++;
		}
		foreach($result as $key => $value)
		{
			echo $value['name']."<br>";
			echo $value['genres']."<br>";
			echo $value['platforms']."<br><br>";
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
					'match' => [
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
			$result[$i]=$response['hits']['hits'][$i]['_source'];
			$i++;
		}
		foreach($result as $key => $value)
		{
			echo $value['name']."<br>";
			echo $value['genres']."<br>";
			echo $value['platforms']."<br><br>";
		}
	
		//print_r($response);
	}
	
?>
<html>
	<head>
		<title>Advanced Search</title>
	</head>
	<body>
		
	</body>
</html>