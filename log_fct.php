<?php
	function log_file($log) {
		$text = date("d/m/Y")." '$log' ".PHP_EOL;
		file_put_contents('logfile.txt', $text, FILE_APPEND);
	}
?>