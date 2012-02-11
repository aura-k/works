<?
	include '../php/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>쿠폰셔틀</title>
<link type="text/css" href="../css/common.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="../img/favi.ico" />
<script type='text/javascript' src='../js/jquery-1.4.2.min.js'></script>
<script type="text/javascript" src="../js/jquery.countdown.min.js"></script>
</head>

<body>
<?
		$sql=mysql_query("SELECT * FROM `C_datalist` as A
							where c_date = (SELECT MAX(c_date) FROM `C_datalist` where c_name = A.c_name) order by c_people desc") or die(mysql_error());
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){

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
                <?	if($cnt == 0 || $cnt == 1 || $cnt == 2) echo '<div class="hot"><img src="../img/ico_hot.gif"/></div>'; ?>
                <table class="bg_box" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td width="488"><span class="img_wrap"><a href="<?=$row['c_url']?>" target="_blank"><img src="<?=$row['c_img']?>" class="main_img" alt="<?=$row['c_title']?>" title="<?=$row['c_title']?>"/></a><div class="btn_map_l"><a  onclick="go('map', '<?=$row['c_name']?>')" style="cursor:pointer"><img src="../img/btn_map_link.gif" title="지도로 보기" alt="지도로 보기"/></a></div>
                    </span></td>
                    <td width="415" style="padding:15px 15px 15px 0;" valign="top">
                        <table width="400"  height="120" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="b" height="30"><?=$row['c_title']?></td>
                          </tr>
                          <tr>
                            <td valign="top"><?=$row['c_comment']?></td>
                          </tr>
                      </table>
                        <table width="414"  height="112" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
                          <tr>
                            <td width="205" class="b">
                            <table width="200" border="0" cellspacing="0" cellpadding="0" align="right" class="price" >
                              <tr>
                                <td id="time_<?=$row['c_name']?>" style="cursor:help;" alt="해당 업체 시간과 다소 차이가 있을 수 있습니다." title="해당 업체 시간과 다소 차이가 있을 수 있습니다."><?=$prn_time?></td>
                              </tr>
                              <tr>
                                <td style="cursor:help;" alt="실시간 구매인원 상황이 아닙니다." title="실시간 구매인원 상황이 아닙니다."><?=$row['c_people']?> 명</td>
                              </tr>
                              <tr>
                                <td><?=round($row['c_rate'])?> %</td>
                              </tr>
                              <tr>
                                <td class="save"><span class="line"><?=number_format($row['c_ori_price'])?> 원</span> → <?=number_format($row['c_price'])?> 원</td>
                              </tr>
                            </table>
                            </td>
                            <td align="center"><a href="<?=$row['c_url']?>" target="_blank"><img src="../img/com_<?=substr($row['c_name'],0,2)?>.gif"/></a></td>
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
				<script>
					var newYear = new Date(); 
					newYear = new Date(<?=date('Y',$row['c_time'])?>, <?=date('m',$row['c_time'])-1?>, <?=date('d',$row['c_time'])?>, <?=date('H',$row['c_time'])?>, <?=date('i',$row['c_time'])?>, <?=date('s',$row['c_time'])?>); 
					$('#time_<?=$row['c_name']?>').countdown({until: newYear, format: 'HMS', compact: true, layout: '{hnn}시간 {mnn}분 {snn}초'});
				</script>
                <!--hot박스-->
<?	
			$i++;
			++$cnt;
		}
?>
                 <!--박스
                <table class="bg_box" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td width="487"><img src="../img/img_item.jpg" class="main_img"/></td>
                    <td width="416" style="padding:15px 15px 15px 0;" valign="top">
                        <table width="400"  height="92" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="b" height="30">티켓몬스터</td>
                          </tr>
                          <tr>
                            <td valign="top">안뇽안뇽안뇽안뇽안뇽안뇽안뇽안뇽안뇽안뇽안뇽안뇽</td>
                          </tr>
                      </table>
                        <table width="414"  height="140" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
                          <tr>
                            <td width="205" class="b">
                            <table width="120" border="0" cellspacing="0" cellpadding="0" align="right" class="price" >
                              <tr>
                                <td>05 : 03 : 10</td>
                              </tr>
                              <tr>
                                <td>505 명</td>
                              </tr>
                              <tr>
                                <td class="line">11,000 원</td>
                              </tr>
                              <tr>
                                <td>10 %</td>
                              </tr>
                              <tr>
                                <td class="save">100 원</td>
                              </tr>
                            </table>
                            </td>
                            <td align="center"><a href="#"><img src="../img/com_oneday.gif"/></a></td>
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
                박스-->
				
</body>
</html>
<?
	mysql_close($connect);
?>