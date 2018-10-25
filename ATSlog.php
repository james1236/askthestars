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
$questionName = 'q';
$openName = 'open';

//Get/Check UUID
if (!isset($_POST[$uuidName])) {
	die();
} else {
	$uuid = $_POST[$uuidName];
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
	if (isset($_POST[$yesNoName])) {
		if ($_POST[$yesNoName] == "yes") {
			$appendText = $appendText . "yes-";
		} else {
			$appendText = $appendText . "no-";
		}
	}
	if (isset($_POST[$cheatName])) {
		$appendText = $appendText . "cheat-";
	}
	if (isset($_POST[$infoName])) {
		$appendText = $appendText . "info-";
	}
	if (isset($_POST[$rateName])) {
		$appendText = $appendText . "rate-";
	}
	if (isset($_POST[$openName])) {
		$appendText = $appendText . "open-";
	}
	if (isset($_POST[$questionName])) {
		$appendText = $appendText . stripslashes(htmlspecialchars($_POST[$questionName])) . "-";
	}
	
	date_default_timezone_set('<ENTER TIMEZONE HERE>');
	$current_date = date('d/m/Y == H:i:s');
	
	$dateTime = $_POST[$dateTimeName];
	
	$logHandle = fopen($logFileName, "a"); 
	fwrite($logHandle,"\r\n".$uuid.'@'.$dateTime.'#'.$current_date.$appendText.','); 
	userSpecificMessages($uuid);
	die();
}

function userSpecificMessages($testUuid) {
	if ((int)$testUuid == "0635878096") {
		//max 1234567890123456789012345
		die("*usm example");
	}
}

?>
