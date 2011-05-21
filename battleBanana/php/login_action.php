<? 
session_cache_limiter(''); 
session_start(); 
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 

$insert_id = $_POST[id];
$re_login = "no";
$browse_info = substr($_SERVER['HTTP_USER_AGENT'],50, 20);

$sql=mysql_query("select * from BBanana_users where user_id='".$insert_id."' && password=old_password('".$_POST[pass]."') && activate != 'no'") or die(mysql_error()); 
$row=mysql_fetch_array($sql); //아이디와 패스워드가 일치하는 사용자가 없으면...(입력된 사용자가 없으면) 메세지를 뿌린다. 
if(!$row) echo("{\"result\":0}");
else { 
	$str = "select * from BBanana_logins where log_id = '".$insert_id."';";
	$sql2 = mysql_query($str) or die(mysql_error()); 
	$row2 = mysql_num_rows($sql2);

	if($row2 == 0){
		$sql3=mysql_query("Insert into BBanana_logins(log_id, log_ip, log_agent, log_ok, log_date) values('".$insert_id."', '".$REMOTE_ADDR."', '".$browse_info."', '1', '".date("Y-m-d H:i:s")."')") or die(mysql_error());
	}else if($row2 == 1){
		$row_find = mysql_fetch_assoc($sql2);
		if($row_find[log_ip] == $REMOTE_ADDR && $row_find[log_agent] == $browse_info){
			$update_sql = mysql_query("UPDATE BBanana_logins SET log_date = '".date("Y-m-d H:i:s")."' where log_id = '".$insert_id."'") or die(mysql_error());
		}else{
			$re_login = "yes";
			$update_sql = mysql_query("UPDATE BBanana_logins SET log_ip = '".$REMOTE_ADDR."', log_agent = '".$browse_info."', log_date = '".date("Y-m-d H:i:s")."' where log_id = '".$insert_id."'") or die(mysql_error());
		}
	}else if($row2 > 1){
		$re_login = "yes";
		$update_sql = mysql_query("DELETE FROM BBanana_logins WHERE log_id = '".$insert_id."'") or die(mysql_error());
	}

	$_SESSION["NO"] = $row[no]; 
	$_SESSION["ID"] = $row[user_id]; 
	$_SESSION["NAME"] = $row[user_name]; 
	$_SESSION["JUMIN"] = $row[regi_number]; 
	$_SESSION["ADDRESS"] = $row[address]; 
	$_SESSION["EMAIL"] = $row[email]; 
	$_SESSION["CREATED"] = $row[create]; 
	$_SESSION["MODIFIED"] = $row[modified];
	$_SESSION["BANANA"] = $row[banana];
	$_SESSION["A"] = $row[isAdm];
	$new_cnt = $row[cnt] + 1;

	$sql=mysql_query("UPDATE BBanana_users SET cnt =  '".$new_cnt."', ipnum = '".$REMOTE_ADDR."', lately_loged = '".date("Y-m-d H:i:s", mktime())."' WHERE user_id='".$insert_id."';") or die(mysql_error());
	$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	include "loginSessionAction.php";

	echo("{\"result\":1,
		   \"relogin\": \"".$re_login."\",
		   \"menu1Button\": \"".$menu1Button."\",
		   \"menu2Button\": \"".$menu2Button."\",
		   \"battleButton\": \"".$battleButton."\",
		   \"battleEndButton\": \"".$battleEndButton."\",
		   \"rewardButton\": \"".$rewardButton."\"
		  }");
} 
mysql_close($connect);
?>
