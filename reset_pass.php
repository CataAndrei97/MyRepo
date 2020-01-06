<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="reset_pass.css" />	
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<?php
		include('test_input_fct.php');
		include('db_connection.php');
		$emailErr = "";
		$email = "";
		$contor = $err_cont = 0;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

		if($contor == 1) {
			$sql = "UPDATE mygametable SET Password='$new_pass' WHERE Email='$email';";

			if (mysqli_query($conn, $sql)) {
				log_file("Record updated successfully");
			} else {
				$err_cont++;
				log_file("Error updating record: " . mysqli_error($conn));
			}

			if($err_cont == 0) {
				log_file("Pass the reset password");
				header("Location:index.php");
			}

			log_file("You are now disconnected from database!");
			mysqli_close($conn);
		}
	?>
	<body background="astroneer_xbox_01.png">
		<h1> Reset password page</h1>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  						
			E-mail: <input type="text" name="email" value="<?php echo $email;?>">
				<span class="error">* <?php echo $emailErr;?></span>
				<br><br>
				
				<input type="submit" name="submit" value="Reset password">  
		</form>
	</body>
</html>