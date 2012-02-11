<?
	// 한글
	
	session_start();
	
	if ($_POST['password'] == 'XXXXXX')
	{
		$_SESSION['LTM_MOV_ADMIN_LOGIN'] = 'OK';
	}
	
	header('Location:login.php');
?>