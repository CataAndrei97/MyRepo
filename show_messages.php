<?php
	session_start();
	include('db_connection.php');
	$sql = "SELECT * FROM posts";
	
	$res = $conn->query($sql);
	
	if($res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$_SESSION["message"] = $row["date"]. " : " . $row["name"]. " " ." say: " . $row["msg"]."<br>";
			echo $_SESSION["message"];
		}
	}
	
	$conn->close();
?>