<?
	if($_POST['sid'] != '' && $_POST['add'] != ''){
		
	include './connect.php';
	

	$query = "UPDATE C_datalist SET c_add = '".geocodingByDaum($_POST['add'])."' where no = '".$_POST['sid']."';";
	$sql=mysql_query($query) or die(mysql_error()); 
	
	if($sql) echo "ok";
	else echo "fail";
	mysql_close($connect);
	
	}

	function geocodingByDaum($add){ //�ּҰ��� ����, �浵 ������ �ٲ��ִ� �Լ�
		if($add == ""){//�ּҰ��� ������ �ѱ� ����,�浵�� �ҷ��´�.
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