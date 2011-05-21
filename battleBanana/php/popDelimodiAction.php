<?//서브페이지의 각종 액션들 스크립팅
	include "popCheckLoged.php";
	include "connect.php";
	include "define_battle.php";
	
	$sql=mysql_query("select * from BBanana_ships where user_id ='".$_SESSION['ID']."' and  item_id='".$_GET['sid']."'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	
	if($row['ship_type'] == 'win'){
		$prt_title = "WON BATTLE!";
		$deli_title = $row['item_fname']." <img src='../img/pop/btn_sign_win.gif' align='top'/><br><br>결제금액 : ".number_format($row['item_price']-TEAKBAE)."원 + 배송비(".number_format(TEAKBAE)."원) = ".number_format($row['item_price'])."원";
		$ship_price = $row['item_price']-TEAKBAE;
	}else{
		$prt_title = "보상구매";
		$deli_title = $row['item_fname']." <img src='../img/pop/btn_sign_reward.gn.gif' align='top'/><br><br>결제금액 : ".number_format($row['item_price']-TEAKBAE)."원 + 배송비(".number_format(TEAKBAE)."원) = ".number_format($row['item_price'])."원";
		$ship_price = $row['item_price']-TEAKBAE;
	}

	
?>