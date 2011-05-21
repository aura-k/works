<?
	include "./php/m_connect.php";
	session_start(); 
	include "./php/m_functions.php";

	if($_GET['num'] != null && $_SESSION['ID']){
		echo('{"page": '.remain_banana_page($_GET['num']).', "data": "'.banana_pagenation($_GET['num'],'none').'"}');
	}
?>