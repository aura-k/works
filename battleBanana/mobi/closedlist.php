<?
	include "./php/m_connect.php";
	session_start(); 
	include "./php/m_functions.php";

	if($_GET['num'] != null && $_GET['json'] != null){
		echo('{"page": '.remain_closed_page($_GET['num']).', "data": "'.closed_pagenation($_GET['num'],'none').'"}');
	}else if($_GET['num'] != null){
		echo closed_pagenation($_GET['num'],'none');
	}
?>