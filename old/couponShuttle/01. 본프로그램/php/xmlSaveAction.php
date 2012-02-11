<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
include "connect.php";
include "xml_parser.php";
$now_date = mktime(00,00,00,date('m'),date('d'),date('Y'));

$res = @mysql_query("SELECT * FROM C_xml_list where is_active = 'yes'");

$i=0;
while($row = mysql_fetch_array($res)){
	$getXML[$i] = $row['cp_url'];
	$getSname[$i] = $row['cp_id'];
	$i++;
}

for($i=0; $i<sizeof($getXML); $i++){
	$xml = file_get_contents($getXML[$i]);
	$parser = new XMLParser(trim($xml));
	$parser->Parse();
	
	$add_name = 0;
	foreach($parser->document->deals[0]->deal as $product){
		$sc_title = $product->title[0]->tagData;
		$sc_org_price = $product->original[0]->tagData;
		$sc_sale_price = $product->price[0]->tagData;
		$sc_rate = $product->discount[0]->tagData;
		$sc_nowcnt = $product->now_count[0]->tagData;
		$sc_img = $product->images[0]->image[0]->tagData;
		$sc_url = $product->url[0]->tagData;
		$sc_add = $product->shops[0]->shop[0]->shop_address[0]->tagData;
		$sc_latitude = $product->shops[0]->shop[0]->latitude[0]->tagData;
		$sc_longitude = $product->shops[0]->shop[0]->longitude[0]->tagData;
		$sc_cp_name = $product->shops[0]->shop[0]->shop_name[0]->tagData;
		$sc_cp_phone = $product->shops[0]->shop[0]->shop_tel[0]->tagData;

		if($add_name >= 1) $sc_cp_id = $getSname[$i].$add_name;
		else $sc_cp_id = $getSname[$i];
		
		if($sc_latitude && $sc_longitude){
			$insert_add = $sc_latitude.", ".$sc_longitude;
		}else{
			if($sc_add == "") $insert_add = "";
			else $insert_add = geocodingByGoogle($sc_add);
		}

		$result = @mysql_query("SELECT * FROM C_xml_datalist where c_date = '".$now_date."' and c_name = '".$sc_cp_id."'");
		$row = mysql_fetch_array($result);

		if(!$row){
			$query = "INSERT INTO C_xml_datalist(`c_name`, `c_url`, `c_title`, `c_ori_price`, `c_price`, `c_rate`, `c_img`, `c_people`, `c_date`, `c_add`, `c_cp_name`, `c_cp_phone`) 
						VALUES(
							'".$sc_cp_id."',
							'".$sc_url."',
							'".$sc_title."',
							'".$sc_org_price."',
							'".$sc_sale_price."',
							'".$sc_rate."',
							'".$sc_img."',
							'".$sc_nowcnt."',
							'".$now_date."',
							'".$insert_add."',
							'".$sc_cp_name."',
							'".$sc_cp_phone."'
						);";
			echo $query."<br>";
			$result = @mysql_query($query);
		}else{
			$query = "UPDATE C_xml_datalist SET 
						c_url = '".$sc_url."',
						c_title = '".$sc_title."',
						c_ori_price = '".$sc_org_price."',
						c_price = '".$sc_sale_price."',
						c_rate = '".$sc_rate."',
						c_img = '".$sc_img."',
						c_people = '".$sc_nowcnt."',
						c_cp_name = '".$sc_cp_name."',
						c_cp_phone = '".$sc_cp_phone."'
					  where c_date = '".$now_date."' and c_name = '".$sc_cp_id."';";
			echo $query."<br>";
			$sql=mysql_query($query) or die(mysql_error()); 
		}
		
		$add_name++;
	}
}
mysql_close($connect);

function geocodingByGoogle($add){
		if($add == ""){//주소값이 없으면 한국 위도,경도를 불러온다.
			$lat = 37.538440047820686;
			$lng = 126.9920444373374;

			return $lat.", ".$lng;
		}
		$target ="http://maps.google.co.kr/maps/api/geocode/json?address=".urlencode($add)."&sensor=true";
		
		try{
			$url = file_get_contents($target);
		
			$location = json_decode($url);
		
			$lat = $location->results[0]->geometry->location->lat;
			$lng = $location->results[0]->geometry->location->lng;
		}catch(Exception $e){
			$lat = 37.538440047820686;
			$lng = 126.9920444373374;
		}
		return $lat.", ".$lng;
}
?>