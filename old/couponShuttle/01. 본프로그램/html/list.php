<?
	include '../php/connect.php';
	
	if($_GET['p'] == '') $num = 0;
	else $num = $_GET['p'];

	if($_GET['cate'] == '') $cate = "";
	else $cate = "and c_cate='".$_GET['cate']."'";

	if($_GET['region'] == '') $region = "";
	else $region = "and c_region='".$_GET['region']."'";

	$page_scale = 10;//한페이지당 보일 목록의 갯수
	
	$res = @mysql_query("SELECT * FROM C_xml_list");

	$i=0;
	while($row = mysql_fetch_array($res)){
		$getXML[$i] = $row['cp_url'];
		$getSname[$i] = $row['cp_id'];
		$i++;
	}

	$sql=mysql_query("SELECT * FROM `C_xml_datalist` as A
						where c_date = UNIX_TIMESTAMP( CURRENT_DATE( ) ) ".$cate." ".$region." order by c_people desc LIMIT ".($num*$page_scale).", ".$page_scale.";") or die(mysql_error());
	$i=0;
	$cnt=0;
	while($row=mysql_fetch_array($sql)){
		$res = @mysql_query("SELECT cp_name FROM C_xml_list where cp_id = '".substr($row['c_name'],0,2)."'");
		$cp = mysql_fetch_array($res);
		$remain_time = $row['c_time'] - mktime();
		$remain_hour = floor(trim($remain_time)/3600);
		$remain_min = floor(trim($remain_time)%3600/60);
		$remain_sec = floor(trim($remain_time)%60);
		if($remain_hour < 10) $remain_hour='0'.$remain_hour;
		if($remain_min < 10) $remain_min='0'.$remain_min;
		if($remain_sec < 10) $remain_sec='0'.$remain_sec;
			
		if($remain_time < 0) $prn_time = '00시간 00분 00초';
		else $prn_time = $remain_hour.'시간 '.$remain_min.'분 '.$remain_sec.'초';
?>

                <!--hot박스-->
                <div class="wrap">
                <?	if(($cnt == 0 || $cnt == 1 || $cnt == 2) && $num == 0) echo '<div class="hot"><img src="../img/ico_hot.gif"/></div>'; ?>
                <table class="bg_box" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td width="488"><span class="img_wrap"><a href="/php/go.php?id=<?=$row['c_name']?>&url=<?=$row['c_url']?>" target="_blank"><img src="<?=$row['c_img']?>" class="main_img" alt="<?=$row['c_title']?>" title="<?=$row['c_title']?>"/></a><div class="btn_map_l"><a  onclick="go('map', '<?=$row['c_name']?>')" style="cursor:pointer"><img src="../img/btn_map_link.gif" title="지도로 보기" alt="지도로 보기"/></a></div>
                    </span></td>
                    <td width="415" style="padding:15px 15px 15px 0;" valign="top">
                        <table width="410"  height="30" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="b" height="30"><?='['.$cp['cp_name'].'] '.$row['c_title']?></td>
                          </tr>
                      </table>
                      <table width="410"  height="64" border="0" cellspacing="0" cellpadding="0" style="margin-top:54px;">
                          <tr align="center" class="b">
                            <td width="60" class="rate"><?=round($row['c_rate'])?>%</td>
                            <td width="190" class="save"><span class="line"><?=number_format($row['c_ori_price'])?> 원</span><BR>→ <span class="price"><?=number_format($row['c_price'])?> 원</span></td>
                             <td style="cursor:help;" alt="실시간 구매인원 상황이 아닙니다." title="실시간 구매인원 상황이 아닙니다."><span class="num"><?=$row['c_people']?></span> 명이 구매했습니다.</td>
                          </tr>
                      </table>
                        <table width="414"  height="86" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
                          <tr>
                            <td align="center"><a href="/php/go.php?id=<?=$row['c_name']?>&url=<?=$row['c_url']?>" target="_blank"><img src="../img/com_<?=substr($row['c_name'],0,2)?>.gif"/></a></td>
                          </tr>
                       </table>
                    </td>
                  </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td class="bg_shadow">&nbsp;</td>
                  </tr>
                </table>
                </div>
                <!--hot박스-->
				<?	if($cnt == 9) echo '<div class="wrap" id="append_'.$num.'"><img src="/img/btn_more.gif" name="btn_more" id="btn_more" onmouseover="javascript:btn_more.src=\'/img/btn_more_o.gif\';" onmouseup="javascript:btn_more.src=\'/img/btn_more_o.gif\';" onmouseout="javascript:btn_more.src=\'/img/btn_more.gif\';" style="cursor:pointer" onclick="AppendList('.($num+1).')"></div>';
				?>
				
<?	
			$i++;
			++$cnt;
		}

	mysql_close($connect);
?>