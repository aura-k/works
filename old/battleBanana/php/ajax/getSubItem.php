<?	
	header("Expires: 0");
    header("Last-Modified: " . gmdate("D, d, M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", true);
    header("Pragma: no-cache");
	session_start(); 

	include "../connect.php";
	include "../sess_func.php";

	$page = $_GET['p'];
	$sid =  $_GET['sid'];
	$page_type =  $_GET['p_type'];
	
	if(!$page || !$sid){
		echo "error";
		return;
	}
	$sql=mysql_query("select * from BBanana_items where item_expired >= unix_timestamp(now()) && item_id != '".$sid."' order by item_expired asc limit 0, 6") or die(mysql_error()); 

	
	
	$i=0;
	$cnt=0;
	while($row=mysql_fetch_array($sql)){
	
		$now = mktime();
		$item_num[$i] = $row['item_id'];
		$item_name[$i] = $row['item_sname'];
		$item_img[$i] = $row['item_img'];
		$item_expired[$i] = $row['item_expired'];
		$item_lastprice[$i] = number_format($row['item_price']);
		$item_lastbider[$i] = $row['item_lastbider'];
		$item_effect[$i] = "";
		$time_gap[$i] = $item_expired[$i] - $now;
		$remain_time[$i] = $time_gap[$i];
		if($time_gap[$i] < -5) $remain_time[$i] = '경매종료';
		if($time_gap[$i] <= 10) $item_effect[$i] = 'do';
		$i++;
		++$cnt;
		
	}

echo("{\"data\": {\"list\" : [");
		
		for($i=0; $i<$cnt; $i++){
			if($i == ($cnt-1)){
				echo("{\"sid\":\"".$item_num[$i]."\",");
				echo("\"sna\":\"".$item_name[$i]."\",");
				echo("\"img\":\"".$item_img[$i]."\",");
				echo("\"exp\":\"".$remain_time[$i]."\",");
				echo("\"lap\":\"".$item_lastprice[$i]."\",");
				echo("\"bid\":\"".$item_lastbider[$i]."\",");
				echo("\"eff\":\"".$item_effect[$i]."\"");
				echo("}");
			}else{
				echo("{\"sid\":\"".$item_num[$i]."\",");
				echo("\"sna\":\"".$item_name[$i]."\",");
				echo("\"img\":\"".$item_img[$i]."\",");
				echo("\"exp\":\"".$remain_time[$i]."\",");
				echo("\"lap\":\"".$item_lastprice[$i]."\",");
				echo("\"bid\":\"".$item_lastbider[$i]."\",");
				echo("\"eff\":\"".$item_effect[$i]."\"");
				echo("},");
			}
		}

echo("],\"page\" : 0}}");
mysql_close($connect);
?>