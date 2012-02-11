<?
	session_start();
	if(!$_SESSION['ID']){
		echo("login");
		return;
	}

	include "../../php/connect.php";
	$str = "SELECT * FROM BBanana_qnas WHERE no = '".$_POST['no']."' and user_id = '".$_SESSION['ID']."'";
	$sql = mysql_query($str) or die(mysql_error()); 
	$row=mysql_fetch_array($sql);
	if($row){
		if($row['qna_answer']){
			echo "ans";
			return;
		}
	}else{
		echo "none";
		return;
	}

	$str = "DELETE FROM BBanana_qnas WHERE no = '".$_POST['no']."' and user_id = '".$_SESSION['ID']."'";

$sql = mysql_query($str) or die(mysql_error()); 
$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
if (!$sql) echo "f";

mysql_close($connect);
  ?>