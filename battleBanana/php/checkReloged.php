<?
if($_SESSION['ID']){
	$sess_id = $_SESSION['ID'];
	$browse_info = substr($_SERVER['HTTP_USER_AGENT'],50, 20);
	//비정상 종료되어 기록이 남아있는경우 5분 이전것은 삭제 한다.
	$str = strtotime("-5 minutes");
	$date5 = date("Y-m-d H:i:s", $str);
	
	$loginTime = date("Y-m-d H:i:s");
	$deleteR = mysql_query("delete from BBanana_logins where log_date < '".$date5."'");
	////////////////////중복 로그인 체크..

	$str = "select * from BBanana_logins where log_id = '".$sess_id."'";
	$sql2 = mysql_query($str) or die(mysql_error()); 
	$row2 = mysql_num_rows($sql2);

	if($row2 == 0){//아무곳에서도 로그인 되어있지 않음.
		$sql3=mysql_query("Insert into BBanana_logins(log_id, log_ip, log_agent, log_ok, log_date) values('".$sess_id."', '".$REMOTE_ADDR."', '".$browse_info."', '1', '".date("Y-m-d H:i:s")."')") or die(mysql_error());
	}else if($row2 == 1){//로그인 정보가 있을때..
		$row_find = mysql_fetch_assoc($sql2);
		if($row_find[log_ip] == $REMOTE_ADDR && $row_find[log_agent] == $browse_info){
			$update_sql = mysql_query("UPDATE BBanana_logins SET log_date = '".date("Y-m-d H:i:s")."' where log_id = '".$sess_id."'") or die(mysql_error());
		}else{//아이피가 같지 않을때 중복로그인이므로 차단.
			if($row_find[log_id] != "admin"){
				session_unregister(ID); 
				session_destroy(); 
				GoTo('다른 IP나 브라우저에 해당 아이디가 중복 로그인 되었습니다!', '../html/main.html');
				return;
			}
		}
	}else if($row2 > 1){//해당 아이디의 로그인 정보가 1개 이상이면 로그인 정보 이상이므로 모두 삭제.
		$update_sql = mysql_query("DELETE FROM BBanana_logins WHERE log_id = '".$sess_id."'") or die(mysql_error());
	}
}
?>