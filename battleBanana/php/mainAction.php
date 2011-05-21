<?//메인페이지의 각종 액션들 스크립팅
	include "sess_func.php";
	include "connect.php";
	include "loginSessionAction.php";
	include "checkReloged.php";
	if($_SESSION['ID']){
		$sql2=mysql_query("select banana from BBanana_users where user_id='".$_SESSION['ID']."'") or die(mysql_error());
		$row2=mysql_fetch_array($sql2);
		$get_banana_html = $row2['banana'];
	}
	
	function mainitem_pagecount($op){
		if($op == '1' || $op == '2' || $op == '3' || $op == '4' )
			$sql=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired > unix_timestamp(now()) and item_id like '".$op."%'") or die(mysql_error());
		else if($op == '_last')
			$sql=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired < unix_timestamp(now());") or die(mysql_error());
		else if($op == '1_last' || $op == '2_last' || $op == '3_last' || $op == '4_last' )
			$sql=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired < unix_timestamp(now()) and item_id like '".substr($op,0,1)."%'") or die(mysql_error());
		else if($op == "last" || $op == "favorite" || $op == "win"){
			switch($op){
				case "last":
					//$str = "select COUNT(distinct a.item_id) AS cnt from BBanana_bids As a, BBanana_items As b where a.item_id = b.item_id and a.bider_id = '".$_SESSION['ID']."'";
					$str = "select COUNT(item_id) AS cnt from BBanana_view_bids where bider_id = '".$_SESSION['ID']."'";
					break;
				case "favorite":
					$str = "select COUNT(distinct a.item_id) AS cnt from BBanana_favorites As a, BBanana_items As b where a.item_id = b.item_id and a.user_id = '".$_SESSION['ID']."'";
					break;
				case "win":
					$str = "select COUNT(item_id) AS cnt from BBanana_items where item_expired <= unix_timestamp(now()) and item_lastbider = '".$_SESSION['ID']."'";
					break;
			}
			$sql=mysql_query($str) or die(mysql_error());
		}else
			$sql=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired > unix_timestamp(now());") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		return $row['cnt'];
	}

	function mainitem_pagenation($num, $option, $cate){
		$page_scale = 9;//한페이지당 보일 목록의 갯수
		
		if($cate == '1' || $cate == '2' || $cate == '3' || $cate == '4' ){//카테고리 값이 있다면...
			$mainitem_cnt = mainitem_pagecount($cate);

			if ($mainitem_cnt%$page_scale == 0)    
				$mainitem_pcnt = floor($mainitem_cnt/$page_scale)-1;     
			else
				$mainitem_pcnt = floor($mainitem_cnt/$page_scale);

			$sql=mysql_query("select * from BBanana_items where item_expired > unix_timestamp(now()) and item_id like '".$cate."%' order by item_expired ASC limit ".($num*$page_scale).", ".$page_scale) or die(mysql_error()); 

			$first_page = 'mainItemList(0,\'\',\''.$cate.'\')';
			$next_page = 'mainItemList_next(\'\',\''.$cate.'\')';
			$prev_page = 'mainItemList_prev(\'\',\''.$cate.'\')';
			$last_page = 'mainItemList('.$mainitem_pcnt.',\'\',\''.$cate.'\')';
		}else if($option == "last" || $option == "favorite" || $option == "win"){//옵션값이 있다면....
			$mainitem_cnt = mainitem_pagecount($option);

			if ($mainitem_cnt%$page_scale == 0)    
				$mainitem_pcnt = floor($mainitem_cnt/$page_scale)-1;     
			else
				$mainitem_pcnt = floor($mainitem_cnt/$page_scale);

			switch($option){
				case "last":
					//$str1 = "SELECT distinct a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_bids As a, BBanana_items As b where a.item_id = b.item_id and a.bider_id = '".$_SESSION['ID']."' order by a.item_id DESC limit ".($num*$page_scale).", ".$page_scale;
					$str1 = "SELECT a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_view_bids As a, BBanana_items As b where a.item_id = b.item_id and a.bider_id = '".$_SESSION['ID']."' order by a.item_id DESC limit ".($num*$page_scale).", ".$page_scale;
				break;
				case "favorite":
					$str1 = "SELECT distinct a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_favorites As a, BBanana_items As b where a.item_id = b.item_id and a.user_id = '".$_SESSION['ID']."' order by a.item_id DESC limit ".($num*$page_scale).", ".$page_scale;
				break;
				case "win":
					$str1 = "SELECT * from BBanana_items where item_expired <= unix_timestamp(now()) and item_lastbider = '".$_SESSION['ID']."' order by item_id DESC limit ".($num*$page_scale).", ".$page_scale;
				break;
			}
			$sql=mysql_query($str1) or die(mysql_error()); 
			
			$first_page = 'mainItemList(0,\''.$option.'\',\'\')';
			$next_page = 'mainItemList_next(\''.$option.'\',\'\')';
			$prev_page = 'mainItemList_prev(\''.$option.'\',\'\')';
			$last_page = 'mainItemList('.$mainitem_pcnt.',\''.$option.'\',\'\')';
		}else{//없다면(그냥 메인페이지를 보여주려면)...
			$mainitem_cnt = mainitem_pagecount('');

			if ($mainitem_cnt%$page_scale == 0)    
				$mainitem_pcnt = floor($mainitem_cnt/$page_scale)-1;     
			else
				$mainitem_pcnt = floor($mainitem_cnt/$page_scale);

			$sql=mysql_query("select * from BBanana_items where item_expired > unix_timestamp(now()) order by item_expired ASC limit ".($num*$page_scale).", ".$page_scale) or die(mysql_error());

			$first_page = 'mainItemList(0,\'\',\'\')';
			$next_page = 'mainItemList_next(\'\',\'\')';
			$prev_page = 'mainItemList_prev(\'\',\'\')';
			$last_page = 'mainItemList('.$mainitem_pcnt.',\'\',\'\')';
		}
		
		echo '<div id="items" style="height:590px;">';
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			if($row['item_expired'] <= mktime()) $ActiveBG = 'box_bg_closed';
			else $ActiveBG = 'box_bg';


			if($option == "favorite")//옵션이 관심경매이면...
				echo '<div class="'.$ActiveBG.'" id="box_'.$row['item_id'].'">
					  <div class="box_del"><a onclick=deleteFavorite("'.$row['item_id'].'") style="cursor:pointer"><img src="../img/btn_fav_del.gif" name="btn_fav_del'.$row['item_id'].'" id="btn_fav_del'.$row['item_id'].'" onmouseover=javascript:btn_fav_del'.$row['item_id'].'.src="../img/btn_fav_del_o.gif"; onmouseout=javascript:btn_fav_del'.$row['item_id'].'.src="../img/btn_fav_del.gif"; border="0"/></a></div>';
			else if($option == "win")//옵션이 낙찰경매이면...
				echo '<div class="box_bg_win" id="box_'.$row['item_id'].'">';
			else//일반경매
				echo '<div class="'.$ActiveBG.'" id="box_'.$row['item_id'].'">';
				
			
			echo '<div class="box_padding">
				  <div class="box_title"><a onclick="goSubPage(\''.$row['item_id'].'\')" style="cursor:pointer">'.$row['item_sname'].'</a></div>
				  <div class="box_item_img"><a href="sub.html?sid='.$row['item_id'].'"><img src="../'.$row['item_img'].'" width="122" height="122" border="0"></a></div>
				  <div class="box_time" id="time_'.$row['item_id'].'">-- : -- : --</div>
				  <div class="box_price" id="price'.$row['item_id'].'"><span class="box_price_in">'.number_format($row['item_price']).'</span><img src="../img/img_won.gif" style="margin-top:3px" /></div>
				  <div class="box_id">'.$row['item_lastbider'].'</div>
				  </div>
				  </div>';
			$i++;
			++$cnt;
		}

		if($i == 0 && $option == ''){//아이템이 하나도 없으면
			echo '<div class="box_bg" id="box_"><img src="../img/bg_box_nodata.gif" border="0"></div><div class="box_bg" id="box_"><a onclick="ClosedItemList(0, \''.$cate.'_last\')" style="cursor:pointer"><img src="../img/btn_box_closed.gif" name="btn_box_closed" id="btn_box_closed" onmouseover=javascript:btn_box_closed.src="../img/btn_box_closed_o.gif"; onmouseout=javascript:btn_box_closed.src="../img/btn_box_closed.gif"; border="0"/></a></div>';
			$mainitem_pcnt = 0;
		}else if($i == 0 && $option != ''){//아이템이 하나도 없는 옵션(낙찰경매, 관심경매, 참여경매)일경우
			echo '<div class="box_bg" id="box_"><img src="../img/bg_box_nodata.gif" border="0"></div>';
			$mainitem_pcnt = 0;
		}else if($num == $mainitem_pcnt && $option == '' && $mainitem_cnt%$page_scale != 0){//일반적인 마지막페이지 처리일 경우 게다가 아이템이 9개로도 떨어지지 않을때...
			echo '<div class="box_bg" id="box_"><a onclick="ClosedItemList(0, \''.$cate.'_last\')" style="cursor:pointer"><img src="../img/btn_box_closed.gif" name="btn_box_closed" id="btn_box_closed" onmouseover=javascript:btn_box_closed.src="../img/btn_box_closed_o.gif"; onmouseout=javascript:btn_box_closed.src="../img/btn_box_closed.gif"; border="0"/></a></div>';
		}else if ($option == '' && $mainitem_cnt%$page_scale == 0){//아이템이 9개로 떨어지면 칸이 밀리기때문에 지난경매부분을 다르게 처리해야함...
			echo '<div style="margin:0 10 0 0"><a onclick="ClosedItemList(0, \''.$cate.'_last\')" style="cursor:pointer"><img src="../img/btn_closed_long.jpg" name="btn_closed_long" id="btn_closed_long" onmouseover=javascript:btn_closed_long.src="../img/btn_closed_long_o.jpg"; onmouseout=javascript:btn_closed_long.src="../img/btn_closed_long.jpg"; border="0" style="margin-right:10px"/></a></div>';
		}

		echo '</div>';

		if($num == 0)//처음 페이지 이면..
			echo '<div style="clear:both;float:center;padding-top:18px;"><span><img src="../img/btn_page_first.gif" border="0"/></span><span><img src="../img/btn_page_prev.gif" border="0"/>&nbsp;&nbsp;</span>';
		else
			echo '<div style="clear:both;float:center;padding-top:18px;"><span><a onmousedown="'.$first_page.'" style="cursor:pointer"><img src="../img/btn_page_first.gif" name="btn_page_first" id="btn_page_first" onmouseover=javascript:btn_page_first.src="../img/btn_page_first_o.gif"; onmouseout=javascript:btn_page_first.src="../img/btn_page_first.gif"; border="0"/></a></span><span><a onmousedown="'.$prev_page.'" style="cursor:pointer"><img src="../img/btn_page_prev.gif" name="btn_page_prev" id="btn_page_prev" onmouseover=javascript:btn_page_prev.src="../img/btn_page_prev_o.gif"; onmouseout=javascript:btn_page_prev.src="../img/btn_page_prev.gif"; border="0"/></a>&nbsp;&nbsp;</span>';
	
	for($i=0;$i<=$mainitem_pcnt;$i++){
		if($num == $i) echo '<span><img src="../img/btn_page_thumb_s.gif" border="0"/></span>';
		else{
			if($cate == 1 || $cate == 2 || $cate == 3 || $cate == 4 )
				$goto_page = 'mainItemList('.$i.',\'\',\''.$cate.'\')';
			else if($option == "last" || $option == "favorite" || $option == "win")
				$goto_page = 'mainItemList('.$i.',\''.$option.'\',\'\')';
			else
				$goto_page = 'mainItemList('.$i.',\'\',\'\')';

			echo '<span><a onmousedown="'.$goto_page.'" style="cursor:pointer"><img src="../img/btn_page_thumb.gif" name="btn_page_thumb'.$i.'" id="btn_page_thumb'.$i.'" onmouseover=javascript:btn_page_thumb'.$i.'.src="../img/btn_page_thumb_o.gif"; onmouseout=javascript:btn_page_thumb'.$i.'.src="../img/btn_page_thumb.gif"; border="0"/></a></span>';
		}
	}
		if($num == $mainitem_pcnt)//마지막페이지 이면..
			echo '<span>&nbsp;&nbsp;<img src="../img/btn_page_next.gif" border="0"/></span><span><img src="../img/btn_page_last.gif" border="0"/></span>';
		else
			echo '<span>&nbsp;&nbsp;<a onmousedown="'.$next_page.'" style="cursor:pointer"><img src="../img/btn_page_next.gif" name="btn_page_next" id="btn_page_next" onmouseover=javascript:btn_page_next.src="../img/btn_page_next_o.gif"; onmouseout=javascript:btn_page_next.src="../img/btn_page_next.gif"; border="0"/></a></span><span><a onmousedown="'.$last_page.'" style="cursor:pointer"><img src="../img/btn_page_last.gif" name="btn_page_last" id="btn_page_last" onmouseover=javascript:btn_page_last.src="../img/btn_page_last_o.gif"; onmouseout=javascript:btn_page_last.src="../img/btn_page_last.gif"; border="0"/></a></span></div>';
	}

	function subitem_pagenation($sid){
		$page_scale = 3;//한페이지당 보일 목록의 갯수

		$sql=mysql_query("select * from BBanana_items where item_expired >= unix_timestamp(now()) && item_id != '".$sid."' order by item_expired ASC limit 0, ".$page_scale) or die(mysql_error());

		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			echo '<div class="box_bg" id="box_sub'.$row['item_id'].'">
				  <div class="box_padding">
				  <div class="box_title"><a onclick="goSubPage(\''.$row['item_id'].'\')" style="cursor:pointer">'.$row['item_sname'].'</a></div>
				  <div class="box_item_img"><a href="sub.html?sid='.$row['item_id'].'"><img src="../'.$row['item_img'].'" width="122" height="122" border="0"></a></div>
				  <div class="box_time" id="time_sub_'.$row['item_id'].'">-- : -- : --</div>
				  <div class="box_price" id="price'.$row['item_id'].'"><span class="box_price_in">'.number_format($row['item_price']).'</span><img src="../img/img_won.gif" style="margin-top:3px" /></div>
				  <div class="box_id">'.$row['item_lastbider'].'</div>
				  </div>
				  </div>';
			$i++;
			++$cnt;
		}
		if($i == 0)//아이템이 하나도 없으면
			echo '<div class="box_bg" id="box_"><img src="../img/bg_box_nodata.gif" border="0"></div>';
	}

	function closeditem_pagenation($num, $option){
		include "define_battle.php";
		$page_scale = 9;//한페이지당 보일 목록의 갯수
		
		$mainitem_cnt = mainitem_pagecount($option);

		if ($mainitem_cnt%$page_scale == 0)    
			$mainitem_pcnt = floor($mainitem_cnt/$page_scale)-1;     
		else
			$mainitem_pcnt = floor($mainitem_cnt/$page_scale);
		
		if($option == '1_last' || $option == '2_last' || $option == '3_last' || $option == '4_last' )
			$str1 = "select * from BBanana_items where item_expired < unix_timestamp(now()) and item_id like '".substr($option,0,1)."%' order by item_id DESC limit ".($num*$page_scale).", ".$page_scale;
		else
			$str1 = "select * from BBanana_items where item_expired < unix_timestamp(now()) order by item_id DESC limit ".($num*$page_scale).", ".$page_scale;
		
		$first_page = 'ClosedItemList(0, \''.$option.'\')';
		$next_page = 'ClosedItemList_next(\''.$option.'\')';
		$prev_page = 'ClosedItemList_prev(\''.$option.'\')';
		$last_page = 'ClosedItemList('.$mainitem_pcnt.', \''.$option.'\')';
		
		$sql=mysql_query($str1) or die(mysql_error()); 
		
		echo '<div id="items" style="height:590px;">';
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			if($row['item_lastbider'] && $row['item_lastbider'] != '-'){
				//$sql2=mysql_query("select COUNT('no') as cnt from BBanana_bids where item_id='".$row['item_id']."' and bider_id='".$row['item_lastbider']."'") or die(mysql_error());
				$sql2=mysql_query("select bid_count as cnt from BBanana_view_bids where item_id='".$row['item_id']."' and bider_id='".$row['item_lastbider']."'") or die(mysql_error());
				$row2=mysql_fetch_array($sql2);
				
				if ($row['item_rrp']!=0) {
					if($row2['cnt']) $saveRate = ' ('.round((1-(($row2['cnt']*BANANA_PRICE+$row['item_price'])/$row['item_rrp']))*100).'%)';
					else $saveRate = '';
				}
			}else
				$saveRate = '';

			echo '<div class="box_bg_closed" id="box_closed'.$i.'">
				  <div class="box_padding">
				  <div class="box_title"><a href="sub.html?sid='.$row['item_id'].'">'.$row['item_sname'].'</a></div>
				  <div class="box_item_img"><a href="sub.html?sid='.$row['item_id'].'"><img src="../'.$row['item_img'].'" width="122" height="122" border="0"></a></div>
				  <div class="box_time" id="time_'.$row['item_id'].'"><img src="../img/img_auction_end.gif"></div>
				  <div class="box_price" id="price'.$row['item_id'].'"><span class="box_price_in">'.number_format($row['item_price']).'</span><img src="../img/img_won.gif" style="margin-top:3px" /></div>
				  <div class="box_id">'.$row['item_lastbider'].$saveRate.'</div>
				  </div>
				  </div>';
			$i++;
			++$cnt;
		}
		if($i == 0)//아이템이 하나도 없으면
			echo '<div class="box_bg" id="box_"><img src="../img/bg_box_nodata.gif" border="0"></div>';

		echo '</div>';

		if($num == 0)//처음 페이지 이면..
			echo '<div style="clear:both;float:center;padding-top:18px;"><span><img src="../img/btn_page_first.gif" border="0"/></span><span><img src="../img/btn_page_prev.gif" border="0"/>&nbsp;&nbsp;</span>';
		else
			echo '<div style="clear:both;float:center;padding-top:18px;"><span><a onmousedown="'.$first_page.'" style="cursor:pointer"><img src="../img/btn_page_first.gif" name="btn_page_first" id="btn_page_first" onmouseover=javascript:btn_page_first.src="../img/btn_page_first_o.gif"; onmouseout=javascript:btn_page_first.src="../img/btn_page_first.gif"; border="0"/></a></span><span><a onmousedown="'.$prev_page.'" style="cursor:pointer"><img src="../img/btn_page_prev.gif" name="btn_page_prev" id="btn_page_prev" onmouseover=javascript:btn_page_prev.src="../img/btn_page_prev_o.gif"; onmouseout=javascript:btn_page_prev.src="../img/btn_page_prev.gif"; border="0"/></a>&nbsp;&nbsp;</span>';
	
	for($i=0;$i<=$mainitem_pcnt;$i++){
		if($num == $i) echo '<span><img src="../img/btn_page_thumb_s.gif" border="0"/></span>';
		else{
			$goto_page = 'ClosedItemList('.$i.', \''.$option.'\')';

			echo '<span><a onmousedown="'.$goto_page.'" style="cursor:pointer"><img src="../img/btn_page_thumb.gif" name="btn_page_thumb'.$i.'" id="btn_page_thumb'.$i.'" onmouseover=javascript:btn_page_thumb'.$i.'.src="../img/btn_page_thumb_o.gif"; onmouseout=javascript:btn_page_thumb'.$i.'.src="../img/btn_page_thumb.gif"; border="0"/></a></span>';
		}
	}
		if($num == $mainitem_pcnt)//마지막페이지 이면..
			echo '<span>&nbsp;&nbsp;<img src="../img/btn_page_next.gif" border="0"/></span><span><img src="../img/btn_page_last.gif" border="0"/></span>';
		else
			echo '<span>&nbsp;&nbsp;<a onmousedown="'.$next_page.'" style="cursor:pointer"><img src="../img/btn_page_next.gif" name="btn_page_next" id="btn_page_next" onmouseover=javascript:btn_page_next.src="../img/btn_page_next_o.gif"; onmouseout=javascript:btn_page_next.src="../img/btn_page_next.gif"; border="0"/></a></span><span><a onmousedown="'.$last_page.'" style="cursor:pointer"><img src="../img/btn_page_last.gif" name="btn_page_last" id="btn_page_last" onmouseover=javascript:btn_page_last.src="../img/btn_page_last_o.gif"; onmouseout=javascript:btn_page_last.src="../img/btn_page_last.gif"; border="0"/></a></span></div>';
	}
	
	$sql_winner=mysql_query("select * from BBanana_winners order by RAND() LIMIT 1") or die(mysql_error());
	$row_winner=mysql_fetch_array($sql_winner);
?>
