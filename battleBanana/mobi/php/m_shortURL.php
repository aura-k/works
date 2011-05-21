<?	
	function shortenURL($sid){
		$target = "http://api.bit.ly/v3/shorten?login=ke2n&apiKey=R_65156f700cdacdefd7177e8d752b2720&longUrl=http://battlebanana.com/html/sub.html?sid=".$sid."&format=json";
		$url = file_get_contents($target);
		$location = json_decode($url);

		$add = $location->data->url;

		return $add;
	}
?>