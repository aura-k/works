<? 

include "../define_battle.php";
include "../connect.php"; //디비 정의 페이지 
include "../sess_func.php"; //함수 정의 페이지 include 

$expireTime = mktime() + 60;

while(mktime() < $expireTime){ 
	
	$str = "SELECT A.item_id FROM BBanana_items AS A, BBanana_autobids AS B
		WHERE A.item_id = B.item_id
		AND A.item_expired - unix_timestamp(now()) >= -1
		AND B.auto_banana > 0
		GROUP BY A.item_id ASC";

	$sql = mysql_query($str) or die(mysql_error());

	while($row = mysql_fetch_array($sql)){
		autoAction($row['item_id']);
	}
	usleep(100000);
}

//autoDelAction();

mysql_close($connect);

echo '정상경로 '.date('Y.m.d H:i:s',mktime());

function autoAction($sid){
	echo 'IF문 안들어감'.date('Y.m.d H:i:s',mktime()).'<br>';
	$result = @mysql_query("COMMIT");
	$str = "SELECT A.item_id, A.item_expired, A.item_price, A.item_fname, A.item_lastbider, B.auto_banana, B.bider_id, B.bider_ipnum, B.is_mobile
			FROM BBanana_items AS A, BBanana_autobids as B
			WHERE A.item_id = B.item_id
			AND A.item_id = '".$sid."'
			AND B.bider_id != '".$row['item_lastbider']."'
			AND A.item_expired - unix_timestamp(now()) >= -1
			AND B.auto_banana > 0
			ORDER BY A.item_expired, rand() ASC";
	$sql = mysql_query($str) or die(mysql_error());
	$row = mysql_fetch_array($sql);

	if(intval($row['item_expired']) - mktime() <= 1 && $row['item_expired'] - mktime() > -1 && $row['item_lastbider'] != $row['bider_id']){
		echo $sid.' | '.$row['bider_id'].' | '.$row['auto_banana'].' | '.date('Y.m.d H:i:s',mktime()).'<br>';
		/*$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
		$result = @mysql_query('BEGIN');
		$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)
		
		$str2 = "select banana from BBanana_users where user_id = '".$row['bider_id']."'";
		$sql2 = mysql_query($str2) or die(mysql_error()); 
		$row2 = mysql_fetch_array($sql2);

		//$new_banana = intval($row2['banana']) - 1;//유저의 바나나갯수를 하나 줄인다.
		//$new_auto_banana = intval($row['auto_banana']) - 1;//유저의 바나나갯수를 하나 줄인다.
		$new_price = intval($row['item_price']) + COIN_UP;//아이템 가격을 COIN_UP원 올린다.
		$new_expired = intval($row['item_expired']) + TIME_UP;//아이템 제한시간을 TIME_UP초 올린다.


//////////////////////  여기서부터 새값에 대한 수정, 입력 SQL이 시작된다. //////////////////////
		if($row['is_mobile'] == 'yes')//모바일에서 신청한 오토배틀이면
			$query = "INSERT INTO `BBanana_bids`(`item_id`, `bider_id`, `bid_time`, `bid_microtime`, `bider_ipnum`, `is_mobile`) VALUES('".$row['item_id']."', '".$row['bider_id']."', '".mktime()."', '".(_microtime()-mktime())."', '".$row['bider_ipnum']."', 'yes');";
		else
			$query = "INSERT INTO `BBanana_bids`(`item_id`, `bider_id`, `bid_time`, `bid_microtime`, `bider_ipnum`) VALUES('".$row['item_id']."', '".$row['bider_id']."', '".mktime()."', '".(_microtime()-mktime())."', '".$row['bider_ipnum']."');";
		$result = @mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$query = "UPDATE `BBanana_items` SET `item_lastbider` =  '".$row['bider_id']."', `item_expired` = '".$new_expired."', `item_price` =  '".$new_price."' WHERE `item_id` = '".$row['item_id']."';";
		$result = @mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$query = "UPDATE `BBanana_autobids` SET `auto_banana` = `auto_banana` - 1  WHERE `bider_id` = '".$row['bider_id']."' and `item_id` = '".$row['item_id']."';";
		$result = @mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$query = "INSERT INTO `BBanana_bananas`(`user_id`, `banana_out`, `current_banana`, `action_date`, `item_id`, `comment`) VALUES('".$row['bider_id']."', '1', '".intval($row2['banana'])."', '".mktime()."', '".$row['item_id']."_auto', '".$row['item_fname']."');";
		$result = @mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		if(!$okFlag){
			$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
		}else{
			$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
		}*/
	}
}

function autoDelAction(){//경매종료시 오토걸었던 것 모두 제거 해주는 스크립트
	$str_del = "SELECT A.item_id, A.item_expired, A.item_price, A.item_fname, A.item_lastbider, B.auto_banana, B.bider_id, B.bider_ipnum
				FROM BBanana_items AS A, BBanana_autobids AS B
				WHERE A.item_id = B.item_id
				AND A.item_expired <= UNIX_TIMESTAMP(NOW()) 
				AND B.auto_banana > 0
				ORDER BY A.item_expired ASC LIMIT 0,1";
	$sql_del = mysql_query($str_del) or die(mysql_error());
	$row_del = mysql_fetch_array($sql_del);

	if($row_del){
		$okFlag_del = true;
		$query = "UPDATE `BBanana_users` SET `banana`= `banana` + ".$row_del['auto_banana']." WHERE `user_id`='".$row_del['bider_id']."'";
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag_del = false;

		$query = "UPDATE `BBanana_autobids` SET `auto_banana` = 0 WHERE `bider_id`='".$row_del['bider_id']."' AND `item_id`='".$row_del['item_id']."'";
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag_del = false;

		if(!$okFlag_del){
			$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
		}else{
			$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
		}
	}
}
?>