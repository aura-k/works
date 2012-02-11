<?
	// 한글
	
	session_start();
	
	if (isset($_SESSION['LTM_MOV_ADMIN_LOGIN']) == FALSE || $_SESSION['LTM_MOV_ADMIN_LOGIN'] != 'OK')
	{
		header('Location:login.php');
		exit;
	}
	
	if (isset($_GET['name']) == TRUE)
	{
		@unlink('../movies/'.$_GET['name']);
	}
	
	header('Location:list.php');
	exit;
?>