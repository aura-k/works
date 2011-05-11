<?
	// 한글
	
	session_start();
	
	if (isset($_SESSION['LTM_MOV_ADMIN_LOGIN']) == TRUE && $_SESSION['LTM_MOV_ADMIN_LOGIN'] == 'OK')
	{
		header('Location:index.php');
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Lotte Members - Big Pleasure! (Only Administrator)</title>
	<link href="../styles/common.css" rel="stylesheet" type="text/css"/>
	<style type="text/css">
		body { background-color:#000000; }
	</style>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body onload="javascript:$('#password').focus();">
	<form action="login_action.php" method="POST">
		<div id="loginWrapper">
			<div id="loginBoxInput"><input type="password" id="password" name="password" value="" /></div>
			<div id="loginBoxButton"><button>Login</button></div>
		</div>
	</form>
</body>
</html>