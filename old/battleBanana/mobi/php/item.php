<?
	include "../php/connect.php";
	session_start(); 
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
			$battleButton = "<img src=\"../img/sub/btn_end.gif\" border=0>";
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
    <div class="toolbar">
        <h1><a class="goback" href="#home"><img src="./themes/jqt/img/img_logo.png"></a></h1>
		<a class="button_help slideup" id="infoButton">&nbsp;?&nbsp;</a>
<?                
				if($_SESSION["ID"]){
					echo '<a class="button slideup" id="infoButton" href="#bb_menu">메뉴</a>';
				}else{
					echo '<a class="button pop" id="infoButton" href="#about">로그인</a>';
				}
?>
    </div>

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
					echo '<div class="sub_photo_num_'.$i.'" style="height:40px" onmousedown="subChangePhoto(\''.$_GET['sid'].'\', '.$i.')"><img src="./themes/jqt/img/btn_thumb_o.png" name="btn_thumb'.$i.'" id="btn_thumb'.$i.'" border="0"/></div>';
				else
					echo '<div class="sub_photo_num_'.$i.'" style="height:40px" onmousedown="subChangePhoto(\''.$_GET['sid'].'\', '.$i.')"><img src="./themes/jqt/img/btn_thumb.png" name="btn_thumb'.$i.'" id="btn_thumb'.$i.'" border="0"/></div>';
					
			}?>
            </td>
          </tr>
        </table>

        </li>
    </ul>
     <div style=" text-align:center; margin:0 auto; width:284px; height:67px;background-image:url(./themes/jqt/img/bg_time.png); font-size:57px; font-weight:bold;" class="sub_item_expired"><?=$item_hour?>&nbsp; <?=$item_min?>&nbsp; <?=$item_sec?></div>
    <ul class="rounded">
        <li class="arrow"><a class="fade" href="#history_<?=$_GET['sid']?>"><img src="./themes/jqt/img/img_now_win.png" align="absmiddle"><div style="color:#f0efef; text-align:center;"><img src="./themes/jqt/img/img_crown.png" align="absmiddle">&nbsp; <div class="sub_item_bider"><?=$row['item_lastbider']?></div></div></a></li>
        <li><img src="./themes/jqt/img/img_price.png" align="absmiddle"><div style="color:#f0efef; text-align:center; font-size:30px;" ><span class="sub_item_price_rrp"><?=number_format($row['item_rrp'])?></span> 원</div></li>
        <li><img src="./themes/jqt/img/img_now_price.png" align="absmiddle"><div style="color:#ffbb36; text-align:center; font-size:30px;" ><span class="sub_item_price"><?=number_format($row['item_price'])?></span> 원</div></li>
    </ul>
	<ul class="rounded">
<?                
				if($_SESSION["ID"]){
					echo '<li class="y"><a onclick="goBattle(\''.$_GET['sid'].'\')"><img src="./themes/jqt/img/btn_battle.png" align="absmiddle"></a></li>
					<li class="auto_layer" style="margin:0;padding:0"></li>
					<li class="y" id="rewrite_auto_layer"><a onclick="openAutoBattle(\''.$_GET['sid'].'\')"><img src="./themes/jqt/img/btn_auto.png"></a></li>';
				}else{
					echo '<li class="y"><a href="#about" class="pop"><img src="./themes/jqt/img/btn_battle.png" align="absmiddle"></a></li>
					<li class="y"><a href="#about" class="pop"><img src="./themes/jqt/img/btn_auto.png"></a></li>';
				}
?>
    
        
    </ul>
    <ul class="rounded">
        <li class="arrow"><a href="#"><img src="./themes/jqt/img/btn_bookmark_o.png" align="absmiddle">&nbsp; 관심경매로 등록하기</a></li>
        <li class="arrow"><a href="#email_share" class="pop"><img src="./themes/jqt/img/btn_mail_o.png" align="absmiddle">&nbsp; Email로 공유하기</a></li>
        <li class="arrow"><a href="http://www.twitter.com/battlebanana" target="_blank"><img src="./themes/jqt/img/btn_twit_o.png" align="absmiddle">&nbsp; 트위터로 공유하기</a></li>
    </ul>
   
    <ul class="rounded_c">
        <li>
        <object width="275" height="165"><param name="movie" value="http://www.youtube.com/v/YsmKY66peKc&hl=ko_KR&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/YsmKY66peKc&hl=ko_KR&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="275" height="165"></embed></object>
        <p style="font-size:12px; text-align:left; color:#FFFFFF;">이 물건은 어쩌구저쩌구어쩌구저쩌구어쩌구저쩌구<br/>이 물건은 어쩌구어쩌구저쩌구어쩌구저쩌구<br/>이 물건은 어쩌구어쩌구저쩌구어쩌구저쩌구<br/></p>
        </li>
    </ul>
</div>


<div id="history">
    <div class="toolbar">
        <h1><a class="swap" href="#home"><img src="./themes/jqt/img/img_logo.png"></a></h1>
        <a class="button slideup" id="infoButton" href="#about">로그인</a>
    </div>

    <h2 style="text-align:center">Battle History</h2>
    <ul class="rounded">
        <li class="his_1"><img src="./themes/jqt/img/img_h_time_y.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time0">--.-- --:--:--.--</span>
		<span class="sub_bid_img0"><img src="./themes/jqt/img/img_h_peo_m_y.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id0">-</span>
		(<span class="sub_bid_ip0">-</span>)</li>
        <li class="his_2"><img src="./themes/jqt/img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time1">--.-- --:--:--.--</span>
		<span class="sub_bid_img1"><img src="./themes/jqt/img/img_h_peo_m.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id1">-</span>
		(<span class="sub_bid_ip1">-</span>)</li>
        <li class="his_2"><img src="./themes/jqt/img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time2">--.-- --:--:--.--</span>
		<span class="sub_bid_img2"><img src="./themes/jqt/img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id2">-</span>
		(<span class="sub_bid_ip2">-</span>)</li>
        <li class="his_2"><img src="./themes/jqt/img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time3">--.-- --:--:--.--</span>
		<span class="sub_bid_img3"><img src="./themes/jqt/img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id3">-</span>
		(<span class="sub_bid_ip3">-</span>)</li>
        <li class="his_2"><img src="./themes/jqt/img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time4">--.-- --:--:--.--</span>
		<span class="sub_bid_img4"><img src="./themes/jqt/img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id4">-</span>
		(<span class="sub_bid_ip4">-</span>)</li>
        <li class="his_2"><img src="./themes/jqt/img/img_h_time.png" style=" vertical-align:middle; padding-bottom:5px;">
		<span class="sub_bid_time5">--.-- --:--:--.--</span>
		<span class="sub_bid_img5"><img src="./themes/jqt/img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"></span>
		<span class="sub_bid_id5">-</span>
		(<span class="sub_bid_ip5">-</span>)</li>
    </ul>
    <a href="#" class="grayButton goback" style="margin:0 10px 15px 10px;">확인</a>
</div>