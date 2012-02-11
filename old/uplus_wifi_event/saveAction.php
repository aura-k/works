<?
	include "dbConfig.php";

	$tcodeVal = "105";
	$emailVal	= $_POST[email];
	$ipAddr = $_SERVER[REMOTE_ADDR];
	$nowDate = date("Y-m-d H:i:s");

	$query = "SELECT COUNT(nid) as cnt FROM EVENT_USRLOG WHERE email = '$emailVal' AND tcode = '$tcodeVal'";
	$result = mssql_query($query);
	$row = mssql_fetch_array($result);

	if($row[cnt] > 0) {
		echo("re");
		return;
	}else {
		$query = "INSERT INTO EVENT_USRLOG (tcode, ipaddr, email, regdate) VALUES ('$tcodeVal', '$ipAddr', '$emailVal','$nowDate')";
		mssql_query($query);
		echo("ok");
		return;
	}

	mssql_close($dbconnect);
?>