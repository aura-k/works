<?
	session_start(); 
	if(!$_SESSION['ID']){
		$url = _ROOT.'/login.php';
		echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		exit;
	}
?>