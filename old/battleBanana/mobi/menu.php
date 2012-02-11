<?	
	session_start(); 
	include "./php/m_connect.php";
	include "toolbar.php";
	include "./php/m_functions.php";

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
				
				if($option == "win") $prt_class = ' class="win"';
				else $prt_class = ' class="arrow"';
				
				$prt_link = ' class="href" href="#go_'.$row['item_id'].'"';
			}else{
				$prt_time = "경매종료";
				if($option == "win") $prt_class = ' class="win"';
				else $prt_class = '';
				$prt_link = ' onclick="alert(\'종료된 경매는 내용을 보실 수 없습니다.\')"';
			}
			
			

			$prn_itemid[$cnt] = $row['item_id'];
			

			if($option == "win"){
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
			}else{
				$prn_itemList .= '
					<li'.$prt_class.'>
		            	<span style="float:left"><a'.$prt_link.'>
		                <p id="mi_1">'.$row['item_fname'].'</p>
		                <table border="0" cellspacing="0" cellpadding="0">
		                  <tr>
		                    <td><div id="mi_p"><img src="../'.$row['item_img'].'"></div></td>
		                    <td><p id="mi_2" class="box_'.$row['item_id'].'">'.$prt_time.'</p><p id="mi_3"><span class="price_'.$row['item_id'].'">'.number_format($row['item_price']).'원</span></p><p id="mi_4" class="bider_'.$row['item_id'].'">'.$row['item_lastbider'].'</p></td>
		                  </tr>
		                </table>
						</a>
						</span>
						<span style="width:30px;height:30px;float:right" onclick="deleteFavorite(\''.$row['item_id'].'\')"><img src="./img/btn_fav_del_m.png" border="0"/></span>
					</li>';
			}

			++$cnt;
		}

		echo $prn_itemList;
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
<table border="0" cellspacing="1" cellpadding="0" style="width:100%;-webkit-border-radius: 5px 5px 0 0;" bgcolor="#dddddd">
<tr bgcolor="#D7D7D7" class="bananalist_title">
	<td height="30px" width="45px">날짜</td>
	<td>내용</td>
	<td width="35px">in</td>
	<td width="45px">out</td>
</tr>
<tr>
<td colspan="4">
<?=banana_pagenation(0,'ok')?>
</td>
</tr>
</table>
</div>
</div>



<div id="order">
<?=toolbar(4);//툴바?>	
<div style="margin:10px;">
<table border="0" cellspacing="1" cellpadding="0" style="width:100%;-webkit-border-radius: 5px 5px 0 0;" bgcolor="#dddddd">
<tr bgcolor="#D7D7D7" class="bananalist_title">
	<td height="30px" width="45px">날짜</td>
	<td>내용</td>
	<td width="70px">배송상태</td>
</tr>
<tr>
<td colspan="4">
<?=order_pagenation(0,'ok')?>
</td>
</tr>
</table>
</div>
</div>



<div id="closed">
<?=toolbar(5);//툴바?>	
<div style="margin:10px;">
<table border="0" cellspacing="1" cellpadding="0" style="width:100%;-webkit-border-radius: 5px 5px 0 0;" bgcolor="#dddddd">
<tr bgcolor="#D7D7D7" class="bananalist_title">
	<td height="30px" width="45px">종료일</td>
	<td>내용</td>
	<td width="50px">할인율</td>
</tr>
<tr>
<td colspan="4">
<?=closed_pagenation(0,'ok')?>
</td>
</tr>
</table>
</div>
</div>