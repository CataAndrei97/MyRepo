<?php
	include('db_connection.php');
	
	// Please specify your Mail Server - Example: mail.yourdomain.com.
	//ini_set("SMTP","mail.YourDomain.com");

	// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
	//ini_set("smtp_port","25");

	// Please specify the return address to use
	//ini_set('sendmail_from', 'ValidEmailAccount@YourDomain.com');
	
	if(isset($_POST) & !empty($_POST)){
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$sql = "SELECT * FROM mygametable WHERE Name = '$name'";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if($count == 1){
			echo "Send email to user with password";
			log_file("Send email to user with password");
			$r = mysqli_fetch_assoc($res);
			$password = $r['Password'];
			$to = $r['Email'];
			$subject = "Your Recovered Password";

			$message = "Please use this password to login " . $password;
			$headers = "From : me@example.com";
			if(mail($to, $subject, $message, $headers)){
				echo "Your Password has been sent to your email id";
				log_file("Your Password has been sent to your email id");
			}else{
				echo "Failed to Recover your password, try again";
				log_file("Failed to Recover your password, try again");
			}

		}else{
			echo "User name does not exist in database";
			log_file("User name does not exist in database");
		}
	}
?>