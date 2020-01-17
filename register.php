<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="register.css" />		
		<style>
			.error {color: #FF0000;
			}
		</style>
		<title>Register</title>
	</head>
	
	<body background="astroneer-concept-01.png">
		<?php
			include('test_input_fct.php');
			include('db_connection.php');
			
			$nameErr = $passErr = $emailErr = $userExists = "";
			$name = $pass = $email = "";
			$contor = $err_cont = 0;

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["name"])) {
					$nameErr = "Name is required!";
					$err_cont++;
					log_file($nameErr);
				} else {
					$name = test_input($_POST["name"]);
					
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
						$nameErr = "Only letters and white space allowed!";
						$err_cont++;
						log_file($nameErr);
					} else {
						$contor++;
					}
				}

				if (empty($_POST["pass"])) {
					$passErr = "Password is required!";
					$err_cont++;
					log_file($passErr);
				} else {
					$pass = test_input($_POST["pass"]);  
					
					if(!preg_match("/.{8,}/",$pass)) {
						$passErr = "Password is to short, 8 characters are required!";
						$err_cont++;
						log_file($passErr);
					} else {
						$contor++;
					}
				}

				if (empty($_POST["email"])) {
					$emailErr = "Email is required!";
					$err_cont++;
					log_file($emailErr);
				} else {
					$email = test_input($_POST["email"]);
					
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$emailErr = "Invalid email format!"; 
						$err_cont++;
						log_file($emailErr);
					} else {
						$contor++;
					}
				}
			}

			if($contor == 3) {
				$sql = "INSERT INTO mygametable (Name, Password, Email) VALUES ('$name', '$pass', '$email')";

				if (sqlsrv_query($conn, $sql)) {
					log_file("New record created successfully");
				} else {
					if(preg_match("/Duplicate entry/",sqlsrv_errors($conn))) {
						$userExists = "This username already exists!";
						$err_cont++;
						log_file($userExists);
					} else {
						$err_cont++;
						log_file("Error: " . sqlsrv_errors($conn));
					}
				}

				if(!$err_cont) {
					log_file("Pass the register");
					
					$_SESSION["name"] = $name;
					
					header("Location:home.php");
				}

				log_file("You are now disconnected from database!");
				sqlsrv_close($conn);
			}
		?>
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Name: <input type="text" name="name" value="<?php echo $name;?>">
				<span class="error">* <?php echo $nameErr."\n".$userExists;?></span>
				<br><br>
				
			Pass: <input type="password" name="pass" value="<?php echo $pass;?>">
				<span class="error">* <?php echo $passErr;?></span>
				<br><br>
				
			Mail: <input type="text" name="email" value="<?php echo $email;?>">
				<span class="error">* <?php echo $emailErr;?></span>
				<br><br>
				
				<input type="submit" name="submit" value="Register">
		</form>
		<br>
		<form method="post" action="index.php">
			<input type="submit" name="submit" value="Go back">  
		</form>
	</body>
</html>
