<? 
function chargeAction($oid){//충전로직을 실행하는 함수
	$str = "SELECT * from `BBanana_bananas` WHERE item_id = '".$oid."'";//바나나가 바나나리스트에 있는지 중복여부 검색
	$sql = mysql_query($str) or die(mysql_error()); 
	$row = mysql_fetch_array($sql);

	if($row == false){//해당결과값이 없으면 실행한다.(중복충전방지)
		$str2 = "SELECT * from `BBanana_ships` WHERE order_num = '".$oid."'";
		$sql2 = mysql_query($str2) or die(mysql_error()); 
		$row2 = mysql_fetch_array($sql2);
		switch($row2['pay_method']){
			case "VCard": $i_pay_method = "신용카드(ISP)";
				break;
			case "Card": $i_pay_method = "신용카드(안심)";
				break;
			case "OCBPoint": $i_pay_method = "OK캐쉬백";
				break;
			case "DirectBank": $i_pay_method = "실시간계좌";
				break;
			case "HPP": $i_pay_method = "핸드폰";
				break;
			case "VBank": $i_pay_method = "가상계좌";
				break;
			case "Ars1588Bill": $i_pay_method = "1588전화";
				break;
			case "PhoneBill": $i_pay_method = "폰빌전화";
				break;
			case "Culture": $i_pay_method = "문화상품권";
				break;
			case "TEEN": $i_pay_method = "틴캐시";
				break;
			case "DGCL": $i_pay_method = "게임문화";
				break;
			case "BCSH": $i_pay_method = "도서문화";
				break;
			case "OABK": $i_pay_method = "네이트미니";
				break;
			default: $i_pay_method = "";
				break;
		}
	
		$charged_banana = $row2['charged_banana'];
		$user_id = $row2['user_id'];

		$str3 = "SELECT * from `BBanana_users` WHERE user_id = '".$user_id."'";
		$sql3 = mysql_query($str3) or die(mysql_error()); 
		$row3 = mysql_fetch_array($sql3);

		$current_banana = $row3['banana'];

		$str4 = "INSERT INTO `BBanana_bananas`(
					`user_id`, `banana_in`, `current_banana`, `action_date`, `item_id`, `comment`) 
				 VALUES(
					'".$user_id."', 
					'".$charged_banana."', 
					'".($current_banana+$charged_banana)."', 
					'".mktime()."', 
					'".$oid."', 
					'바나나 충전 &lt;".$i_pay_method." 이용&gt;'
				 );";
		$sql4 = mysql_query($str4) or die(mysql_error());

		$str5 = "UPDATE `BBanana_users` SET banana = banana+".$charged_banana." WHERE `user_id` = '".$user_id."';";
		$sql5 = mysql_query($str5) or die(mysql_error()); 
		
		return true;
	}else
		return false;
}
function cancelAction($user_id, $amount){
	$str3 = "SELECT * from `BBanana_users` WHERE user_id = '".$user_id."'";
	$sql3 = mysql_query($str3) or die(mysql_error()); 
	$row3 = mysql_fetch_array($sql3);
	
	$current_banana = $row3['banana'];
	$new_banana = $current_banana - $amount;
	
	$str = "UPDATE `BBanana_users` SET `banana` =  '".$new_banana."' WHERE `user_id` = '".$user_id."';";
	$sql = mysql_query($str) or die(mysql_error()); 

	$str2 = "INSERT INTO `BBanana_bananas`(`user_id`, `banana_out`, `current_banana`, `action_date`, `item_id`, `comment`) 
	VALUES('".$user_id."', '".$amount."', '".$new_banana."', '".mktime()."', 'BC_".mktime()."', '바나나 충전 취소');";
	$sql2 = mysql_query($str2) or die(mysql_error()); 

	return true;
}
function adminChargeAction($user_id, $amount, $comment){
	$str3 = "SELECT * from `BBanana_users` WHERE user_id = '".$user_id."'";
	$sql3 = mysql_query($str3) or die(mysql_error()); 
	$row3 = mysql_fetch_array($sql3);
	
	$current_banana = $row3['banana'];
	$new_banana = $current_banana + $amount;


	$result = mysql_query('start transaction'); //트랜젝션시작
	$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

	$query = "UPDATE `BBanana_users` SET `banana` =  '".$new_banana."' WHERE `user_id` = '".$user_id."';";
	$result = mysql_query($query); 
	if(!$result || mysql_affected_row($result) == 0) $okFlag = false;

	$query = "INSERT INTO `BBanana_bananas`(`user_id`, `banana_in`, `current_banana`, `action_date`, `item_id`, `comment`) 
	VALUES('".$user_id."', '".$amount."', '".$new_banana."', '".mktime()."', 'B_".mktime().rand(10,99)."', '바나나 충전 &lt;".$comment."&gt;');";
	$result = mysql_query($query); 
	if(!$result || mysql_affected_row($result) == 0) $okFlag = false;
	
	if(!$okFlag){
		$result = mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
		return false;
	}else{
		$result = mysql_query("COMMIT");//모두 성공하면 Commit.
		return true;
	}
}
?>