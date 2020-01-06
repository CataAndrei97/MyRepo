<?php
	session_start();
	include('db_connection.php');
	$msg = $_POST["msg"];
	$name = $_SESSION["name"];
	
	$sql = "INSERT INTO posts(msg, name) VALUES('$msg','$name')";
	$conn->query($sql);
	
	$conn->close();
	
	header('Location:home.php');
?>