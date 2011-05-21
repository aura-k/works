<?
	include '../php/connect.php';

	function geocodingByDaum($add){ //주소값을 위도, 경도 값으로 바꿔주는 함수
		if($add == ""){//주소값이 없으면 한국 위도,경도를 불러온다.
			$lat = 37.538440047820686;
			$lng = 126.9920444373374;

			return $lat.", ".$lng;
		}
		$target ="http://apis.daum.net/maps/addr2coord?apikey=213588fa994cfce16f7350dbec0d9969ca7056eb&q=".urlencode($add)."&output=json";
		
		try{
			$url = file_get_contents($target);
		
			$location = json_decode($url);
		
			$lat = $location->channel->item[0]->point_y;
			$lng = $location->channel->item[0]->point_x;
		}catch(Exception $e){
			$lat = 37.538440047820686;
			$lng = 126.9920444373374;
		}
		return $lat.", ".$lng;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>쿠폰셔틀</title>
<link type="text/css" href="../css/common.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="../img/favi.ico" />
<script type='text/javascript' src='../js/jquery-1.4.2.min.js'></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps2.js?apikey=213588fa994cfce16f7350dbec0d9969ca7056eb"></script> 
</head>
<script type="text/javascript"> 
	$(document).ready(function () {
		var points = new Array();
		var infowindows = new Array();
		var markers = new Array();
<?
		$sql=mysql_query("SELECT * FROM `C_datalist` as A
							where c_date = (SELECT MAX(c_date) FROM `C_datalist` where c_name = A.c_name) order by c_people desc") or die(mysql_error());
		$i=0;
		$cnt=0;
		while($row=mysql_fetch_array($sql)){
?>
		points[points.length] = new DLatLng(<?=$row['c_add']?>);
		infowindows[infowindows.length] = new DInfoWindow("https://battlebanana.com/shuttle/html/map_attri.php?cp=<?=$row['c_name']?>", { width: 230, height: 210 });
<?
		}	
?>
		var bounds = getBounds(points);
 
		var map = new DMap("Map", { level: 3, width: 900, height: 580 });
		map.addControl(new DMapTypeControl());
		map.addControl(new DZoomControl());
		map.setBound(bounds.min.x, bounds.min.y, bounds.max.x, bounds.max.y);
		map.setCenter(new DLatLng(37.538440047820686, 126.9920444373374), 8);
		for (var i=0; i<points.length; i++) {
			var mark = new DMark(points[i], { infowindow: infowindows[i] });
			map.addOverlay(mark);
			if (i == 0) infowindows[i].show();
		}
	});
 
	function getBounds(points) {
		var min = new DPoint(points[0].x, points[0].y);
		var max = new DPoint(points[0].x, points[0].y);
 
		$(points).each(function(index, e) {
			if(e.x < min.x) min.x = e.x;
			if(e.x > max.x) max.x = e.x;
			if(e.y < min.y) min.y = e.y;
			if(e.y > max.y) max.y = e.y;
		});
		min.x -= 0.01;
		max.x += 0.01;
 
		return {
			min: min,
			max: max
		};
	};
</script> 
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
                            <td align="right"><a href="../html/main.php"><img src="../img/btn_list.gif" name="btn_list" id="btn_list" onmouseover="javascript:btn_list.src='../img/btn_list_o.gif';" onmouseup="javascript:btn_list.src='../img/btn_list_o.gif';" onmouseout="javascript:btn_list.src='../img/btn_list.gif';" onmousedown="javascript:btn_list.src='../img/btn_list_c.gif';"></a></td>
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
                            <td><img src="../img/btn_map_c.gif"></td>
                          </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <!--박스-->
                <div class="wrap">
                  <table width="920" height="600" style="margin-top:20px;" cellspacing="1" cellpadding="0" bgcolor="#d0d0d0" align="center">
                  <tr bgcolor="#f2f2f2">
                    <td><div id="Map" style="width: 670px; height: 600px; margin:10px auto"></div></td>
                  </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td class="bg_shadow">&nbsp;</td>
                  </tr>
                </table>
              </div>
                <!--박스-->
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
<?
	mysql_close($connect);
?>