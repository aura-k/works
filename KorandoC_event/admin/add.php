<?
	session_start();
	
	if (isset($_SESSION['LTM_MOV_ADMIN_LOGIN']) == FALSE || $_SESSION['LTM_MOV_ADMIN_LOGIN'] != 'OK')
	{
		header('Location:login.php');
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Lotte Members - Big Pleasure! (Only Administrator)</title>
	<link href="../styles/common.css" rel="stylesheet" type="text/css"/>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
		function onSubmit()
		{
			if ($('#title').val().trim() == '')
			{
				alert('제목을 입력해 주세요.');
				$('#title').focus();
				return false;
			}
			else if ($('#code').val().trim() == '')
			{
				alert('Video Code를 입력해 주세요.');
				$('#code').focus();
				return false;
			}
			else if ($('#url').val().trim() == '')
			{
				alert('Thumbnail URL을 입력해 주세요.');
				$('#url').focus();
				return false;
			}
			else if ($('#color').val().trim() == '')
			{
				alert('Colorzip URL을 입력해 주세요.');
				$('#color').focus();
				return false;
			}
			
			return true;
		}
	</script>
</head>
<body>
	<div style="padding:15px;">
		<div>
			<div class="pageTitle">신규등록</div>
			<form action="add_action.php" method="POST" onsubmit="javascript:return onSubmit();">
				<table cellpadding="0" cellspacing="0" class="adminListVertical">
					<tr>
						<td class="title">Title</td>
						<td class="field"><input type="text" id="title" name="title" class="simpleInput" style="width:50%;" /></td>
					</tr>
					<tr>
						<td class="title">Video Code</td>
						<td class="field"><input type="text" id="code" name="code" class="simpleInput" style="width:100px;" /></td>
					</tr>
					<tr>
						<td class="title">Thumbnail URL</td>
						<td class="field"><input type="text" id="url" name="url" class="simpleInput" style="width:70%;" /></td>
					</tr>
					<tr>
						<td class="title">Colorzip URL</td>
						<td class="field"><input type="text" id="color" name="color" class="simpleInput" style="width:70%;" /></td>
					</tr>
					<tr>
						<td colspan="2" style="padding:10px; text-align:right;">
							<button class="simpleButton">&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;&nbsp;</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>