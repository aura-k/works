<? 
session_cache_limiter(''); 
session_start(); 
include "connect.php"; //디비 정의 페이지
include "sess_func.php"; //로그아웃 

$update_sql = mysql_query("DELETE FROM BBanana_logins WHERE log_id = '".$_SESSION['ID']."'") or die(mysql_error());
session_unregister(ID); 
session_destroy(); 
mysql_close($connect);

GoTo("로그아웃 하셨습니다.","../html/main.html"); 
?> 