<? 
session_cache_limiter(''); 
session_start(); 
include "../../php/define_battle.php";
include "m_connect.php"; //디비 정의 페이지 
include "m_sess_func.php"; //함수 정의 페이지 include 
if(!$_SESSION['ID']){
	echo("로그인 후 이용해주세요.");
	return;
}
if($_POST['sid']){
$currentTime = mktime();//현재 서버 시간을 불러와서
$auto_banana = intval($_POST['auto_bids']);//오토로 놓을 바나나 수
if($auto_banana == 0){//입력값이 0개이면 입찰할수 없고 스크립트 종료
	echo("none");
	return;
}

$str = "SELECT `item_price`,`item_fname`,`item_expired` FROM `BBanana_items` WHERE `item_id` = '".$_POST['sid']."'";
$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql);

$time_gap = $row['item_expired']-$currentTime;
if($time_gap <= 0){//time_gap이 0초 이하이면 경매를 할수 없게 하고 스크립트 종료
	echo("이미 종료된 경매 입니다.");
	return;
}
$sql_re=mysql_query("select sum(auto_banana) as auto_banana from BBanana_autobids where bider_id='".$_SESSION['ID']."' group by bider_id") or die(mysql_error());
$row_re=mysql_fetch_array($sql_re);
if($row_re && $row_re['auto_banana'] != 0){
	echo("이미 진행중인 다른 경매가 있습니다.");
	return;
}

$str2 = "SELECT banana from `BBanana_users` WHERE user_id = '".$_SESSION['ID']."'";
$sql2 = mysql_query($str2) or die(mysql_error()); 
$row2 = mysql_fetch_array($sql2);

if(intval($row2['banana']) < $auto_banana){//바나나가 0개이면 입찰할수 없고 스크립트 종료
	echo("lack!");
	return;
}

//////////////////////  여기서부터 새값에 대한 수정, 입력 SQL이 시작된다. //////////////////////
$sql3=mysql_query("select * from BBanana_autobids where item_id='".$_POST['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
$row3=mysql_fetch_array($sql3);

$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
$result = @mysql_query('BEGIN');
$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

if(!$row3){
	$query = "INSERT INTO `BBanana_autobids`(`bider_id`, `item_id`, `auto_banana`, `auto_created`, `bider_ipnum`, `is_mobile`) 
			VALUES('".$_SESSION['ID']."', '".$_POST['sid']."', ".$auto_banana.", '".$currentTime."', '".$REMOTE_ADDR."', 'yes');";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	$query = "UPDATE `BBanana_users` SET `banana`= `banana` - ".$auto_banana." WHERE `user_id`='".$_SESSION['ID']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	$query = "INSERT INTO `BBanana_bananas`(`user_id`, `current_banana`, `action_date`, `item_id`, `comment`) VALUES('".$_SESSION['ID']."', '".intval($row2['banana'])."', '".mktime()."', '".$_POST['sid']."_auto', '".$row['item_fname']."');";
	$result = mysql_query($query);
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}else if($row3['auto_banana'] == 0){
	$query = "UPDATE `BBanana_autobids` SET `auto_banana`='".$auto_banana."', `auto_created`='".$currentTime."', `bider_ipnum`='".$REMOTE_ADDR."', `is_mobile` = 'yes' WHERE `bider_id`='".$_SESSION['ID']."' AND `item_id`='".$_POST['sid']."'";
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
}/*else{
	$query = "UPDATE `BBanana_autobids` SET `auto_banana`='".$auto_banana."', `auto_created`='".$currentTime."', `bider_ipnum`='".$REMOTE_ADDR."' WHERE `bider_id`='".$_SESSION['ID']."' AND `item_id`='".$_POST['sid']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

	$query = "UPDATE `BBanana_users` SET `banana`='".( intval($row2['banana']) + (intval($row3['auto_banana']) - $auto_banana) )."' WHERE `user_id`='".$_SESSION['ID']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}*/


if(!$okFlag){
	$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
	echo("fail");
}else{
	 $result = @mysql_query($BATTLEBANANA_ACTION);//모두 성공하면 Commit.
	if($auto_banana == 0) echo("오토배틀을 취소하셨습니다.");
	else echo("오토배틀을 신청하셨습니다. 해당 바나나가 자동으로 차감됩니다.");
}

/*if(!$sql || !$sql2 || !$sql3 || !$sql4 || !$sql5 || !$sql6){ 
    echo("fail");
}else if($sql && $sql2 && $sql3 && $sql4 && $sql5 && $sql6){ 
	if($auto_banana == 0) echo("오토배틀을 취소하셨습니다.");
	else echo("오토배틀을 신청하셨습니다. 해당 바나나가 자동으로 차감됩니다.");
}else{
	echo("fail");
}*/
mysql_close($connect);
}else{
	echo("입력오류! 입력값을 확인해주세요.");
}
?>