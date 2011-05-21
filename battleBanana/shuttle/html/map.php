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
<script type="text/javascript" src="http://apis.daum.net/maps/maps2.js?apikey=213588fa994cfce16f7350dbec0d9969ca7056eb"></script> 
</head>

<body>
<script type="text/javascript"> 
	$(document).ready(function () {
		var points = new Array();
		var infowindows = new Array();
		var markers = new Array();
<?
		$sql=mysql_query("SELECT * FROM `C_datalist` as A
							where c_date = (SELECT MAX(c_date) FROM `C_datalist` where c_name = A.c_name) and c_add != '' order by c_people desc") or die(mysql_error());
		$i=0;
		$cnt=0;
		$cp_num=0;
		$cp_coord=0;

		while($row=mysql_fetch_array($sql)){
			echo 'points['.$i.'] = new DLatLng('.$row['c_add'].');';
			echo 'infowindows['.$i.'] = new DInfoWindow("https://battlebanana.com/shuttle/html/map_attri.php?cp='.$row['c_name'].'", { width: 230, height: 210 });';
			
			if($row['c_name'] == $_GET['sid']){
				$cp_num=$cnt;
				$cp_coord=$row['c_add'];
			}

			$i++;
			++$cnt;
		}	
?>
		var bounds = getBounds(points);
 
		var map = new DMap("Map", { level: 1, width: 900, height: 580 });
		map.addControl(new DMapTypeControl());
		map.addControl(new DZoomControl());
		map.setBound(bounds.min.x, bounds.min.y, bounds.max.x, bounds.max.y);
<?
			if($_GET['sid'] == '' || $cp_coord == '')
				echo 'map.setCenter(new DLatLng(37.538440047820686, 126.9920444373374), 8);';
			else
				echo 'map.setCenter(new DLatLng('.$cp_coord.'), 2);';
?>
		
		for (var i=0; i<points.length; i++) {
			var mark = new DMark(points[i], { infowindow: infowindows[i] });
			map.addOverlay(mark);

		}
<?
			if($_GET['sid'] == '')
				echo 'infowindows[0].show();';
			else
				echo 'infowindows['.$cp_num.'].show();';
?>
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
        <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
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
        

</body>
</html>
<?
	mysql_close($connect);
?>