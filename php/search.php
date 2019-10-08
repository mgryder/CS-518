<html>
	<head>
		<title>Results Page</title>
	</head>
	<body>
		<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>
		Results for:
		<?php
			echo $_POST["keywords"];
		?>
		<form action="index.php" method="post">
			<input type="submit" value="home">
		</form>
	</body>
</html>