<?//서브페이지의 각종 액션들 스크립팅
	include "popCheckLoged.php";
	include "connect.php";
	include "define_battle.php";
	
	$is_again = "no";

	$sql=mysql_query("select * from BBanana_items where item_id='".$_GET['sid']."'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$time_gap = $row['item_expired'] - mktime();

	if($row['item_lastbider'] == $_SESSION['ID'] && $time_gap <= 0){
		$deli_title = $row['item_fname']." <img src='../img/pop/btn_sign_win.gif' align='top'/><br><br>결제금액 : ".number_format($row['item_price'])."원 + 배송비(".number_format(TEAKBAE)."원) = ".number_format($row['item_price']+TEAKBAE)."원";
		$ship_type = "win";
		$ship_price = $row['item_price']+TEAKBAE;
		$goodname = $row['item_fname'];
		$prt_wincomment = '<tr>
                  	<td>
                    	<table width="390" border="0" cellspacing="0" align="center">
                        <tr>
                          <td width="65" height="34" align="right"><img src="../img/pop/img_win_comment.gif" /></td>
                          <td width="8" background="../img/pop/bg_input_l.gif"></td>
                          <td background="../img/pop/bg_input_c.gif"><input name="deli_win" type="text" class="input" id="deli_win" style="width:215px" onFocus="checkwin_deli()" onBlur="checkwin_deli();onBlurLayer(\'deli_win\');" onKeyUp="checkwin_deli()"/></td>
                          <td width="8" background="../img/pop/bg_input_r.gif"></td>
                          <td width="50" align="right"><div id="deli_win_layer"><img src="../img/pop/img_conf_x.gif" /></div></td>
                        </tr>
						<tr><td colspan="2"></td><td><div id="deli_win_layer2" style="text-align:right;"></div></td><td colspan="2"></td></tr>
                      </table>
                    </td>
                  </tr>';

		$deli_option = 'win_make';
	}else{
		$sql2=mysql_query("select COUNT('no') as cnt from BBanana_bids where item_id='".$_GET['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
		$row2=mysql_fetch_array($sql2);
		$item_bided = $row2['cnt'] * BANANA_PRICE;

		$deli_title = $row['item_fname']." <img src='../img/pop/btn_sign_reward.gn.gif' align='top'/><br><br>결제금액 : ".number_format($row['item_rrp']-$item_bided)."원 + 배송비(".number_format(TEAKBAE)."원) = ".number_format($row['item_rrp']-$item_bided+TEAKBAE)."원";
		$ship_type = "reward";
		$ship_price = $row['item_rrp']-$item_bided+TEAKBAE;
		$goodname = $row['item_fname'];
		$prt_wincomment = '';

		$deli_option = 'reward_make';
	}

	$se_str = "SELECT * from `BBanana_ships` WHERE user_id = '".$_SESSION['ID']."' and item_id = '".$_GET['sid']."'";
	$se_sql = mysql_query($se_str) or die(mysql_error()); 
	$se_row = mysql_fetch_array($se_sql);

	if($se_row) $is_again = "yes";
?>