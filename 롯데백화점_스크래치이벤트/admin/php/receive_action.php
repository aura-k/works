<? 
	include "checkLoged.php";
	include "connect.php"; //디비 정의 페이지
	
	if($_POST['sc_codeVal'] != ""){
		$str = "select * from `lotte_code` where code='".$_POST['sc_codeVal']."'";
		$sql = mysql_query($str) or die(mysql_error()); 
		$row=mysql_fetch_array($sql);
		if(!$row) echo("인계처리 실패");
		else{
			$str = "UPDATE `lotte_code` SET receive = 'yes' where code = '".$row['code']."'";
			$sql = mysql_query($str) or die(mysql_error());
			echo("인계처리 성공");
		}
	}
	mysql_close($connect);
?>