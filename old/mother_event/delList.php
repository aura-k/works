<?
	include "dbConfig.php";
	$query = "DELETE FROM EVENT_USRLOG WHERE tcode=119";
	mssql_query($query);
?>