<? 
	session_cache_limiter(''); 
	session_start(); 
	include "define_battle.php";
	include "checkLoged.php";
	include "connect.php"; //디비 정의 페이지
	
	$str = "select * from `BBanana_users` where user_id='".$_SESSION['ID']."' and password=old_password('".$_POST['original_pass']."');";
	$sql = mysql_query($str) or die(mysql_error()); 
	$row=mysql_fetch_array($sql);
	if(!$row) echo("fail");
	else{
		if($_POST['signup_pass'] == '')
			$str = "UPDATE `BBanana_users` SET email = '".$_POST['email']."', modified = '".date('Y-m-d H:i:s', mktime())."' where user_id = '".$_SESSION['ID']."';";
		else if($_POST['email'] == '')
			$str = "UPDATE `BBanana_users` SET password = old_password('".$_POST['signup_pass']."'), modified = '".date('Y-m-d H:i:s', mktime())."' where user_id = '".$_SESSION['ID']."';";
		else
			$str = "UPDATE `BBanana_users` SET password = old_password('".$_POST['signup_pass']."'), email = '".$_POST['email']."', modified = '".date('Y-m-d H:i:s', mktime())."' where user_id = '".$_SESSION['ID']."';";
		$sql = mysql_query($str) or die(mysql_error());
		$result = @mysql_query($BATTLEBANANA_ACTION);
		echo "사용자 정보가 올바르게 바뀌었습니다.\n새로 수정된 패스워드로 재 로그인 후 사용하여 주세요.";
		session_unregister(ID); 
		session_destroy(); 
	}
	mysql_close($connect);
?>