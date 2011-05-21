<?
$target ="http://apis.daum.net/maps/addr2coord?apikey=213588fa994cfce16f7350dbec0d9969ca7056eb&q=½Ö¹®2µ¿&output=json";
		
			$url = file_get_contents($target);
		
			$location = json_decode($url);
			echo $location;
			$lat = $location->channel->item[0]->point_y;
			$lng = $location->channel->item[0]->point_x;
?>