<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	include "../../php/charge_action.php";
	
	if($_POST['uid'] != "" && $_POST['amount'] != "" && $_POST['comment'] != ""){
		if(adminChargeAction($_POST['uid'], $_POST['amount'], $_POST['comment'])) echo "true2";
		else echo "false2";
	}else{
		echo "false";
	}
	mysql_close($connect);
 ?>