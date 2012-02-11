<? 

include "../../php/checkAdmin.php";
include "../../php/connect.php";

$currentTime = mktime();

$str = "SELECT `item_price`,`item_fname`,`item_expired` FROM `BBanana_items` WHERE `item_id` = '".$_POST['item']."'";
$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql);

$time_gap = $row['item_expired']-$currentTime;
if($time_gap <= 0){//time_gap이 0초 이하이면 경매를 할수 없게 하고 스크립트 종료
	message("이미 종료된 경매 입니다.");
	return;
}
$sql_re=mysql_query("select sum(auto_banana) as auto_banana from BBanana_autobids where bider_id='".$_POST['uid']."' group by bider_id") or die(mysql_error());
$row_re=mysql_fetch_array($sql_re);
if($row_re && $row_re['auto_banana'] != 0){
	message("이미 진행중인 다른 경매가 있습니다.");
	return;
}
$str2 = "SELECT banana from `BBanana_users` WHERE user_id = '".$_POST['uid']."'";
$sql2 = mysql_query($str2) or die(mysql_error()); 
$row2 = mysql_fetch_array($sql2);

if(intval($row2['banana']) < $_POST['banana']){//바나나가 0개이면 입찰할수 없고 스크립트 종료
	message("바나나가 부족합니다.");
	return;
}
//////////////////////  여기서부터 새값에 대한 수정, 입력 SQL이 시작된다. //////////////////////
$sql3=mysql_query("select * from BBanana_autobids where item_id='".$_POST['item']."' and bider_id='".$_POST['uid']."'") or die(mysql_error());
$row3=mysql_fetch_array($sql3);

$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
$result = @mysql_query('BEGIN');
$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

if(!$row3){
	$query = "INSERT INTO `BBanana_autobids`(`bider_id`, `item_id`, `auto_banana`, `auto_created`, `bider_ipnum`) 
			VALUES('".$_POST['uid']."', '".$_POST['item']."', ".$_POST['banana'].", '".$currentTime."', '".$_POST['ip']."');";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	$query = "UPDATE `BBanana_users` SET `banana`= `banana` - ".$_POST['banana']." WHERE `user_id`='".$_POST['uid']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	$query = "INSERT INTO `BBanana_bananas`(`user_id`, `current_banana`, `action_date`, `item_id`, `comment`) VALUES('".$_POST['uid']."', '".intval($row2['banana'])."', '".mktime()."', '".$_POST['item']."_auto', '".$row['item_fname']."');";
	$result = mysql_query($query);
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}else if($row3['auto_banana'] == 0){
	$query = "UPDATE `BBanana_autobids` SET `auto_banana`='".$_POST['banana']."', `auto_created`='".$currentTime."', `bider_ipnum`='".$_POST['ip']."' WHERE `bider_id`='".$_POST['uid']."' AND `item_id`='".$_POST['item']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

	$query = "UPDATE `BBanana_users` SET `banana`= `banana` - ".$_POST['banana']." WHERE `user_id`='".$_POST['uid']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

	$query = "INSERT INTO `BBanana_bananas`(`user_id`, `current_banana`, `action_date`, `item_id`, `comment`) VALUES('".$_POST['uid']."', '".intval($row2['banana'])."', '".mktime()."', '".$_POST['item']."_auto', '".$row['item_fname']."');";
	$result = mysql_query($query);
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}else{
	message("이미 있는 경매 입니다.");
	return;
}

if(!$okFlag){
	$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
	echo("fail");
}else{
	 $result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	if($_POST['banana'] == 0) GoTo("오토배틀을 취소 하셨습니다.", "../manage_user_ipnum.html?sid=".$_POST['uid']);
	else GoTo("오토배틀을 신청하셨습니다.", "../manage_user_ipnum.html?sid=".$_POST['uid']);
}
?>