<?
	if($_POST['sid'] != '' && $_POST['add'] != ''){
		
	include './connect.php';
	

	$query = "UPDATE C_datalist SET c_add = '".geocodingByDaum($_POST['add'])."' where no = '".$_POST['sid']."';";
	$sql=mysql_query($query) or die(mysql_error()); 
	
	if($sql) echo "ok";
	else echo "fail";
	mysql_close($connect);
	
	}

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