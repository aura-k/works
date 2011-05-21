<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";

	if($_POST['uid'] != ""){
		$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
		$result = @mysql_query('BEGIN');
		$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

		$str1  = "delete from `BBanana_favorites` where user_id='".$_POST['uid']."'";
		$str2  = "delete from `BBanana_winners` where user_id='".$_POST['uid']."'";
		$str3  = "delete from `BBanana_autobids` where bider_id='".$_POST['uid']."'";
		$str4  = "delete from `BBanana_users` where user_id='".$_POST['uid']."'";
		$str5  = "delete from `BBanana_drops` where user_id='".$_POST['uid']."'";
		$str6  = "UPDATE `BBanana_bids` SET `bider_id` = '".$_POST['uid']."(del)' WHERE `bider_id` = '".$_POST['uid']."';";
		$str7  = "UPDATE `BBanana_bananas` SET `user_id` = '".$_POST['uid']."(del)' WHERE `user_id` = '".$_POST['uid']."';";
		$str8  = "UPDATE `BBanana_qnas` SET `user_id` = '".$_POST['uid']."(del)' WHERE `user_id` = '".$_POST['uid']."';";
		$str9  = "UPDATE `BBanana_ships` SET `user_id` = '".$_POST['uid']."(del)' WHERE `user_id` = '".$_POST['uid']."';";
		$str10 = "UPDATE `BBanana_items` SET `item_lastbider` = '".$_POST['uid']."(del)' WHERE `item_lastbider` = '".$_POST['uid']."';";
		
		$result = mysql_query($str1) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str2) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str3) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str4) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str5) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str6) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str7) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str8) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str9) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$result = mysql_query($str10) or die(mysql_error()); 
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;


		if(!$okFlag){
			$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
			else "false";
		}else{
			$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
			 echo "true";
		}
	}else{
		echo "false";
	}
	mysql_close($connect);
 ?>