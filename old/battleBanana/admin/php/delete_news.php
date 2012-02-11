<?	
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";

	if($_POST['no']){
		$str = "DELETE from `BBanana_news` where  no='".$_POST['no']."'";
		$sql = mysql_query($str) or die(mysql_error()); 
		
		if(!$sql){ 
			echo("삭제실패");
		}else{
			$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
			echo("삭제성공!!");
		}
		mysql_close($connect);
	}
?>