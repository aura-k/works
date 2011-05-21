<?
	function banana_pagecount($id){
		$sql=mysql_query("select COUNT(DISTINCT(`item_id`)) as cnt from BBanana_bananas where user_id ='".$id."';") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		return $row['cnt'];
	}

	function banana_pagenation($num, $isAddBtn){
		$page_scale = 10;//한페이지당 보일 목록의 갯수
		$banana_cnt = banana_pagecount($_SESSION['ID']);
		if ($banana_cnt%$page_scale == 0)    
	      $banana_pcnt = floor($banana_cnt/$page_scale)-1;     
	   else
	      $banana_pcnt = floor($banana_cnt/$page_scale);

		$str = "SELECT MAX( action_date ) action_date, no, user_id, banana_in, SUM( banana_out ) AS banana_out, item_id, comment
				FROM BBanana_bananas
				WHERE user_id = '".$_SESSION['ID']."'
				GROUP BY item_id
				ORDER BY action_date DESC 
				LIMIT ".($num*$page_scale).", ".$page_scale.";";
		$sql=mysql_query($str) or die(mysql_error());

		$prt = '<table width=100%>';

		if($banana_cnt == 0){
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td colspan=4 height=300px>내역이 없습니다.</td>';
				$prt .= '</tr>';
		}else{
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			if(preg_match('/B_/i', $row['item_id'])){//바나나 충전일때
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td height=30px width=45px>'.date('m/d H:i', intval($row['action_date'])).'</td>';
				$prt .= '<td class=text_br>'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>';
				$prt .= '<td class=text_grey width=35px>'.$row['banana_in'].'</td>';
				$prt .= '<td class=text_grey width=45px>-</td>';
				$prt .= '</tr>';
			}else if(preg_match('/BC_/i', $row['item_id'])){//바나나 충전 취소일때
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td height=30px width=45px>'.date('m/d H:i', intval($row['action_date'])).'</td>';
				$prt .= '<td class=text_br style=color:#FF6633>'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>';
				$prt .= '<td class=text_grey width=35px>-</td>';
				$prt .= '<td class=text_grey width=45px>'.$row['banana_out'].'</td>';
				$prt .= '</tr>';
			}else if(preg_match('/_auto/i', $row['item_id'])){//오토 배틀일때
				$str2 = "select auto_banana from BBanana_autobids where bider_id = '".$_SESSION['ID']."' and item_id = '".substr($row['item_id'],0,6)."';";
				$sql2=mysql_query($str2) or die(mysql_error());
				$row2=mysql_fetch_array($sql2);
				
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td height=30px width=45px>'.date('m/d H:i', intval($row['action_date'])).'</td>';
				$prt .= '<td class=text_br><img src=../img/pop/btn_sign_auto.gif border=0 align=top><br>'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>';
				$prt .= '<td class=text_grey width=35px>-</td>';
				$prt .= '<td class=text_grey width=45px>'.$row['banana_out']." ← ".$row2['auto_banana'].'</td>';
				$prt .= '</tr>';
			}else{//일반 배틀일때
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td height=30px width=45px>'.date('m/d H:i', intval($row['action_date'])).'</td>';
				$prt .= '<td class=text_br>'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>';
				$prt .= '<td class=text_grey width=35px>-</td>';
				$prt .= '<td class=text_grey width=45px>'.$row['banana_out'].'</td>';
				$prt .= '</tr>';
			}
			
			$i++;
			++$cnt;
		}
		}
		$prt .= '</table><div id=insert_list_'.$num.'></div>';

		if($isAddBtn == 'none')
			$prt .= '';
		else if(($banana_cnt-($num+1)*$page_scale) <= 0)
			$prt .= '';
		else{
			$prt .= '<table width=100%><tr class=bananalist_add>';
			$prt .= '<td colspan=4 height=30 onclick=append_bananalist('.$num.')>더보기('.($banana_cnt-($num+1)*$page_scale).'건)</td>';
			$prt .= '</tr></table>';
		}
		return $prt;
	}
	function remain_banana_page($num){
		$page_scale = 10;
		$banana_cnt = banana_pagecount($_SESSION['ID']);
		return $banana_cnt-($num+1)*$page_scale;
	}




	function order_pagecount($id){
		$sql=mysql_query("select COUNT(`no`) as cnt from BBanana_ships where user_id ='".$id."' and `order_num` LIKE 'I%';") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		return $row['cnt'];
	}

	function order_pagenation($num, $isAddBtn){
		$page_scale = 10;//한페이지당 보일 목록의 갯수
		$banana_cnt = order_pagecount($_SESSION['ID']);
		if ($banana_cnt%$page_scale == 0)    
	      $banana_pcnt = floor($banana_cnt/$page_scale)-1;     
	   else
	      $banana_pcnt = floor($banana_cnt/$page_scale);

		$str = "select * from BBanana_ships where user_id ='".$_SESSION['ID']."' and `order_num` LIKE 'I%' ORDER BY ship_created DESC LIMIT ".($num*$page_scale).", ".$page_scale.";";
		$sql=mysql_query($str) or die(mysql_error());

		$prt = '<table width=100%>';

		if($banana_cnt == 0){
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td colspan=3 height=300px>내역이 없습니다.</td>';
				$prt .= '</tr>';
		}else{
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			if($row['ship_type'] == 'win')
				$prt_img = "<img src='../img/pop/btn_sign_win.gif' align='top'/>";
			else if($row['ship_type'] == 'reward')
				$prt_img = "<img src='../img/pop/btn_sign_reward.gn.gif' align='top'/>";


			if($row['is_cancel'] == 'wait'){
				$s_stats = "<div style='color:#E32429;font-weight:bold'>취소대기중</div>";
			}else if($row['is_cancel'] == 'grant'){
				$s_stats = "<div style='color:#7CC109;font-weight:bold'>취소완료</div>";
			}else{
				switch($row['ship_status']){
					case '00': $s_stats = "배송준비";
					break;
					case '01': $s_stats = "배송중";
					break;
					case '02': $s_stats = "배송완료";
					break;
				}
			}

				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td height=30px width=45px>'.date('m/d H:i', intval($row['ship_created'])).'</td>';
				$prt .= '<td class=text_br>'.$prt_img.'<br>'.mb_strimwidth($row['item_fname'], 0, 40, "...", "UTF-8").'</td>';
				$prt .= '<td class=text_grey width=70px>'.$s_stats.'</td>';
				$prt .= '</tr>';
			
			$i++;
			++$cnt;
		}
		}
		$prt .= '</table><div id=insert_list_'.$num.'></div>';

		if($isAddBtn == 'none')
			$prt .= '';
		else if(($banana_cnt-($num+1)*$page_scale) <= 0)
			$prt .= '';
		else{
			$prt .= '<table width=100%><tr class=orderlist_add>';
			$prt .= '<td colspan=3 height=30 onclick=append_orderlist('.$num.')>더보기('.($banana_cnt-($num+1)*$page_scale).'건)</td>';
			$prt .= '</tr></table>';
		}
		return $prt;
	}
	function remain_order_page($num){
		$page_scale = 10;
		$banana_cnt = order_pagecount($_SESSION['ID']);
		return $banana_cnt-($num+1)*$page_scale;
	}


/*	종료경매	*/
	function closed_pagecount(){
		$sql=mysql_query("select COUNT(`item_id`) as cnt from BBanana_items where item_expired <= unix_timestamp(now());") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		return $row['cnt'];
	}

	function closed_pagenation($num, $isAddBtn){
		include "../php/define_battle.php";
		
		$page_scale = 10;//한페이지당 보일 목록의 갯수
		$banana_cnt = closed_pagecount();
		if ($banana_cnt%$page_scale == 0)    
	      $banana_pcnt = floor($banana_cnt/$page_scale)-1;     
	   else
	      $banana_pcnt = floor($banana_cnt/$page_scale);

		$str = "SELECT * from BBanana_items where item_expired <= unix_timestamp(now()) ORDER BY item_expired DESC LIMIT ".($num*$page_scale).", ".$page_scale.";";
		$sql=mysql_query($str) or die(mysql_error());

		$prt = '<table width=100%>';

		if($banana_cnt == 0){
				$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
				$prt .= '<td colspan=3 height=300px>내역이 없습니다.</td>';
				$prt .= '</tr>';
		}else{
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			if($row['item_lastbider'] && $row['item_lastbider'] != '-'){
				$sql2=mysql_query("select COUNT('no') as cnt from BBanana_bids where item_id='".$row['item_id']."' and bider_id='".$row['item_lastbider']."'") or die(mysql_error());
				$row2=mysql_fetch_array($sql2);
				
				if($row2['cnt']) $saveRate = round((1-(($row2['cnt']*BANANA_PRICE+$row['item_price'])/$row['item_rrp']))*100).'%';
				else $saveRate = '-';
			}else
				$saveRate = '-';

			$prt .= '<tr bgcolor=#FFFFFF class=bananalist_con>';
			$prt .= '<td height=30px width=45px>'.date('m/d H:i', intval($row['item_expired'])).'</td>';
			$prt .= '<td class=text_br>'.mb_strimwidth($row['item_fname'], 0, 50, "...", "UTF-8").'</td>';
			$prt .= '<td class=text_grey width=50px>'.$saveRate.'</td>';
			$prt .= '</tr>';
			
			$i++;
			++$cnt;
		}
		}
		$prt .= '</table><div id=insert_list_'.$num.'></div>';

		if($isAddBtn == 'none')
			$prt .= '';
		else if(($banana_cnt-($num+1)*$page_scale) <= 0)
			$prt .= '';
		else{
			$prt .= '<table width=100%><tr class=closedlist_add>';
			$prt .= '<td colspan=3 height=30 onclick=append_closedlist('.$num.')>더보기('.($banana_cnt-($num+1)*$page_scale).'건)</td>';
			$prt .= '</tr></table>';
		}
		return $prt;
	}
	function remain_closed_page($num){
		$page_scale = 10;
		$banana_cnt = closed_pagecount();
		return $banana_cnt-($num+1)*$page_scale;
	}
?>