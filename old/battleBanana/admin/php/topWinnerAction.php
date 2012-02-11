<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	
	if($_POST['uid'] != "" && $_POST['rates'] != "" && $_POST['item_id'] != ""){
		$sql=mysql_query("select item_fname from BBanana_items where item_id = '".$_POST['item_id']."'") or die(mysql_error());
		$row=mysql_fetch_array($sql);

		$str2 = "INSERT INTO `BBanana_winners`(`user_id`, `rates`, `item_id`, `item_name`) 
			VALUES('".$_POST['uid']."',
			'".$_POST['rates']."',
			'".$_POST['item_id']."',
			'".$row['item_fname']."');";
		$sql2 = mysql_query($str2) or die(mysql_error());
		$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
		if($sql2) echo "true";
	}else{
		echo "false";
	}
	
	mysql_close($connect);
 ?>