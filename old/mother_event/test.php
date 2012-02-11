<?
	/*

	if($nowDatetime >= 0 || $nowDatetime <= 9){
		echo("불가능!");
		return;
	}
		echo($nowDatetime);	*/

	include "dbConfig.php";
	$nowDate = date("Ymd");
	//$query = "SELECT Convert(varchar(19),regdate,23) as reg FROM EVENT_USRLOG WHERE phone = '01034882873' AND chk1 = '0' AND tcode = '119'";

	$query = "SELECT COUNT(nid) as cnt2 FROM EVENT_USRLOG WHERE chk1 = '0' AND tcode = '119' AND Convert(varchar(8),regdate,112) = '$nowDate'";
	$result = mssql_query($query);
	$row1 = mssql_fetch_array($result);
	
	echo($row1[cnt2]);

	/*if($row1[reg] != null && $row1[reg] < 7) echo "당첨";	
	$query = "INSERT INTO EVENT_USRLOG (tcode, name, ipaddr, phone, chk1, regdate) VALUES ('119', 'test', 'auto', '010111111111', '0', '2011-10-26')";
	$change_query = iconv('UTF-8', 'EUC-KR', $query);
	mssql_query($change_query);*/

	mssql_close($dbconnect);
?>