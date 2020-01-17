<!DOCTYPE HTML>  
<html>
	<head>
		<meta charset="utf-8"/>	
		<link rel="stylesheet" href="login.css" />	
		<style>
			.error {color: #FF0000;

                   

			}
		</style>
		<title>Login</title>
	</head>
	
	<body background="space.png">  


		<?php
			session_start();
			include('test_input_fct.php');
			include('db_connection.php');
			$nameErr = $passErr = "";
			$name = $pass = "";
			$contor = $err_cont = 0;

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["name"])) {
					$nameErr = "Name is required";
					$err_cont++;
					log_file($nameErr);
				} else {
					$name = test_input($_POST["name"]);
					
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
						$nameErr = "Only letters and white space allowed";
						log_file($nameErr);
						$err_cont++;
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
						log_file($passErr);
						$err_cont++;
					} else {
						$contor++;
					}
				}
			}
		
			if($contor == 2) {				
				$sql = "SELECT Name, Password FROM mygametable WHERE Name='$name' AND Password='$pass'";
			    	$params = array();
    				$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			 	$stmt = sqlsrv_query( $conn, $sql , $params, $options );
				
				$row_count = sqlsrv_num_rows( $stmt );
				if ($row_count) {
					log_file("You are logged in");
				} else {
					log_file("Invalid Name or Password");
					$err_cont++;
				}
				
				if(!$err_cont) {
					log_file("Pass the loggin");
					
					$_SESSION["name"] = $name;
					
					header("Location:home.php");
				}

				log_file("You are now disconnected from database!");
				sqlsrv_close($conn);
			}
		?>

		<h2>Login window:</h2>
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Name: <input type="text" name="name" value="<?php echo $name;?>">
				<span class="error">* <?php echo $nameErr;?></span>
				<br><br>
				
			Password: <input type="password" name="pass" value="<?php echo $pass;?>">
				<span class="error">* <?php echo $passErr;?></span>
				<br><br>
				
			<input type="submit" name="submit" value="Login">  
		</form>
		<br>

		<form method="post" action="index.php">
			<input type="submit" name="submit" value="Go back">  
		</form>

	</body>
</html>
