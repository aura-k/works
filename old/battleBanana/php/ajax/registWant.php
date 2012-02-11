<?
	session_start();
	if(!$_SESSION['ID']){
		echo("login");
		return;
	}

	include "../../php/connect.php";
	
	if(!$_POST['want']){
		echo("want");
		return;
	}else if(!$_POST['option']){
		echo("option");
		return;
	}
	
	$str = "INSERT INTO `BBanana_farms` (`URL`, `farm_type`, `user_id`, `reg_date`) VALUES('".$_POST['want']."', '".$_POST['option']."', '".$_SESSION['ID']."', '".mktime()."');";

	$sql = mysql_query($str) or die(mysql_error()); 
	$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	if (!$sql) echo "f";
	else echo "ok";
mysql_close($connect);
  ?>