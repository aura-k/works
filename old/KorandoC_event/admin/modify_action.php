<?
	// 한글
	
	session_start();
	
	if (isset($_SESSION['LTM_MOV_ADMIN_LOGIN']) == FALSE || $_SESSION['LTM_MOV_ADMIN_LOGIN'] != 'OK')
	{
		header('Location:login.php');
		exit;
	}
	
	if (isset($_POST['name']) == TRUE && trim($_POST['name']) != '' && isset($_POST['title']) == TRUE && trim($_POST['title']) != '' && isset($_POST['code']) == TRUE && trim($_POST['code']) != '' && isset($_POST['url']) == TRUE && trim($_POST['url']) != '' && isset($_POST['color']) == TRUE && trim($_POST['color']) != '')
	{
		$filename = $_POST['name'].'.itm';
		
		$fp = fopen('../movies/'.$filename, 'w+');
		
		if ($fp)
		{
			fwrite($fp, $_POST['sTitle']);
			fwrite($fp, "\r\n");
			fwrite($fp, $_POST['title']);
			fwrite($fp, "\r\n");
			fwrite($fp, $_POST['code']);
			fwrite($fp, "\r\n");
			fwrite($fp, $_POST['url']);
			fwrite($fp, "\r\n");
			fwrite($fp, $_POST['color']);
			
			fclose($fp);
		}
	}
	
	header('Location:list.php');
	exit;
?>