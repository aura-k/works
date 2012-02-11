<?	
	session_start(); 
	include "./php/m_connect.php";
	include "./php/m_shortURL.php";
	include "toolbar.php";
		$bitlyURL = shortenURL($_GET['sid']);
		$sql=mysql_query("select * from BBanana_items where item_id='".$_GET['sid']."'") or die(mysql_error());
		$row=mysql_fetch_array($sql);
	
		$now = mktime();
		$item_gaptime = $row['item_expired']-$now;
		if($item_gaptime > 0){
			$item_hour = floor($item_gaptime/3600);
			$item_min = floor($item_gaptime%3600/60);
			$item_sec = $item_gaptime%3600%60;
		}else{
			$item_hour = 0;
			$item_min = 0;
			$item_sec = 0;
		}

		if($item_hour < 10) $item_hour = "0".$item_hour;
		if($item_min < 10) $item_min = "0".$item_min;
		if($item_sec < 10) $item_sec = "0".$item_sec;

		$photo_cnt=0;
		for($i=1;$i<=5;$i++){
			if($row['item_photo'.$i] == ''){
				//아무것도 안함
			}else{
				$sub_photo[$i] = $row['item_photo'.$i];
				$photo_cnt++;
			}
		}
?>
<div id="history">
    <?=toolbar(6);//툴바?>
    <h2 style="text-align:center">Battle History</h2>
    <ul class="rounded">
        <li class="his_1"><img src="./img/img_h_time_y.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time0">-- . -- -- : -- : -- . --</span>
		<span class="sub_bid_img0"><img src="./img/img_h_peo_y.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id0">-</span>
		(<span class="sub_bid_ip0">-</span>)</li>
        <li class="his_2"><img src="./img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time1">-- . -- -- : -- : -- . --</span>
		<span class="sub_bid_img1"><img src="./img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id1">-</span>
		(<span class="sub_bid_ip1">-</span>)</li>
        <li class="his_2"><img src="./img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time2">-- . -- -- : -- : -- . --</span>
		<span class="sub_bid_img2"><img src="./img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id2">-</span>
		(<span class="sub_bid_ip2">-</span>)</li>
        <li class="his_2"><img src="./img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time3">-- . -- -- : -- : -- . --</span>
		<span class="sub_bid_img3"><img src="./img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id3">-</span>
		(<span class="sub_bid_ip3">-</span>)</li>
        <li class="his_2"><img src="./img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time4">-- . -- -- : -- : -- . --</span>
		<span class="sub_bid_img4"><img src="./img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id4">-</span>
		(<span class="sub_bid_ip4">-</span>)</li>
        <li class="his_2"><img src="./img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time5">-- . -- -- : -- : -- . --</span>
		<span class="sub_bid_img5"><img src="./img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id5">-</span>
		(<span class="sub_bid_ip5">-</span>)</li>
    </ul>
    <a href="#" class="grayButton goback" style="margin:0 10px 15px 10px;">확인</a>
</div>