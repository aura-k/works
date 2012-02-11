<? 
session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 
if(!$_SESSION['ID']){
	echo("login!");
	return;
}else if($_POST['comp_option'] != "del"){
	echo("login!");
	return;
}else{

$str = "SELECT * from `BBanana_users` WHERE user_id = '".$_SESSION['ID']."'";
$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql); 

if($row){
	$str2 = "INSERT INTO `BBanana_drops`(
				`user_id`, `user_name`, `regi_number`, `address`, `password`, `email`, `created`, `deleted`, `banana`, `comment`
			 )VALUES(
				'".$row['user_id']."',
				'".$row['user_name']."',
				'".$row['regi_number']."',
				'".$row['address']."',
				'".$row['password']."',
				'".$row['email']."',
				'".$row['created']."',
				'".mktime()."',
				'".$row['banana']."',
				'".$_POST['complain']."'
			 );";
	$sql2 = mysql_query($str2) or die(mysql_error());

	$str3 = "UPDATE BBanana_users SET activate = 'no' WHERE user_id = '".$_SESSION['ID']."'";
	$sql3 = mysql_query($str3) or die(mysql_error());
}

if(!$sql3){ 
    echo("fail!");
}else if($sql3){ 
	$result = @mysql_query($BATTLEBANANA_ACTION);
	echo("del!");
}else{
	echo("fail!");
}
mysql_close($connect);

}
?>