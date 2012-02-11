<?
	$get_url = strstr($QUERY_STRING, "http");
	$get_cp_id = $_GET['id'];
	if($get_url != "" && $get_cp_id != ""){
		include 'connect.php';
		$query = "INSERT INTO C_click_log(`cp_id`, `ip_num`, `cp_url`, `click_date`) 
					VALUES(
						'".$get_cp_id."',
						'".$REMOTE_ADDR."',
						'".$get_url."',
						'".mktime()."'
					);";
		$result = @mysql_query($query);
		mysql_close($connect);

		echo "<script>document.location.href='".$get_url."';</script>"; 
	}
?>