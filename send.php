<?php
	session_start();
	include('db_connection.php');
	$msg = $_POST["msg"];
	$name = $_SESSION["name"];
	
	$sql = "INSERT INTO posts(msg, name) VALUES('$msg','$name')";
	sqlsrv_query($conn, $sql);
	
	sqlsrv_close($conn);
	header('Location:home.php');
?>
