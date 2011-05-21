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
<div id="item_<?=$_GET['sid']?>" class="item">
<?=toolbar(6);//툴바?>	

    <h2 style="text-align:center"><?=$row['item_fname']?></h2>
    <ul class="rounded_c" >
        <li>
        <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto">
          <tr>
            <td><? for($i=1;$i<=$photo_cnt;$i++){
					if($i==1)
						echo '<div id="sub_mainphoto_'.$i.'_'.$_GET['sid'].'" class="sub_img"><img src="../'.$sub_photo[$i].'"/></div>';
					else
						echo '<div id="sub_mainphoto_'.$i.'_'.$_GET['sid'].'" class="sub_img" style="display:none;"><img src="../'.$sub_photo[$i].'"/></div>';
					}
				?></td>
			
            <td style="padding-left:16px;">
			<? for($i=1;$i<=$photo_cnt;$i++){
				if($i==1)
					echo '<div class="sub_photo_num_'.$i.'" style="height:40px" onmousedown="subChangePhoto(\''.$_GET['sid'].'\', '.$i.')"><img src="./img/btn_thumb_o.png" name="btn_thumb'.$i.'" id="btn_thumb'.$i.'" border="0"/></div>';
				else
					echo '<div class="sub_photo_num_'.$i.'" style="height:40px" onmousedown="subChangePhoto(\''.$_GET['sid'].'\', '.$i.')"><img src="./img/btn_thumb.png" name="btn_thumb'.$i.'" id="btn_thumb'.$i.'" border="0"/></div>';
					
			}?>
            </td>
          </tr>
        </table>

        </li>
    </ul>
     <div style=" text-align:center; margin:0 auto; width:284px; height:67px;background-image:url(./img/bg_time.png); font-size:57px; font-weight:bold;" class="sub_item_expired" id="sub_item_expired"><?=$item_hour?>&nbsp; <?=$item_min?>&nbsp; <?=$item_sec?></div>
    <ul class="rounded">
        <li class="arrow"><a class="href" href="#history_<?=$_GET['sid']?>"><img src="./img/img_now_win.png" align="absmiddle"><div style="color:#f0efef; text-align:center;"><img src="./img/img_crown.png" align="absmiddle">&nbsp; <span class="sub_item_bider"><?=$row['item_lastbider']?></span></div></a></li>
        <li><img src="./img/img_price.png" align="absmiddle"><div style="color:#f0efef; text-align:center; font-size:30px;" ><span class="sub_item_price_rrp"><?=number_format($row['item_rrp'])?></span> 원</div></li>
        <li><img src="./img/img_now_price.png" align="absmiddle"><div style="color:#ffbb36; text-align:center; font-size:30px;" ><span class="sub_item_price"><?=number_format($row['item_price'])?></span></div></li>
    </ul>
	<ul class="rounded">
<?                
				if($_SESSION["ID"]){
					echo '<li class="y"><a onclick="goBattle(\''.$_GET['sid'].'\')"><img src="./img/btn_battle.png" align="absmiddle"></a></li>
					<li class="auto_layer" style="margin:0;padding:0"></li>
					<li class="y" id="rewrite_auto_layer"><a onclick="openAutoBattle(\''.$_GET['sid'].'\')"><img src="./img/btn_auto.png"></a></li>';
				}else{
					echo '<li class="y"><a href="#about" class="pop"><img src="./img/btn_battle.png" align="absmiddle"></a></li>
					<li class="y"><a href="#about" class="pop"><img src="./img/btn_auto.png"></a></li>';
				}
?>
    
        
    </ul>
    <ul class="rounded">
        <li class="arrow"><a onclick="makeFavorite('<?=$_GET['sid']?>')"><img src="./img/btn_bookmark_o.png" align="absmiddle">&nbsp; 관심경매에 등록하기</a></li>
        <li class="arrow"><a href="mailto:?subject=[배틀바나나] <?=$row['item_fname']?>의 경매가 진행중 입니다.&body=현재 <?=$row['item_fname']?>의 경매가 진행중입니다.\n
		경매마감까지 <?=$item_hour?>시간 <?=$item_min?>분 <?=$item_sec?>초 남았습니다. (메일 작성시간 기준)\n
		경매주소 : <?=$bitlyURL?> \n" target="_blank" class="pop"><img src="./img/btn_mail_o.png" align="absmiddle">&nbsp; Email로 공유하기</a></li>
        <li class="arrow"><a href="http://twitter.com/home?status=[배틀바나나]<?=$row['item_fname']?> @Battlebanana:<?=$bitlyURL?>" target="_blank"><img src="./img/btn_twit_o.png" align="absmiddle">&nbsp; 트위터로 공유하기</a></li>
    </ul>
   
    <ul class="rounded_c">
        <li style="text-align:left;color:#CACACA">
        <!-- w640 h385<object width="275" height="165"><param name="movie" value="http://www.youtube.com/v/YsmKY66peKc&hl=ko_KR&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/YsmKY66peKc&hl=ko_KR&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="275" height="165"></embed></object>
        <p style="font-size:12px; text-align:left; color:#FFFFFF;">이 물건은 어쩌구저쩌구어쩌구저쩌구어쩌구저쩌구<br/>이 물건은 어쩌구어쩌구저쩌구어쩌구저쩌구<br/>이 물건은 어쩌구어쩌구저쩌구어쩌구저쩌구<br/></p> -->
		<?
		preg_match_all('/\'file\',\'(.*)\'\)/U', $row['item_text'], $get_movie_url);

		if($get_movie_url[1][0])
		echo "<embed type=\"application/x-shockwave-flash\" width=\"275\" height=\"165\" src=\"".$get_movie_url[1][0]."\" allowfullscreen=\"true\" allowscriptaccess=\"always\" wmode=\"opaque\">";

		echo $row['item_text'];
		?>
        </li>
    </ul>
</div>

<div id="history">
    <?=toolbar(6);//툴바?>
    <h2 style="text-align:center"><?=$row['item_fname']?></h2>
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