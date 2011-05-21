<?	
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";

	if($_POST['tid']){
		$str = "SELECT * from `BBanana_ships` WHERE order_num = '".$_POST['tid']."'";
		$sql = mysql_query($str) or die(mysql_error()); 
		$row = mysql_fetch_array($sql);

		if(!$row){
			echo("none");
			return;
		}

 		$sql2=mysql_query("UPDATE `BBanana_ships` SET item_id = '".$row['item_id']."_cancel', is_cancel = 'grant' WHERE order_num = '".$_POST['tid']."'") or die(mysql_error());
		
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