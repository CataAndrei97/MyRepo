<?php
	session_start();
	include('db_connection.php');
	$sql = "SELECT * FROM posts";
	$params = array();
	
	$res = sqlsrv_query($conn, $sql, $params);

	$row_count = sqlsrv_num_rows( $res );
	
	if($row_count) {
		while($row = sqlsrv_fetch_array( $res)) {
			$_SESSION["message"] = $row["date"]. " : " . $row["name"]. " " ." say: " . $row["msg"]."<br>";
			echo $_SESSION["message"];
		}
	}
	
 	sqlsrv_close($conn);	
?>
