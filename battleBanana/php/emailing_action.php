<? 
if($_POST['mail']){
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 

	$se_str = "SELECT * from `BBanana_emails` WHERE email = '".trim($_POST['mail'])."'";
	$se_sql = mysql_query($se_str) or die(mysql_error()); 
	$se_row = mysql_fetch_array($se_sql);

	if($se_row){//명단에 있으면
		echo "re";//중복출력 후 종료
		return;
	}

	$query = "INSERT INTO `BBanana_emails`(`email`, `ipnum`, `reg_date`) VALUES('".trim($_POST['mail'])."', '".$REMOTE_ADDR."', '".mktime()."');";
	$sql=mysql_query($query) or die(mysql_error());
	$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	echo "clear";

mysql_close($connect);
}
?>
