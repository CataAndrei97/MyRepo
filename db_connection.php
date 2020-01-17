<?php
	include('log_fct.php');
	$dbhost = "mysqlserverwebapp.database.windows.net";
	$dbuser = "sql";
	$dbpass = "Aa12345678";
	$db = "twdatabase";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	if (!$conn) {
		log_file("Connection failed: " . mysqli_connect_error());
		die("Connection failed: " . mysqli_connect_error());
	} else {
		log_file("You are now connected to database!");
	}
?>
