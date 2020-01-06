<!DOCTYPE HTML>  
<html>
	<head>
		<meta charset="utf-8"/>	
		<link rel="stylesheet" href="forgot_pass.css" />	
		<style>
			.error {color: #FF0000;}
		</style>
		<title>Forgot password</title>
	</head>
	
	<body background="astroneer.png">
		<form method="POST" action="send_forgotten_pass.php">
			Name: <input type="text" name="name">
			</form>
			<br>
			<form>
			<input type="submit" name="forgot_pass" value="Forgot password"> 
			</form>
	</body>
</html>