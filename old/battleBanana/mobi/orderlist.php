<?
	include "./php/m_connect.php";
	session_start(); 
	include "./php/m_functions.php";

	if($_GET['num'] != null && $_GET['json'] != null && $_SESSION['ID']){
		echo('{"page": '.remain_order_page($_GET['num']).', "data": "'.order_pagenation($_GET['num'],'none').'"}');
	}else if($_GET['num'] != null && $_SESSION['ID']){
		echo order_pagenation($_GET['num'],'none');
	}
?>