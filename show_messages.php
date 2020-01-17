<?php
	session_start();
	include('db_connection.php');
	$sql = "SELECT * FROM posts";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_query( $conn, $sql , $params, $options );

	$row_count = sqlsrv_num_rows( $stmt );
	
	if($row_count) {
		while($row = sqlsrv_fetch_array( $stmt)) {
			$_SESSION["message"] = $row["date"]. " : " . $row["name"]. " " ." say: " . $row["msg"]."<br>";
			echo $_SESSION["message"];
		}
	}
	
 	sqlsrv_close($conn);	
?>
