<?php
	include('log_fct.php');

// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:mysqlserverwebapp.database.windows.net,1433; Database = twdatabase", "sql", "Aa12345678");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "sql", "pwd" => "Aa12345678", "Database" => "twdatabase", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:mysqlserverwebapp.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

	if (!$conn) {
		log_file("Connection failed: " . mysqli_connect_error());
		die("Connection failed: " . mysqli_connect_error());
	} else {
		log_file("You are now connected to database!");
	}
?>
