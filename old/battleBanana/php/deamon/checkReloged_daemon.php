<?
if( getenv("REMOTE_ADDR") == "127.0.0.1" )
{
	include "../connect.php"; //디비 정의 페이지 

	$browse_info = substr($_SERVER['HTTP_USER_AGENT'],50, 20);
	//비정상 종료되어 기록이 남아있는경우 5분 이전것은 삭제 한다.
	$str = strtotime("-20 minutes");
	$date5 = date("Y-m-d H:i:s", $str);
	
	$loginTime = date("Y-m-d H:i:s");
	$deleteR = mysql_query("delete from BBanana_logins where log_date < '".$date5."'");

	mysql_close($connect);
}
?>