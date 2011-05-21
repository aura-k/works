<?
	include "dbConfig.php";

	$tcodeVal	 = "119";
	$phoneVal	 = $_POST[phone];
	$nameVal	 = $_POST[name];
	$ipAddr		 = $_SERVER[REMOTE_ADDR];
	$nowDatetime = date("Y-m-d H:i:s");
	$nowDate	 = date("Ymd");
	$chkNum		 = 1;
	$message	 = "error";

	if(date("H") >= 0 && date("H") < 9){
		$chkNum	= 3; //파리크라상(시간)
		$message = "over";
	}else{
		$query = "SELECT COUNT(nid) as cnt1 FROM EVENT_USRLOG WHERE phone = '$phoneVal' AND chk1 = '0' AND tcode = '$tcodeVal'";
		$result = mssql_query($query);
		$row1 = mssql_fetch_array($result);

		$query_dategap = "SELECT DATEDIFF(Day, regdate, getdate()) as dategap FROM EVENT_USRLOG WHERE phone = '$phoneVal' AND chk1 = '0' AND tcode = '$tcodeVal' order by regdate desc";
		$result_dategap = mssql_query($query_dategap);
		$row_dategap = mssql_fetch_array($result_dategap);
		
		if($row_dategap[dategap] < 7 && $row1[cnt1] > 0) {
			$chkNum	= 1; //파리크라상(중복)
			$message = "re";
		}else {
			$query = "SELECT COUNT(nid) as cnt2 FROM EVENT_USRLOG WHERE chk1 = '0' AND tcode = '$tcodeVal' AND Convert(varchar(8),regdate,112) = '$nowDate'";
			$result = mssql_query($query);
			$row2 = mssql_fetch_array($result);

			if($row2[cnt2] > 99) { 
				$chkNum	= 2; //파리크라상(초과)
				$message = "over";
			}else{
				$chkNum	= 0;//비타500(당첨)
				$message = "ok";
			}
		}
	}

	$query = "INSERT INTO EVENT_USRLOG (tcode, name, ipaddr, phone, chk1, regdate) VALUES ('$tcodeVal', '$nameVal', '$ipAddr', '$phoneVal', '$chkNum', '$nowDatetime')";
	$change_query = iconv('UTF-8', 'EUC-KR', $query);
	mssql_query($change_query);
	echo($message);

	mssql_close($dbconnect);
?>