<? 
session_cache_limiter(''); 
session_start(); 
include "m_connect.php"; //디비 정의 페이지 
include "m_sess_func.php"; //함수 정의 페이지 include 

$sql=mysql_query("select * from BBanana_users where user_id='".$_POST[id]."' && password=old_password('".$_POST[pass]."') && activate != 'no'") or die(mysql_error()); 
$row=mysql_fetch_array($sql); //아이디와 패스워드가 일치하는 사용자가 없으면...(입력된 사용자가 없으면) 메세지를 뿌린다. 
if(!$row) echo("none");
else { 
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

$sql=mysql_query("UPDATE BBanana_users SET cnt =  '".$new_cnt."', ipnum = '".$REMOTE_ADDR."', lately_loged = '".date("Y-m-d H:i:s", mktime())."' WHERE user_id='".$_POST[id]."';") or die(mysql_error());
$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
//include "loginSessionAction.php";

echo("ok");
} 
mysql_close($connect);
?>