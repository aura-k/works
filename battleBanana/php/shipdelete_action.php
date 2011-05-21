<? 
session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 
if(!$_SESSION['ID'] && !$_POST['ship_sid']){
	echo("login!");
	return;
}else{

$str = "SELECT * from `BBanana_ships` WHERE user_id = '".$_SESSION['ID']."' and item_id = '".$_POST['ship_sid']."'";
$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql);

if(!$row){
	echo("login!");
	return;
}else if($row['ship_status'] != "00"){
	echo("exp!");
	return;
}

$str2 = "update `BBanana_ships` set is_cancel='wait' where user_id='".$_SESSION['ID']."' and item_id='".$_POST['ship_sid']."'";
$sql2 = mysql_query($str2) or die(mysql_error());

if(!$sql || !$sql2){ 
    echo("fail!");
}else if($sql && $sql2){ 
	$result = @mysql_query("COMMIT");
	echo("shipdel!");
}else{
	echo("fail!");
}
mysql_close($connect);

}
?>