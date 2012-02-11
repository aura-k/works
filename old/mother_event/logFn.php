<?

function writeLog($num) {

	$host = "192.168.20.106";
	$usrid = "Log_User";
	$usrpwd = "fhrmdbwj";
	$dbName = "ANALYTIC";

	$dbconnect = mssql_connect($host, $usrid, $usrpwd) or die("접속 에러"); ;
	mssql_select_db($dbName, $dbconnect);

	$ip = $_SERVER['REMOTE_ADDR'];
	$usrAgent = $_SERVER['HTTP_USER_AGENT'];

	if(ereg("Windows NT 7.0", $usrAgent)){
		$os_name = "Windows 7";
	}else if(ereg("Windows 3.11", $usrAgent)){
		$os_name = "Windows16";
	}else if(ereg("Windows 95", $usrAgent)){
		$os_name = "Windows 95";
	}else if(ereg("Win95", $usrAgent)){
		$os_name = "Windows 95";
	}else if(ereg("Windows_95", $usrAgent)){
		$os_name = "Windows 95";
	}else if(ereg("Windows 98", $usrAgent)){
		$os_name = "Windows 98";
	}else if(ereg("Win98", $usrAgent)){
		$os_name = "Windows 98";
	}else if(ereg("Windows 2000", $usrAgent)){
		$os_name = "Windows 2000";
	}else if(ereg("Windows NT 5.0", $usrAgent)){
		$os_name = "Windows 2000";
	}else if(ereg("Windows NT 5.1", $usrAgent)){
		$os_name = "Windows XP";
	}else if(ereg("Windows XP", $usrAgent)){
		$os_name = "Windows XP";
	}else if(ereg("Windows NT 5.2", $usrAgent)){
		$os_name = "Windows Server 2003";
	}else if(ereg("Windows NT 6.0", $usrAgent)){
		$os_name = "Windows Vista";
	}else if(ereg("Windows NT 6.1", $usrAgent)){
		$os_name = "Windows 7";
	}else if(ereg("Windows ME", $usrAgent)){
		$os_name = "Windows ME";
	}else if(ereg("OpenBSD", $usrAgent)){
		$os_name = "OpenBSD";
	}else if(ereg("SunOS", $usrAgent)){
		$os_name = "SunOS";
	}else if(ereg("Linux", $usrAgent)){
		$os_name = "Linux";
	}else if(ereg("X11", $usrAgent)){
		$os_name = "Linux";
	}else if(ereg("Mac_PowerPC", $usrAgent)){
		$os_name = "Mac OS";
	}else if(ereg("Macintosh", $usrAgent)){
		$os_name = "Mac OS";
	}else if(ereg("QNX", $usrAgent)){
		$os_name = "QNX";
	}else if(ereg("BeOS", $usrAgent)){
		$os_name = "BeOS";
	}else if(ereg("OS/2", $usrAgent)){
		$os_name = "OS/2";
	}else{
		$os_name = "etc";
	}

	if (strpos($usrAgent, 'Lynx') !== false) {
		$browser="lynx";
	} elseif ( strpos(strtolower($usrAgent), 'chrome') !== false ) {
		$browser="chrome";
	} elseif ( strpos(strtolower($usrAgent), 'webkit') !== false ) {
		$browser="safari";
	} elseif (strpos($usrAgent, 'Gecko') !== false) {
		$browser="firefox";
	} elseif (strpos($usrAgent, 'MSIE') !== false && strpos($usrAgent, 'Win') !== false) {
		$browser="win_IE";
	} elseif (strpos($usrAgent, 'MSIE') !== false && strpos($usrAgent, 'Mac') !== false) {
		$browser="mac_IE";
	} elseif (strpos($usrAgent, 'Opera') !== false) {
		$browser="opera";
	} elseif (strpos($usrAgent, 'Nav') !== false && strpos($usrAgent, 'Mozilla/4.') !== false) {
		$browser="netscape";
	} else {
		$browser="etc";
	}

	 $query = "EXEC ANALYTIC.dbo.TAGTV_WEBSCAN_WRITE ".$num.", '".$ip."','".$os_name."','".$browser."','".$usrAgent."';";
	 mssql_query($query);

	//131
	//veex_main 132
	//veex_mov 133
	//veex_quiz 134
	
	/*
	 $stmt =  mssql_init("ANALYTIC.dbo.TAGTV_WEBSCAN_WRITE");
	 mssql_bind($stmt, '@인자1', $값1, SQLINT4);
	 mssql_bind($stmt, '@인자2', $값2, SQLINT1);
	 mssql_bind($stmt, '@인자3', $값3, SQLVARCHAR);

	 mssql_execute($stmt);
	 mssql_free_statement($stmt);
	 */
}

?>