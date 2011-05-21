<? 
include "../define_battle.php";
include "../connect.php"; //디비 정의 페이지 
include "../sess_func.php"; //함수 정의 페이지 include 

//////////////////////  여기서부터 새값에 대한 수정, 입력 SQL이 시작된다. //////////////////////
$sql3=mysql_query("select * from BBanana_autobids where item_id='".$_POST['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
$row3=mysql_fetch_array($sql3);

$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
$result = @mysql_query('BEGIN');
$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

if(!$row3){
	$query = "INSERT INTO `BBanana_autobids`(`bider_id`, `item_id`, `auto_banana`, `auto_created`, `bider_ipnum`) 
			VALUES('".$_SESSION['ID']."', '".$_POST['sid']."', ".$auto_banana.", '".$currentTime."', '".$REMOTE_ADDR."');";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	$query = "UPDATE `BBanana_users` SET `banana`= `banana` - ".$auto_banana." WHERE `user_id`='".$_SESSION['ID']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	$query = "INSERT INTO `BBanana_bananas`(`user_id`, `current_banana`, `action_date`, `item_id`, `comment`) VALUES('".$_SESSION['ID']."', '".intval($row2['banana'])."', '".mktime()."', '".$_POST['sid']."_auto', '".$row['item_fname']."');";
	$result = mysql_query($query);
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}else if($row3['auto_banana'] == 0){
	$query = "UPDATE `BBanana_autobids` SET `auto_banana`='".$auto_banana."', `auto_created`='".$currentTime."', `bider_ipnum`='".$REMOTE_ADDR."' WHERE `bider_id`='".$_SESSION['ID']."' AND `item_id`='".$_POST['sid']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

	$query = "UPDATE `BBanana_users` SET `banana`= `banana` - ".$auto_banana." WHERE `user_id`='".$_SESSION['ID']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

	$query = "INSERT INTO `BBanana_bananas`(`user_id`, `current_banana`, `action_date`, `item_id`, `comment`) VALUES('".$_SESSION['ID']."', '".intval($row2['banana'])."', '".mktime()."', '".$_POST['sid']."_auto', '".$row['item_fname']."');";
	$result = mysql_query($query);
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}else{
	echo "repeat";
	return;
}
?>