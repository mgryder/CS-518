<?php
	//written using example code provided by Professor Jian Wu
	
	require 'authentication.php';
	
	session_start();
	$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
	
	$clearTable="TRUNCATE TABLE results";
	$query_result=$conn->query($clearTable) or die("Unable to clear table");
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';
	
	if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] != true) 
	{
		echo '<form action="signup.php" method="post">
				<input type="submit" value="Sign Up">
			  </form> 
			  <form action="login.php" method="post">
				<input type="submit" value="Login">
			  </form>';
	} 
	else 
	{
		 echo "Welcome ",$_SESSION['userID'], "!";
		 echo '<form action="profile.php" method="post">
				<input type="submit" value="Profile">
			  </form>';
	}
?>
<html>
	<head>
		<title>Gryder Gaming Database</title>
	</head>
	<body>
		<style>
			.speech {border: 1px solid #DDD; width: 300px; padding: 0; margin: 0}
			.speech input {border: 0; width: 240px; display: inline-block; height: 30px;}
			.speech img {float: right; width: 40px;}
		</style>
		<form id="labnol" method="post" action="search.php">
			<div class="speech">
				<input type="text" name="keywords" id="transcript" placeholder="Speak">
				<img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif">
			</div>
		</form>
		<script>
			function startDictation() {
				if (window.hasOwnProperty('webkitSpeechRecognition')) {
					var recognition=new webkitSpeechRecognition();
					
					recognition.continuous=false;
					recognition.interimResults=false;
					
					recognition.lang="en-US";
					recognition.start();
					
					recognition.onresult=function(e) {
						document.getElementById('transcript').value=e.results[0][0].transcript;
						recognition.stop();
						document.getElementById('labnol').submit();
					};
					
					recognition.onerror=function(e) {
						recognition.stop();
					}
				}
			}
		</script>
		<!--<form action="search.php" method="post">
			Search here: <input type="text" name="keywords">
			<input type="submit" value="search">
		</form>-->
		<form action="advanced.php" method="post">
			<input type="submit" value="advanced search">
		</form>
		<form action="addDoc.php" method="post">
			<input type="submit" value="add">
		</form>
	</body>
</html>