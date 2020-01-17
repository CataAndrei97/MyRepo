<?php
	include('log_fct.php');
	$dbhost = "10.10.69.111";
	$dbuser = "root";
	$dbpass = "";
	$db = "twdatabase";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	if (!$conn) {
		log_file("Connection failed: " . mysqli_connect_error());
		die("Connection failed: " . mysqli_connect_error());
	} else {
		log_file("You are now connected to database!");
	}
?>
