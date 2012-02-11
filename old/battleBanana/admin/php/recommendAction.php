<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	include "../../php/charge_action.php";
	include "../../php/define_battle.php";

	$comment = $_POST['uid']." 님의 추천";

	$str2 = "SELECT * from `BBanana_users` WHERE user_id = '".$_POST['uid']."' and is_reco = 'yes'";
	$sql2 = mysql_query($str2) or die(mysql_error()); 
	$row2 = mysql_fetch_array($sql2);
	if($row2){
		echo "repeat";
		return;
	}
	$str3 = "SELECT * from `BBanana_users` WHERE user_id = '".$_POST['recid']."'";
	$sql3 = mysql_query($str3) or die(mysql_error()); 
	$row3 = mysql_fetch_array($sql3);
	if(!$row3){
		echo "null";
		return;
	}

	if($_POST['uid'] != "" && $_POST['recid'] != ""){
		if(adminChargeAction($_POST['recid'], RECOMMEND, $comment)){
			$str = "UPDATE `BBanana_users` SET `is_reco` = 'yes' WHERE `user_id` = '".$_POST['uid']."';";
			$sql = mysql_query($str) or die(mysql_error()); 
			$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
			echo "true";
			return;
		}else echo "false";
	}else{
		echo "false";
	}
	mysql_close($connect);
 ?>