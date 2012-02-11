<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	
	if(!$_POST['news_title']){
		message("필요한목록을 모두 작성하세요!!");
		return;
	}

	$str = "UPDATE `BBanana_news` SET 
		news_title = '".$_POST['news_title']."',
		news_text = '".$_POST['ir1']."'
		WHERE no = '".$_POST['no']."';";

$sql = mysql_query($str) or die(mysql_error()); 
$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
if (!$sql) echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><script>alert(\"뉴스 수정 실패\");window.close();</script>";
else echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><script>alert(\"뉴스 수정 성공\");parent.location.reload();window.close();</script>";


  ?>