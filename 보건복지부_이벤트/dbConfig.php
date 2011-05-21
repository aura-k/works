<?
	$host = "192.168.20.106";
	$usrid = "Log_User";
	$usrpwd = "xxxx";
	$dbName = "TAGTVDB";

	$dbconnect = mssql_connect($host, $usrid, $usrpwd) or die("���� ����"); ;
	mssql_select_db($dbName, $dbconnect);
?>