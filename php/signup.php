<?php
	//written using example code provided by Professor Jian Wu
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require 'vendor\autoload.php';
	
	require 'authentication.php';

	session_start();
	$errorMessage = 'Create a user account';
	
	echo '<header style="background-color:green; height:10%">
			<h1>Gryder Gaming Database</h1>
		</header>';

	if (isset($_POST['txtUserId'])) {

		//echo 'Im here';
		$loginUserId = $_POST['txtUserId'];
		$loginPassword = '1234';
		$email = $_POST['email'];
		
        $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
		
		$userTable = "accounts"; 

		$ps = md5($loginPassword);
		$sql="SELECT * FROM accounts WHERE email='$email'";
		$result=$conn->query($sql);
		if(!$result)
		{
			$mail = new PHPMailer(TRUE);
			try
			{
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure='ssl';
				$mail->Host='smtp.gmail.com';
				$mail->Port=465;
				$mail->Username='chesschamptwo@gmail.com';
				$mail->Password='Gameday6';
				//echo 'Im here<br>';
				$mail->setFrom('doNotReply@gryderGaming.com', 'Gryder Gaming');
				//echo 'Im here<br>';
				$mail->addAddress($email, $loginUserId);
				//echo 'Im here<br>';
				$mail->Subject = 'Sign Up';
				//echo 'Im here<br>';
				$mail->Body = 'Verification Code: 1234';
				//echo 'Im here<br>';
				$mail->send();
				//echo 'Im here<br>';
			}
			catch(Exception $e)
			{
				echo $e->errorMessage();
			}
			catch(\Exception $e)
			{
				echo $e->getMessage();
			}
			
			echo '<form action="" method="post" name="verify" id="verify">
			Enter Verification Code: <input name="code" type="text" id="code">
			<input name="submit" type="submit" id="submit" value="Submit">
			</form>';
						
			$sql2 = "INSERT INTO $userTable VALUES ('$email', '$loginUserId', '$ps')";
		
			$query_result = $conn->query($sql2) or die( "SQL Query ERROR. User can not be created.");
				
			header('Location: login.php');
			exit;
		}
		else
		{
			$nrows = $result->num_rows;
			if ( $nrows != 1)
			{
				$mail = new PHPMailer(TRUE);
				try
				{
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure='ssl';
					$mail->Host='smtp.gmail.com';
					$mail->Port=465;
					$mail->Username='chesschamptwo@gmail.com';
					$mail->Password='Gameday6';
					//echo 'Im here<br>';
					$mail->setFrom('doNotReply@gryderGaming.com', 'Gryder Gaming');
					//echo 'Im here<br>';
					$mail->addAddress($email, $loginUserId);
					//echo 'Im here<br>';
					$mail->Subject = 'Sign Up';
					//echo 'Im here<br>';
					$mail->Body = 'Password: 1234';
					//echo 'Im here<br>';
					$mail->send();
					//echo 'Im here<br>';
				}
				catch(Exception $e)
				{
					echo $e->errorMessage();
				}
				catch(\Exception $e)
				{
					echo $e->getMessage();
				}
								
				echo '<form action="" method="post" name="verify" id="verify">
				Enter Verification Code: <input name="code" type="text" id="code">
				<input name="submit" type="submit" id="submit" value="Submit">
				</form>';
					
				$sql2 = "INSERT INTO $userTable VALUES ('$email', '$loginUserId', '$ps')";
		
				$query_result = $conn->query($sql2) or die( "SQL Query ERROR. User can not be created.");
			
				header('Location: login.php');
				exit;
			}
			else
			{
				echo 'Duplicate email';
			}
		}
	}
?>

<html>
	<head>
		<title>Sign-in</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body>
		<Strong> <?php echo $errorMessage ?> </Strong>

		<form action="" method="post" name="frmLogin" id="frmLogin">
		 <table width="300" border="1" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		   <td width="150">Email Address</td>
		   <td><input name="email" type="text" id="email"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">Username</td>
		   <td><input name="txtUserId" type="text" id="txtUserId"></td>
		  </tr>
		  
		  <!--<tr>
		   <td width="150">Password</td>
		   <td><input name="txtPassword" type="password" id="txtPassword"></td>
		  </tr>
		  
		  <tr>
		   <td width="150">Retype Password</td>
		   <td><input name="retxtPassword" type="password" id="retxtPassword"></td>
		  </tr>-->
		  
		  <tr>
		   <td width="150">&nbsp;</td>
		   <td><input name="btnLogin" type="submit" id="btnLogin" value="Sign Up"></td>
		  </tr>
		 </table>
		</form>
	</body>
</html>