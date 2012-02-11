<?
	include "logFn.php";

	$no	= $_GET['no'];

	switch($no) {
		case 1:
			$log	= "248";
			break;
		case 2:
			$log	= "249";
			break;
	}

	writeLog($log);
?>