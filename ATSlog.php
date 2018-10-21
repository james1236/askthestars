<?php

//Constants
$logFileName = 'log2.json';

//POST/GET names
$yesNoName = 'yn';
$cheatName = 'cheat';
$infoName = 'info';
$rateName = 'rate';
$uuidName = 'id';
$dateTimeName = 'datetime';

//Get/Check UUID
if (!isset($_GET[$uuidName])) {
	die();
} else {
	$uuid = $_GET[$uuidName];
	if (!ctype_digit($uuid)) {
		die();
	}
	if ((int)$uuid > 1000000000 || (int)$uuid < 0) {
		die();
	}
	if (strlen($uuid) != 10) {
		die();
	}
	
	$appendText = "-";
	if (isset($_GET[$yesNoName])) {
		if ($_GET[$yesNoName] == "yes") {
			$appendText = $appendText . "yes-";
		} else {
			$appendText = $appendText . "no-";
		}
	}
	if (isset($_GET[$cheatName])) {
		$appendText = $appendText . "cheat-";
	}
	if (isset($_GET[$infoName])) {
		$appendText = $appendText . "info-";
	}
	if (isset($_GET[$rateName])) {
		$appendText = $appendText . "rate-";
	}
	
	date_default_timezone_set('<ENTER TIMEZONE HERE>');
	$current_date = date('d/m/Y == H:i:s');
	
	$dateTime = $_GET[$dateTimeName];
	
	$logHandle = fopen($logFileName, "a"); 
	fwrite($logHandle,"\r\n".$uuid.'@'.$dateTime.'#'.$current_date.$appendText.','); 
	fclose ($logHandle); 
	die();
}

?>