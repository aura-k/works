<? 
session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 
if(!$_SESSION['ID'] && !$_POST['ship_adress'] && !$_POST['ship_phone1'] && !$_POST['ship_phone2'] && !$_POST['ship_phone3'] && !$_POST['ship_comment'] && !$_POST['ship_name'] && !$_POST['ship_sid']){
	echo("login!");
	return;
}else if($_POST['ship_option'] != "modi"){
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

$str2 = "update `BBanana_ships` set address='".$_POST['ship_adress']."', phone_num1='".$_POST['ship_phone1']."', phone_num2='".$_POST['ship_phone2']."', phone_num3='".$_POST['ship_phone3']."', comment='".$_POST['ship_comment']."', ship_name='".$_POST['ship_name']."' where user_id='".$_SESSION['ID']."' and item_id='".$_POST['ship_sid']."'";
$sql2 = mysql_query($str2) or die(mysql_error());

if(!$sql || !$sql2){ 
    echo("fail!");
}else if($sql && $sql2){ 
	$result = @mysql_query("COMMIT");
	echo("shipmodi!");
}else{
	echo("fail!");
}
mysql_close($connect);

}
?>