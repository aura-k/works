<?	
	header("Expires: 0");
    header("Last-Modified: " . gmdate("D, d, M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", true);
    header("Pragma: no-cache");
	session_start(); 

	include "../connect.php";
	include "../sess_func.php";
	include "../define_battle.php";

	$page = $_GET['p'];
	$sid =  $_GET['sid'];
	$cate =  $_GET['cate'];
	$page_type =  $_GET['p_type'];
	$option =  $_GET['op'];
	$get_banana = "";


	if($_SESSION['ID']){
		$sql=mysql_query("select banana from BBanana_users where user_id='".$_SESSION['ID']."'") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		$get_banana = $row['banana'];
	}

	if($page_type == "m"){//메인페이지에 뿌려줄 Json을 만드는 분기문
		if($option == ""){//option값이 없으면 그냥 일반 메인을 불러온다
		
			if($cate == null){
				$sql2=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired - unix_timestamp(now()) >= -3") or die(mysql_error()); 
				$row2=mysql_fetch_array($sql2);
				$page_num = intval(($row2['cnt']-1)/9 + 1);
				
				$sql=mysql_query("select * from BBanana_items where item_expired - unix_timestamp(now()) >= -3 order by item_expired ASC limit ".($page*9).", 9") or die(mysql_error()); 
			}else if($cate == 1 || $cate == 2 || $cate == 3 || $cate == 4 ){
				$sql2=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired - unix_timestamp(now()) >= -3 and item_expired like '".$cate."%'") or die(mysql_error()); 
				$row2=mysql_fetch_array($sql2);
				$page_num = intval(($row2['cnt']-1)/9 + 1);

				$sql=mysql_query("select * from BBanana_items where item_expired - unix_timestamp(now()) >= -3 and item_id like '".$cate."%' order by item_expired ASC limit ".($page*9).", 9") or die(mysql_error()); 
			}
				
			if($page==""){
				echo "{\"page\":\"".$page_num."\"}";
				return;
			}
	
			$i=0;
			$cnt=0;
			while($row=mysql_fetch_array($sql)){
	
				$now = mktime();
				$item_num[$i] = $row['item_id'];
				$item_name[$i] = $row['item_sname'];
				$item_img[$i] = $row['item_img'];
				$item_expired[$i] = $row['item_expired'];
				$item_addedtime[$i] = $row['item_addedtime'];
				$item_lastprice[$i] = number_format($row['item_price']);
				$item_lastbider[$i] = $row['item_lastbider'];
				$item_effect[$i] = "";
				$time_gap[$i] = $item_expired[$i] - $now;
				$remain_time[$i] = $time_gap[$i];
				if($time_gap[$i] <= -1) $remain_time[$i] = '경매종료';
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
					echo("\"add\":\"".$item_addedtime[$i]."\",");
					echo("\"eff\":\"".$item_effect[$i]."\"");
					echo("}");
				}else{
					echo("{\"sid\":\"".$item_num[$i]."\",");
					echo("\"sna\":\"".$item_name[$i]."\",");
					echo("\"img\":\"".$item_img[$i]."\",");
					echo("\"exp\":\"".$remain_time[$i]."\",");
					echo("\"lap\":\"".$item_lastprice[$i]."\",");
					echo("\"bid\":\"".$item_lastbider[$i]."\",");
					echo("\"add\":\"".$item_addedtime[$i]."\",");
					echo("\"eff\":\"".$item_effect[$i]."\"");
					echo("},");
				}
			}

			echo("],\"page\":".$page_num.",\"banana\":\"".$get_banana."\"}}");

			mysql_close($connect);
		return;
		}else if($option == "last"){//option이 last이면 입찰했던 목록을 가져온다.
			if(!$_SESSION['ID']){//세션값이 없으면 에러출력
				echo error;
				return;
			}
			//$sql2=mysql_query("select COUNT(distinct a.item_id) AS cnt from BBanana_bids As a, BBanana_items As b where a.item_id = b.item_id and a.bider_id = '".$_SESSION['ID']."'") or die(mysql_error()); 
			$sql2=mysql_query("select COUNT(item_id) AS cnt from BBanana_view_bids where bider_id = '".$_SESSION['ID']."'") or die(mysql_error()); 
			$row2=mysql_fetch_array($sql2);
			$page_num = intval(($row2['cnt']-1)/9 + 1);
			$page_num =0;
			if($page == ""){
				echo "{\"page\":\"".$page_num."\"}";
				return;
			}
			//$str = "SELECT distinct a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_bids As a, BBanana_items As b where a.item_id = b.item_id and a.bider_id = '".$_SESSION['ID']."' order by a.item_id DESC limit ".($page*9).", 9";
			$str = "SELECT a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_view_bids As a, BBanana_items As b where a.item_id = b.item_id and a.bider_id = '".$_SESSION['ID']."' order by a.item_id DESC limit ".($page*9).", 9";
			$sql=mysql_query($str) or die(mysql_error()); 

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
				if($time_gap[$i] <= -1) $remain_time[$i] = '경매종료';
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

			echo("],\"page\":".$page_num.",\"banana\":\"".$get_banana."\"}}");

			mysql_close($connect);
		return;
		}else if($option == "favorite"){//option이 favorite이면 찜했던 목록을 가져온다.
			if(!$_SESSION['ID']){//세션값이 없으면 에러출력
				echo error;
				return;
			}
			$sql2=mysql_query("select COUNT(distinct a.item_id) AS cnt from BBanana_favorites As a, BBanana_items As b where a.item_id = b.item_id and a.user_id = '".$_SESSION['ID']."'") or die(mysql_error()); 
			$row2=mysql_fetch_array($sql2);
			$page_num = intval(($row2['cnt']-1)/9 + 1);
			if($page == ""){
				echo "{\"page\":\"".$page_num."\"}";
				return;
			}
			$str = "SELECT distinct a.item_id, b.item_sname, b.item_fname, b.item_img, b.item_expired, b.item_price, b.item_lastbider from BBanana_favorites As a, BBanana_items As b where a.item_id = b.item_id and a.user_id = '".$_SESSION['ID']."' order by a.item_id DESC limit ".($page*9).", 9";
			$sql=mysql_query($str) or die(mysql_error()); 

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
				if($time_gap[$i] <= -1) $remain_time[$i] = '경매종료';
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

			echo("],\"page\":".$page_num.",\"banana\":\"".$get_banana."\"}}");

			mysql_close($connect);
		return;
		}else if($option == "win"){//option이 win이면 낙찰된 목록을 가져온다.
			if(!$_SESSION['ID']){//세션값이 없으면 에러출력
				echo error;
				return;
			}
			$sql2=mysql_query("select COUNT(item_id) AS cnt from BBanana_items where item_expired - unix_timestamp(now()) <= -3 and item_lastbider = '".$_SESSION['ID']."'") or die(mysql_error()); 
			$row2=mysql_fetch_array($sql2);
			$page_num = intval(($row2['cnt']-1)/9 + 1);
			if($page == ""){
				echo "{\"page\":\"".$page_num."\"}";
				return;
			}
			$str = "SELECT * from BBanana_items where item_expired - unix_timestamp(now()) <= -3 and item_lastbider = '".$_SESSION['ID']."' order by item_id DESC limit ".($page*9).", 9";
			$sql=mysql_query($str) or die(mysql_error()); 

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
				if($time_gap[$i] < -1) $remain_time[$i] = '경매종료';
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

			echo("],\"page\":".$page_num.",\"banana\":\"".$get_banana."\"}}");

			mysql_close($connect);
		return;
		}else{
			echo "error";
			mysql_close($connect);
			return;
		}
	}else if($page_type == "s"){//서브페이지에 뿌려줄 Json을 만드는 분기문
		if($sid != ""){
			$sql=mysql_query("SELECT a.no, a.item_id, a.bid_time, a.bid_microtime, a.bider_id, a.bider_ipnum, a.is_mobile FROM BBanana_bids AS a, BBanana_items AS b WHERE a.item_id = b.item_id && a.item_id = '".$sid."' order By a.no DESC limit 0, 12") or die(mysql_error());
			$sql2=mysql_query("SELECT item_lastbider, item_expired, item_rrp, item_price FROM BBanana_items WHERE item_id = '".$sid."'") or die(mysql_error());
			$row2=mysql_fetch_array($sql2);
			$sql3=mysql_query("select COUNT('no') as cnt from BBanana_bids where item_id='".$sid."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
			$row3=mysql_fetch_array($sql3);

			$i=0;
			$cnt=0;
			while($row=mysql_fetch_array($sql)){
				$item_id[$i] = $row['item_id'];
				$bider_id[$i] = $row['bider_id'];
				$bid_time[$i] = $row['bid_time'];
				$bid_time[$i] = date('m.d H:i:s',$bid_time[$i]);
				$bid_microtime[$i] = $row['bid_microtime'];
				$bider_ipnum[$i] = $row['bider_ipnum'];
				$is_mobile[$i] = $row['is_mobile'];
				//if($time_gap[$i] < 0) $remain_time[$i] = '경매종료';
				//if($time_gap[$i] <= 10) $item_effect[$i] = 'do';

				if($_SESSION['A'] == 'yes'){}
				else{
					$bider_ipnum[$i] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.\\2.x.x", $bider_ipnum[$i]);
					$bider_id[$i] = mb_strimwidth($bider_id[$i], 0, 8, "..", "UTF-8");
				}

				$i++;
				++$cnt;
			}
			$now = mktime();
			$item_price = number_format($row2['item_price']);
			$item_expired = $row2['item_expired'];
			$item_rrp = number_format($row2['item_rrp']);
			$time_gap = $item_expired - $now;
			$remain_time= $time_gap;
			$item_bided = number_format($row3['cnt'] * BANANA_PRICE);
			$item_save_price = number_format($row2['item_rrp']-$row2['item_price']-($row3['cnt']*BANANA_PRICE)-(COIN_UP+BANANA_PRICE));
			$item_reward = number_format($row2['item_rrp'] - ($row3['cnt'] * BANANA_PRICE));
			if($time_gap <= -1) $remain_time = '경매종료';
			if($remain_time <= 10) $item_effect = 'do';

			echo("{\"data\": {\"list\" : [");

			for($i=0; $i<$cnt; $i++){
				if($i == ($cnt-1)){
					echo("{\"bti\":\"".$bid_time[$i]."\",");
					echo("\"mti\":\"".substr($bid_microtime[$i],2,2)."\",");
					echo("\"bid\":\"".$bider_id[$i]."\",");
					echo("\"bip\":\"".$bider_ipnum[$i]."\",");
					echo("\"m\":\"".$is_mobile[$i]."\"");
					echo("}");
				}else{
					echo("{\"bti\":\"".$bid_time[$i]."\",");
					echo("\"mti\":\"".substr($bid_microtime[$i],2,2)."\",");
					echo("\"bid\":\"".$bider_id[$i]."\",");
					echo("\"bip\":\"".$bider_ipnum[$i]."\",");
					echo("\"m\":\"".$is_mobile[$i]."\"");
					echo("},");
				}
			}

			echo("],\"win\":\"".$row2['item_lastbider']."\",\"exp\":\"".$remain_time."\",\"pri\":\"".$item_price."\",\"banana\":\"".$get_banana."\",\"bided\":\"".$item_bided."\",\"rrp\":\"".$item_rrp."\",\"reward\":\"".$item_reward."\",\"save\":\"".$item_save_price."\",\"eff\":\"".$item_effect."\"}}");

		}else{echo "error";}//서브페이지에서 sid값이 없으면 에러출력.

	mysql_close($connect);
	return;
	}else{// p_type의 값이 없으면 에러출력.
		echo "error";
	}
	mysql_close($connect);
?>