<?	
	session_start(); 
	include "./php/m_connect.php";
	include "toolbar.php";
	function print_itemList($option){
		$prn_itemList = '';
		$cnt = 0;
		
		switch($option){
			case "favorite":
				$sql=mysql_query("SELECT distinct a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_favorites As a, BBanana_items As b where a.item_id = b.item_id and a.user_id = '".$_SESSION['ID']."' order by b.item_expired DESC") or die(mysql_error());
				break;
			case "win":
				$sql=mysql_query("SELECT * from BBanana_items where item_expired <= unix_timestamp(now()) and item_lastbider = '".$_SESSION['ID']."' order by item_id DESC") or die(mysql_error());
				break;
		}
	
		while($row=mysql_fetch_array($sql)){
			$now = mktime();
			$item_gaptime = $row['item_expired']-$now;
			if($item_gaptime > 0){
				$item_hour = floor($item_gaptime/3600);
				$item_min = floor($item_gaptime%3600/60);
				$item_sec = $item_gaptime%3600%60;
				
				if($item_hour < 10) $item_hour = "0".$item_hour;
				if($item_min < 10) $item_min = "0".$item_min;
				if($item_sec < 10) $item_sec = "0".$item_sec;

				$prt_time = $item_hour.':'.$item_min.':'.$item_sec;
				$prt_class = ' class="arrow"';
				$prt_link = ' class="href" href="#go_'.$row['item_id'].'"';
			}else{
				$prt_time = "경매종료";
				$prt_class = '';
				$prt_link = ' onclick="alert(\'종료된 경매는 내용을 보실 수 없습니다.\')"';
			}
			
			

			$prn_itemid[$cnt] = $row['item_id'];

			$prn_itemList .= '
					<li'.$prt_class.'>
						<a'.$prt_link.'>
		            	<div>
		                <p id="mi_1">'.$row['item_fname'].'</p>
		                <table border="0" cellspacing="0" cellpadding="0">
		                  <tr>
		                    <td><div id="mi_p"><img src="../'.$row['item_img'].'"></div></td>
		                    <td><p id="mi_2" class="box_'.$row['item_id'].'">'.$prt_time.'</p><p id="mi_3"><span class="price_'.$row['item_id'].'">'.number_format($row['item_price']).'</span>원</p><p id="mi_4" class="bider_'.$row['item_id'].'">'.$row['item_lastbider'].'</p></td>
		                  </tr>
		                </table>
						</div>
						</a>
					</li>';

			++$cnt;
		}

		echo $prn_itemList;
	}

	function banana_pagecount($id){
		$sql=mysql_query("select COUNT(DISTINCT(`item_id`)) as cnt from BBanana_bananas where user_id ='".$id."';") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		return $row['cnt'];
	}

	function banana_pagenation($num){
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
		
		//echo '<table width="100%">';
		
		if($banana_cnt == 0){
				echo '<tr bgcolor="#FFFFFF" class="bananalist_con">
						<td colspan="4" height="300px">내역이 없습니다.</td>
						</tr>';
		}else{
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
			if(preg_match('/B_/i', $row['item_id'])){//바나나 충전일때
				echo '<tr bgcolor="#FFFFFF" class="bananalist_con">
						<td height="30px" width="50px">'.date('m/d H:i', intval($row['action_date'])).'</td>
						<td class="text_br">'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>
						<td class="text_grey">'.$row['banana_in'].'</td>
						<td class="text_grey">-</td>
						</tr>';
			}else if(preg_match('/BC_/i', $row['item_id'])){//바나나 충전 취소일때
				echo '<tr bgcolor="#FFFFFF" class="bananalist_con">
						<td height="30px" width="50px">'.date('m/d H:i', intval($row['action_date'])).'</td>
						<td class="text_br" style="color:#FF6633">'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>
						<td class="text_grey">-</td>
						<td class="text_grey">'.$row['banana_out'].'</td>
						</tr>';
			}else if(preg_match('/_auto/i', $row['item_id'])){//오토 배틀일때
				$str2 = "select auto_banana from BBanana_autobids where bider_id = '".$_SESSION['ID']."' and item_id = '".substr($row['item_id'],0,6)."';";
				$sql2=mysql_query($str2) or die(mysql_error());
				$row2=mysql_fetch_array($sql2);
				
				echo '<tr bgcolor="#FFFFFF" class="bananalist_con">
						<td height="30px" width="50px">'.date('m/d H:i', intval($row['action_date'])).'</td>
						<td class="text_br">'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'<img src="../img/pop/btn_sign_auto.gif" border="0" align="top"></td>
						<td class="text_grey">-</td>
						<td class="text_grey">'.$row['banana_out']." / ".$row2['auto_banana'].'</td>
						</tr>';
			}else{//일반 배틀일때
				echo '<tr bgcolor="#FFFFFF" class="bananalist_con">
						<td height="30px" width="50px">'.date('m/d H:i', intval($row['action_date'])).'</td>
						<td class="text_br">'.mb_strimwidth($row['comment'], 0, 30, "...", "UTF-8").'</td>
						<td class="text_grey">-</td>
						<td class="text_grey">'.$row['banana_out'].'</td>
						</tr>';
			}
			
			$i++;
			++$cnt;
		}
		}
		echo '<tr class="bananalist_add">
				<td colspan="4" height="30" id="insert_list_'.$num.'" onclick="append_bananalist('.$num.')">더보기('.($banana_cnt-$num*$page_scale).'건)</td>
				</tr></table>';
	}
?>
<div id="favorite">
<?=toolbar(1);//툴바?>	

<ul class="rounded">
	<?=print_itemList('favorite')?>
</ul>
</div>



<div id="win">
<?=toolbar(2);//툴바?>	

<ul class="rounded">
	<?=print_itemList('win')?>
</ul>
</div>



<div id="bananalist">
<?=toolbar(3);//툴바?>	
<div style="margin:10px;">
<table border="0" cellspacing="1" cellpadding="0" style="width:100%;-webkit-border-radius: 5px;" bgcolor="#dddddd">
<tr bgcolor="#D7D7D7" class="bananalist_title">
	<td height="30px">날짜</td>
	<td>내용</td>
	<td>in</td>
	<td>out</td>
</tr>
<tr>
<td colspan="4">
<?=banana_pagenation(0)?>
</td>
</tr>
</table>
</div>
</div>



<div id="order">
<?=toolbar(4);//툴바?>	
상품주문내역
</div>