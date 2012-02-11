<? 
session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 
if(!$_SESSION['ID']){
	echo("login!");
	return;
}else if($_POST['ship_option'] != "ship"){
	echo("login!");
	return;
}else{

$str = "SELECT * from `BBanana_ships` WHERE user_id = '".$_SESSION['ID']."' and item_id = '".$_POST['ship_sid']."'";
$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql);

if($row){
	echo("one!");
	return;
}


$str2 = "INSERT INTO `BBanana_ships`(`item_fname`, `item_id`, `user_id`, `address`, `phone_num1`, `phone_num2`, `phone_num3`, `comment`, `item_price`, `ship_name`, `ship_created`, `ship_type`, `ship_status`) 
VALUES('".$_POST['ship_title']."', '".$_POST['ship_sid']."', '".$_SESSION['ID']."', '".$_POST['ship_adress']."', '".$_POST['ship_phone1']."', '".$_POST['ship_phone2']."', '".$_POST['ship_phone3']."', '".$_POST['ship_comment']."', '".$_POST['ship_price']."', '".$_POST['ship_name']."', '".mktime()."', '".$_POST['ship_type']."', '00');";
$sql2 = mysql_query($str2) or die(mysql_error());

if(!$sql || !$sql2){ 
    echo("fail!");
}else if($sql && $sql2){ 
	$result = @mysql_query("COMMIT");
	echo("shipped!");
}else{
	echo("fail!");
}
mysql_close($connect);

}
?>