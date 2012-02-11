<? 
session_cache_limiter(''); 
session_start(); 
require_once "../config.php";
include "connect.php"; //디비 정의 페이지 

$idVal = trim(preg_replace("/\|/", "", $_POST['id']));
$pwVal = trim(preg_replace("/\|/", "", $_POST['pw']));

$sql=@mysql_query("select * from lotte_member where userid='".$idVal."' && userpw='".$pwVal."'") or die(mysql_error()); 
$row=mysql_fetch_array($sql);

if(($idVal == $row['userid']) && ($pwVal == $row['userpw'])){
	$url = '../index.php';
	$_SESSION["ID"] = $row['userid']; 
	$_SESSION["AREA"] = iconv("EUC-KR","UTF-8", $row['area']);
	$_SESSION["ADMIN"] = $row['admin']; 
}else{
	$url = '../login.php';
}
echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
?>
