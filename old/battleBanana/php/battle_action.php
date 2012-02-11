<? 
//////////////////(배틀을 처리하는 중요 스크립트!!!! 2010-04-27(By Keen)/////////////////////////////////

// 배틀 주요 프로세스 절차

// 1. 세션값이 없으면 에러 출력 후 스크립트 종료
// 2. 일등여부를 물어보고 1등이면 스크립트 종료
// 3. 보상구매 신청여부 확인 후 명단에 있으면 스크립트 종료(보상구매시 배틀입찰 불가)
// 4. DB에서 아이템 가격, 이름, 종료시간 추출
// 5. (종료시간-서버시간)을 'time_gap'이라고 명명
// 6. time_gap이 0 이하이면 에러 출력 후 스크립트 종료
// 7. time_gap이 15 이하이면 빼온 DB값의 종료시간에 15를 더한다.
// 8. 아이템 값을 20원 올린다.
// 9. 바나나가 하나도 없으면 에러 출력 후 스크립트 종료
// 10. 바나나 갯수를 1개 줄인다.
// 11. 에러사항에 대한 것을 모두 걸러 냈으므로, 위에서 계산했던 내용을 DB에 적용한다.
// 12. DB에 대한 별도의 에러사항이 없으면 '배틀성공'을 출력하고 스크립트 종료.

/////////////////////////////////////////////////////////////////////////////////////////////////////////
session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 
include "checkReloged_battle.php";
if(!$_SESSION['ID']){
	echo("error");
	return;
}
$str_top = "SELECT `item_lastbider` FROM `BBanana_items` WHERE `item_lastbider` = '".$_SESSION['ID']."' and item_id = '".$_POST['sid']."'";//이미 1등인지 아닌지?
$sql_top = mysql_query($str_top) or die(mysql_error()); 
$row_top = mysql_fetch_array($sql_top);
if($row_top){//명단에 있으면
	echo "top";//중복출력 후 종료
	return;
}

$se_str = "SELECT * from `BBanana_ships` WHERE user_id = '".$_SESSION['ID']."' and item_id = '".$_POST['sid']."'";//보상구매 신청여부 확인
$se_sql = mysql_query($se_str) or die(mysql_error()); 
$se_row = mysql_fetch_array($se_sql);

if($se_row){//명단에 있으면
	echo "repeated";//중복출력 후 종료
	return;
}
$currentTime = mktime();//현재 서버 시간을 불러와서

$str = "SELECT `item_price`,`item_fname`,`item_expired` FROM `BBanana_items` WHERE `item_id` = '".$_POST['sid']."'";
$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql);

$time_gap = $row['item_expired']-$currentTime;
if($time_gap <= -1){//time_gap이 0초 이하이면 경매를 할수 없게 하고 스크립트 종료
	echo("이미 종료된 경매 입니다.");
	return;
}else if($time_gap <= 10) $new_expired = intval($row['item_expired']) + TIME_UP;//time_gap이 15초 이하였을때 입찰하면 15초를 늘린다.
else $new_expired = intval($row['item_expired']);

$new_price = intval($row['item_price']) + COIN_UP;//아이템 가격을 20원 올린다.


$str2 = "SELECT banana from `BBanana_users` WHERE user_id = '".$_SESSION['ID']."'";
$sql2 = mysql_query($str2) or die(mysql_error()); 
$row2 = mysql_fetch_array($sql2);

if(intval($row2['banana']) == 0){//바나나가 0개이면 입찰할수 없고 스크립트 종료
	echo("lack!");
	return;
}else{
	$new_banana = intval($row2['banana']) - 1;//입찰하면 바나나의 갯수를 하나 줄인다.
}

//////////////////////  여기서부터 새값에 대한 수정, 입력 SQL이 시작된다. //////////////////////
$str_bids = "SELECT * from `BBanana_view_bids` WHERE item_id='".$_POST['sid']."' AND bider_id = '".$_SESSION['ID']."'";//bids테이블 과부하 방지하기위해 여기다 갱신함
$sql_bids = @mysql_query($str_bids); 
$row_bids = mysql_fetch_array($sql_bids);

if(!$row_bids){
	$query = "INSERT INTO `BBanana_view_bids`(`item_id`, `bider_id`, `bid_count`) VALUES('".$_POST['sid']."', '".$_SESSION['ID']."', 1);";
	$result = @mysql_query($query); 
}else{
	$query = "UPDATE `BBanana_view_bids` SET bid_count=bid_count+1 WHERE item_id='".$_POST['sid']."' AND bider_id='".$_SESSION['ID']."';";
	$result = @mysql_query($query); 
}


$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
$result = @mysql_query('BEGIN');
$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

if( preg_match('/(iphone|android|lgtel|mobile)/i', $_SERVER['HTTP_USER_AGENT']) ) {
    $query = "INSERT INTO `BBanana_bids`(`item_id`, `bider_id`, `bid_time`, `bid_microtime`, `bider_ipnum`, `is_mobile`) 
	VALUES('".$_POST['sid']."', '".$_SESSION['ID']."', '".$currentTime."', '".(_microtime()-$currentTime)."', '".$REMOTE_ADDR."', 'yes');";
	$result = @mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}else{
	$query = "INSERT INTO `BBanana_bids`(`item_id`, `bider_id`, `bid_time`, `bid_microtime`, `bider_ipnum`) 
	VALUES('".$_POST['sid']."', '".$_SESSION['ID']."', '".$currentTime."', '".(_microtime()-$currentTime)."', '".$REMOTE_ADDR."');";
	$result = @mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
}

$query = "UPDATE `BBanana_items` SET `item_lastbider` =  '".$_SESSION['ID']."', `item_expired` = '".$new_expired."', `item_price` =  '".$new_price."' WHERE `item_id` = '".$_POST['sid']."';";
$result = @mysql_query($query); 
if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

$query = "UPDATE `BBanana_users` SET `banana` = `banana` - 1 WHERE `user_id` = '".$_SESSION['ID']."';";
$result = @mysql_query($query); 
if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

$query = "INSERT INTO `BBanana_bananas`(`user_id`, `banana_out`, `current_banana`, `action_date`, `item_id`, `comment`) 
VALUES('".$_SESSION['ID']."', '1', '".$new_banana."', '".$currentTime."', '".$_POST['sid']."', '".$row['item_fname']."');";
$result = @mysql_query($query); 
if(!$result || @mysql_affected_rows() == 0) $okFlag = false;


if(!$okFlag){
	$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
	echo("배틀실패");
}else{
	$result = @mysql_query($BATTLEBANANA_ACTION);//모두 성공하면 Commit.
	echo("배틀성공!");
}

mysql_close($connect);
?>