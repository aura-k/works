<?//서브페이지의 각종 액션들 스크립팅
	include "popCheckLoged.php";
	include "connect.php";
	include "define_battle.php";

function ship_pagecount($id){
	$sql=mysql_query("select COUNT(`no`) as cnt from BBanana_ships where user_id ='".$id."' and `order_num` LIKE 'I%';") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	return $row['cnt'];
}

function ship_pagenation($num){
	$page_scale = 5;//한페이지당 보일 목록의 갯수
	$ship_cnt = ship_pagecount($_SESSION['ID']);

	if ($ship_cnt%$page_scale == 0)    
      $ship_pcnt = floor($ship_cnt/$page_scale)-1;     
   else
      $ship_pcnt = floor($ship_cnt/$page_scale);

	$str = "select * from BBanana_ships where user_id ='".$_SESSION['ID']."' and `order_num` LIKE 'I%' ORDER BY ship_created DESC LIMIT ".($num*$page_scale).", ".$page_scale.";";
	$sql=mysql_query($str) or die(mysql_error());

	echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td valign=\"top\">";
	echo "<table width='690' border='0' cellspacing='1' cellpadding='0' style='margin:15px;' bgcolor='#dddddd'>
          <tr bgcolor='#FFFFFF' class='title'>
          <td width='120' height='20'>날짜</td>
          <td width='263'>상품명</td>
          <td width='80'>정가</td>
          <td width='80'>사용바나나</td>
          <td width='80'>결제금액</td>
          <td width='60'>배송</td>
          </tr>";
	
	if($ship_cnt == 0){
			echo "<tr bgcolor=\"#FFFFFF\" class=\"con\">";
			echo "<td colspan='6' height='200'>주문내역이 없습니다.</td>";
			echo "</tr>";
	}else{

	$i=0;
	$cnt=0;
	while($row=mysql_fetch_array($sql)){
		$str2 = "select item_rrp from BBanana_items where item_id ='".$row['item_id']."'";
		$sql2=mysql_query($str2) or die(mysql_error());
		$row2=mysql_fetch_array($sql2);

		$sql3=mysql_query("select COUNT('no') as cnt from BBanana_bids where item_id='".$row['item_id']."' and bider_id='".$row['user_id']."'") or die(mysql_error());
		$row3=mysql_fetch_array($sql3);
		$item_bided = $row3['cnt'] * BANANA_PRICE;

		switch($row['ship_status']){
			case '00': $s_stats = "<a onclick=openDialogByDom('#option_delimodi_".$row['item_id']."')  style='cursor:pointer'><img src='../img/pop/btn_deli_modi.gif' alt='배송준비'></a>";
			break;
			case '01': $s_stats = "<img src='../img/pop/btn_deli_ing.gif' alt='배송중'>";
			break;
			case '02': $s_stats = "배송완료";
			break;
		}

		if($row['pay_method'] == 'VBank' && $row['is_deposit'] == 'no')
			$prt_total_price = "<a onclick='copy_text(\"".$row['bankInfo']."\")' style='cursor:pointer' title='".$row['bankInfo']."' alt='".$row['bankInfo']."'><img src='../img/pop/btn_deposit.gif' border='0' align='absmiddle'/></a>&nbsp;&nbsp;&nbsp;&nbsp;";
		else if($row['pay_method'] == 'VBank' && $row['is_deposit'] == 'yes')
			$prt_total_price = number_format($row['item_price'])."원&nbsp;";
		else
			$prt_total_price = number_format($row['item_price'])."원&nbsp;";

		if($row['is_cancel'] == 'wait'){
			$prt_priceAndstats = "<td colspan='2' align='center'><div style='color:#E32429;font-weight:bold'>취소대기중</div></td>";
		}else if($row['is_cancel'] == 'grant'){
			$prt_priceAndstats = "<td colspan='2' align='center'><div style='color:#7CC109;font-weight:bold'>취소완료</div></td>";
		}else{
			$prt_priceAndstats = "<td class='text_gr_ship'>".$prt_total_price."</td>
              <td>".$s_stats."</td>";
		}
		if($row['ship_type'] == 'win')
			$prt_img = "<img src='../img/pop/btn_sign_win.gif' align='top'/>";
		else if($row['ship_type'] == 'reward')
			$prt_img = "<img src='../img/pop/btn_sign_reward.gn.gif' align='top'/>";

		echo "<tr bgcolor='#FFFFFF' class='con'>
              <td  height='20'>".date('Y-m-d H:i',$row['ship_created'])."</td>
              <td class='text_br'><a href='./sub.html?sid=".$row['item_id']."' target='_self'>".mb_strimwidth($row['item_fname'], 0, 40, "...", "UTF-8")."</a> ".$prt_img."</td>
              <td class='text_grey_ship'>".number_format($row2['item_rrp'])."원&nbsp;</td>
              <td class='text_ye_ship'>".number_format($item_bided)."원&nbsp;</td>
              ".$prt_priceAndstats."
              </tr>";
		$i++;
		++$cnt;
	}

	}
	echo "</table></td></tr><tr><td height=\"40\" align=\"center\">";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"page\">
                  <tr>";
	for($i=0;$i<=$ship_pcnt;$i++){
		if($num == $i) echo "<td width='10'><div class='sub_photo_num_".$i."'><a href='#' onmousedown='orderlist(".$i.")' style='cursor:pointer'><img src='../img/btn_page_thumb_s.gif' border='0'/></a></div></td>";
		else echo "<td width='10'><div class='sub_photo_num_".$i."'><a href='#' onmousedown='orderlist(".$i.")' style='cursor:pointer'><img src='../img/btn_page_thumb.gif' name='btn_thumb".$i."' id='btn_thumb".$i."' onmouseover=javascript:btn_thumb".$i.".src='../img/btn_page_thumb_o.gif'; onmouseout=javascript:btn_thumb".$i.".src='../img/btn_page_thumb.gif'; border='0'/></a></div></td>";
	}
	echo "</tr>
                </table>
				</td>
			</tr>
			</table>";
}
?>