<?//서브페이지의 각종 액션들 스크립팅
	include "popCheckLoged.php";
	include "connect.php";
	
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
	
	echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td valign=\"top\">";
	echo "<table width=\"690\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" style=\"margin:15px;\" bgcolor=\"#dddddd\">";
	echo "<tr bgcolor=\"#FFFFFF\" class=\"title\">";
	echo "<td width=\"120\" height=\"20\">날짜</td>";
	echo "<td width=\"294\">내용</td>";
	echo "<td width=\"90\">in</td>";
	echo "<td width=\"90\">out</td>";
	echo "</tr>";
	
	if($banana_cnt == 0){
			echo "<tr bgcolor=\"#FFFFFF\" class=\"con\">";
			echo "<td colspan='4' height='200'>내역이 없습니다.</td>";
			echo "</tr>";
	}else{
	$i=0;
	$cnt=0;
	while($row=mysql_fetch_array($sql)){
		if(preg_match('/B_/i', $row['item_id'])){//바나나 충전일때
			echo "<tr bgcolor=\"#FFF5E1\" class=\"con\">";
			echo "<td  height=\"20\">".date('Y-m-d H:i', intval($row['action_date']))."</td>";
			echo "<td class=\"text_br\">".$row['comment']."</td>";
			echo "<td class=\"text_grey\">".$row['banana_in']."</td>";
			echo "<td class=\"text_grey\">-</td>";
			echo "</tr>";
		}else if(preg_match('/BC_/i', $row['item_id'])){//바나나 충전 취소일때
			echo "<tr bgcolor=\"#FFFFFF\" class=\"con\">";
			echo "<td  height=\"20\">".date('Y-m-d H:i', intval($row['action_date']))."</td>";
			echo "<td class=\"text_br\" style='color:#FF6633'>".$row['comment']."</td>";
			echo "<td class=\"text_grey\">-</td>";
			echo "<td class=\"text_grey\">".$row['banana_out']."</td>";
			echo "</tr>";
		}else if(preg_match('/_auto/i', $row['item_id'])){//오토 배틀일때
			$str2 = "select auto_banana from BBanana_autobids where bider_id = '".$_SESSION['ID']."' and item_id = '".substr($row['item_id'],0,6)."';";
			$sql2=mysql_query($str2) or die(mysql_error());
			$row2=mysql_fetch_array($sql2);

			echo "<tr bgcolor=\"#FFFFFF\" class=\"con\">";
			echo "<td  height=\"20\">".date('Y-m-d H:i', intval($row['action_date']))."</td>";
			echo "<td class=\"text_br\"><a href=\"sub.html?sid=".substr($row['item_id'],0,6)."\">".$row['comment']."</a> <img src='../img/pop/btn_sign_auto.gif' border='0' align='top'></td>";
			echo "<td class=\"text_grey\">-</td>";
			echo "<td class=\"text_grey\" title=\"현재 ".$row['banana_out']."개 사용, ".$row2['auto_banana']."개 오토배틀 대기중\" alt=\"현재 ".$row['banana_out']."개 사용, ".$row2['auto_banana']."개 오토배틀 대기중\" style=\"cursor:pointer\" onclick=\"cancelAutoBattle_pop('".substr($row['item_id'],0,6)."', '".$row['comment']."')\">".$row['banana_out']." ← ".$row2['auto_banana']."</td>";
			echo "</tr>";
		}else{//일반 배틀일때
			echo "<tr bgcolor=\"#FFFFFF\" class=\"con\">";
			echo "<td  height=\"20\">".date('Y-m-d H:i', intval($row['action_date']))."</td>";
			echo "<td class=\"text_br\"><a href=\"sub.html?sid=".$row['item_id']."\">".$row['comment']."</a></td>";
			echo "<td class=\"text_grey\">-</td>";
			echo "<td class=\"text_grey\">".$row['banana_out']."</td>";
			echo "</tr>";
		}
		
		$i++;
		++$cnt;
	}
	}
	echo "</table></td></tr><tr><td height=\"40\" align=\"center\">";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"page\">
                  <tr>";
	for($i=0;$i<=$banana_pcnt;$i++){
		if($num == $i) echo "<td width='10'><div class='sub_photo_num_".$i."'><a href='#' onmousedown='bananalist(".$i.")' style='cursor:pointer'><img src='../img/btn_page_thumb_s.gif' border='0'/></a></div></td>";
		else echo "<td width='10'><div class='sub_photo_num_".$i."'><a href='#' onmousedown='bananalist(".$i.")' style='cursor:pointer'><img src='../img/btn_page_thumb.gif' name='btn_thumb".$i."' id='btn_thumb".$i."' onmouseover=javascript:btn_thumb".$i.".src='../img/btn_page_thumb_o.gif'; onmouseout=javascript:btn_thumb".$i.".src='../img/btn_page_thumb.gif'; border='0'/></a></div></td>";
	}
	echo "</tr>
                </table>
				</td>
			</tr>
			</table>";
}
?>