<?//서브페이지의 각종 액션들 스크립팅

	$sid = $_GET['sid'];
	include "sess_func.php";
	include "connect.php";
	include "loginSessionAction.php";
	include "checkReloged.php";

	if(!$sid){
		GoTo('잘못된 경로로 접근하셨습니다!', '../html/main.html');
		return;
	}

	if($_SESSION['ID']){
		$sql2=mysql_query("select banana from BBanana_users where user_id='".$_SESSION['ID']."'") or die(mysql_error());
		$row2=mysql_fetch_array($sql2);
		$get_banana_html = $row2['banana'];
	}

	$sql3=mysql_query("select COUNT('no') as cnt from BBanana_bids where item_id='".$sid."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
	$row3=mysql_fetch_array($sql3);

	$sql=mysql_query("select * from BBanana_items where item_id ='".$sid."'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	if($row['item_id'] == null){
		GoTo('해당 경매 상품이 없습니다.', '../html/main.html');
		return;
	}

	$photo_cnt=0;
	for($i=1;$i<=5;$i++){
		if($row['item_photo'.$i] == ''){
			//아무것도 안함
		}else{
			$sub_photo[$i] = $row['item_photo'.$i];
			$photo_cnt++;
		}
	}

	if($row['item_expired'] - mktime() < 0){
		$sql_win = mysql_query("select user_id, win_comment from BBanana_ships where item_id = '".$row['item_id']."' and user_id ='".$row['item_lastbider']."' and ship_type = 'win' order by ship_created DESC") or die(mysql_error());
		$row_win=mysql_fetch_array($sql_win);
		
		if($row_win) $win_comment = '<b>'.$row_win['user_id'].' :</b><br>'.$row_win['win_comment'];
		else $win_comment = '당첨 소감이 없습니다.';
	}else{
		$win_comment = '당첨 소감이 없습니다.';
	}

	$se_str = "SELECT * from `BBanana_ships` WHERE user_id = '".$_SESSION['ID']."' and item_id = '".$sid."'";
	$se_sql = mysql_query($se_str) or die(mysql_error()); 
	$se_row = mysql_fetch_array($se_sql);
	if($se_row) $is_order = "yes";
	else $is_order = "no";
?>