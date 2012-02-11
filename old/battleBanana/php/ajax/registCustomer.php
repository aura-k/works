<?
	session_start();
	if(!$_SESSION['ID']){
		echo("login");
		return;
	}

	include "../../php/connect.php";
	
	if(!$_POST['title']){
		echo("title");
		return;
	}else if(!$_POST['text']){
		echo("text");
		return;
	}
	
	$str = "INSERT INTO `BBanana_qnas` (`qna_title`, `user_id`, `qna_created`, `qna_text`) 
	VALUES('".$_POST['title']."', '".$_SESSION['ID']."', '".mktime()."', '".$_POST['text']."');";

$sql = mysql_query($str) or die(mysql_error()); 
$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
if (!$sql) echo "f";

  ?>