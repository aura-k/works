<?
	include "dbConfig.php";
	$query = "DELETE FROM EVENT_USRLOG WHERE tcode=105";
	mssql_query($query);
?>