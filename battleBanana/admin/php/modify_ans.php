<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	
	$str = "UPDATE `BBanana_qnas` SET 
	`qna_answer` =  '".$_POST['answer']."',
	`ans_created` = '".mktime()."'
	WHERE no =  '".$_POST['no']."';";

$sql = mysql_query($str) or die(mysql_error()); 
$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
if (!$sql) echo "f";
  ?>