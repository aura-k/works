<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	include "../../php/charge_action.php";
	
	if(substr($_POST['tid'],0,1) == "B"){
		$str = "SELECT * from `BBanana_ships` WHERE order_num = '".$_POST['tid']."'";
		$sql = mysql_query($str) or die(mysql_error()); 
		$row = mysql_fetch_array($sql);

		if($row == true){
			if(cancelAction($row['user_id'], $row['charged_banana'])) echo "true";
			else echo "false";
		}else{
			echo "false";
		}
	}else if($_POST['uid'] != "" && $_POST['amount'] != ""){
		if(cancelAction($_POST['uid'], $_POST['amount'])) echo "true2";
		else echo "false2";
	}else{
		echo "false";
	}
	mysql_close($connect);
 ?>