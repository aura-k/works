<?	
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";

	if($_POST['sid'] && $_POST['uid'] && $_POST['status']){
		$str = "SELECT * from `BBanana_ships` WHERE user_id = '".$_POST['uid']."' and item_id = '".$_POST['sid']."'";
		$sql = mysql_query($str) or die(mysql_error()); 
		$row = mysql_fetch_array($sql);

		if(!$row){
			echo("none");
			return;
		}

 		$sql2=mysql_query("UPDATE `BBanana_ships` SET ship_status = '".$_POST['status']."' WHERE user_id = '".$_POST['uid']."' and item_id = '".$_POST['sid']."'") or die(mysql_error());
		
		if(!$sql2){ 
		   echo("none");
		}else if($sql2){ 
			$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
			echo("ok");
		}else{
			echo("none");
		}
		mysql_close($connect);
	}
?>