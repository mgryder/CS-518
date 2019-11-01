<?php
	require 'vendor/autoload.php';
	
	$client = Elasticsearch\ClientBuilder::create()->build();
	
	echo '<header style="background-color:green; height:10%">
			  <h1>Gryder Gaming Database</h1>
		  </header>
		  <form action="index.php" method="post">
			  <input type="submit" value="home">
		  </form><br>';
		  
	if (isset($_POST['name'])&&isset($_POST['id'])&&isset($_POST['cat'])&&isset($_POST['plat']))
	{
		$name=$_POST['name'];
		$id=$_POST['id'];
		$cat=$_POST['cat'];
		$plat=$_POST['plat'];
		$params = [
			'index' => 'games',
			'id' => $id,
			'body' => ['name' => $name,
						'genres' => $cat,
						'platforms' => $plat]
		];
		$response=$client->index($params);
		print_r($response);
	}
?>
<html>
	<head>
		<title>Add</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body>
		<form action="" method="post" name="add" id="add">
		 <table width="300" border="1" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		   <td width="150">Name</td>
		   <td><input name="name" type="text" id="name"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">Id</td>
		   <td><input name="id" type="text" id="id"></td>
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
		   <td><input name="btnLogin" type="submit" id="btnLogin" value="Submit"></td>
		  </tr>
		 </table>
		</form>
	</body>
</html>