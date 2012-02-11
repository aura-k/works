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
</head>

<body>
<table width="100%" height="276" border="0" cellspacing="0" cellpadding="0" style="background-image:url(../img/bg_main.gif); background-repeat:repeat-x;">
  <tr valign="top">
    <td>
        <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
                <table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <!-- <td width="338"> 추가시작-->
                    <td width="380">
                        <table width="360" border="0" cellspacing="0" cellpadding="0" align="right">
                          <tr>
                            <td height="146" align="right"><img src="../img/logo_l.gif" /></td>
                          </tr>
                          <tr>
                            <td align="right"><img src="../img/btn_list_c.gif" /></td>
                          </tr>
                        </table>
                    </td>
                    <!--< td width="338"> 추가끝-->
                    <td width="240"><a href="#"><img src="../img/logo.jpg" name="logo" id="logo" onmouseover="javascript:logo.src='../img/logo_o.jpg';" onmouseout="javascript:logo.src='../img/logo.jpg';"></a></td>
                    <td width="380">
                  	  <table width="360" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="146" align="left"><img src="../img/logo_r.gif" /></td>
                          </tr>
                          <tr>
                            <td><a href="../html/map.html"><img src="../img/btn_map.gif" name="btn_map" id="btn_map" onmouseover="javascript:btn_map.src='../img/btn_map_o.gif';" onmouseup="javascript:btn_map.src='../img/btn_map_o.gif';" onmouseout="javascript:btn_map.src='../img/btn_map.gif';" onmousedown="javascript:btn_map.src='../img/btn_map_c.gif';"></a></td>
                        </tr>
                        </table>
                    </td>
                  </tr>
                </table>
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
                <?	if($cnt == 0) echo '<div class="hot"><img src="../img/ico_hot.gif"/></div>'; ?>
                <table class="bg_box" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td width="488"><a href="<?=$row['c_url']?>" target="_blank"><img src="<?=$row['c_img']?>" class="main_img" /></a></td>
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
                                <td><?=$prn_time?></td>
                              </tr>
                              <tr>
                                <td><?=$row['c_people']?> 명</td>
                              </tr>
                              <tr>
                                <td><?=round($row['c_rate'])?> %</td>
                              </tr>
                              <tr>
                                <td class="save"><span class="line"><?=$row['c_ori_price']?> 원</span> → <?=$row['c_price']?> 원</td>
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
				<table class="btn_more" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td><a href="#"><img src="../img/btn_more.gif" name="btn_more" id="btn_more" onmouseover="javascript:btn_more.src='../img/btn_more_o.gif';" onmouseout="javascript:btn_more.src='../img/btn_more.gif';"></a></td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
        <!--상단메뉴끝-->
        
        </td>
        </tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:40px; background-color:#cecece">
  <tr>
    <td align="center" height="50">ⓒ 2010 쿠폰셔틀</td>
  </tr>
</table>


</body>
</html>
