<?
	// 한글
	
	session_start();
	
	if (isset($_SESSION['LTM_MOV_ADMIN_LOGIN']) == FALSE || $_SESSION['LTM_MOV_ADMIN_LOGIN'] != 'OK')
	{
		header('Location:login.php');
		exit;
	}
	else
	{
		header('Location:list.php');
		exit;
	}
?>