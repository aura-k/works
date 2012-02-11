<? 
$localhost="localhost"; 
$user_id="ID"; //디비 접근 아이디 
$user_passwd="PASS"; //디비 접근 패스워드 
$db_name="DBNAME"; //접근할 디비 이름 //mysql 에 접속하기 위한 구문... 이 파일을 테이블에 접근할 페이지에 include 하여 사용한다. 
$connect=mysql_connect($localhost,$user_id,$user_passwd) or die("SQL server에 연결할수 없습니다.");
mysql_select_db($db_name,$connect); 
mysql_query("set names utf8");
?>