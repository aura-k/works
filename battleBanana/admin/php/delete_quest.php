<?	
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";

	if($_POST['no']){
		$str = "DELETE from `BBanana_qnas` where  no='".$_POST['no']."'";
		$sql = mysql_query($str) or die(mysql_error()); 
		$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
		if(!$sql) echo("f");
		mysql_close($connect);
	}
?>