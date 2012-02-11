<?
	include_once "../modules/movie.php";
	
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
		function deleteMovie(name)
		{
			if (confirm('정말 삭제하시겠습니까?'))
			{
				document.location.href = 'remove_action.php?name=' + name;
			}
		}
		
		function modifyMovie(name)
		{
			if ($('#title_' + name).val().trim() == '')
			{
				alert('제목을 입력해 주세요.');
				$('#title_' + name).focus();
			}
			else if ($('#code_' + name).val().trim() == '')
			{
				alert('Video Code를 입력해 주세요.');
				$('#code_' + name).focus();
			}
			else if ($('#url_' + name).val().trim() == '')
			{
				alert('Thumbnail URL을 입력해 주세요.');
				$('#url_' + name).focus();
			}
			else if ($('#color_' + name).val().trim() == '')
			{
				alert('Colorzip URL을 입력해 주세요.');
				$('#color_' + name).focus();
			}
			else
			{
				$('#name').val(name);
				$('#sTitle').val($('#stitle_' + name).val().trim());
				$('#title').val($('#title_' + name).val().trim());
				$('#code').val($('#code_' + name).val().trim());
				$('#url').val($('#url_' + name).val().trim());
				$('#color').val($('#color_' + name).val().trim());
				
				$('#modifyForm').submit();
			}
		}
	</script>
</head>
<body>
	<form id="modifyForm" method="POST" action="modify_action.php" style="margin:0; padding:0;">
		<input type="hidden" id="name" name="name" />
		<input type="hidden" id="sTitle" name="sTitle" />
		<input type="hidden" id="title" name="title" />
		<input type="hidden" id="code" name="code" />
		<input type="hidden" id="url" name="url" />
		<input type="hidden" id="color" name="color" />
	</form>
	<div style="padding:15px;">
		<div>
			<div class="pageTitle">영상목록</div>
			<table cellpadding="0" cellspacing="0" class="adminList">
				<thead>
					<tr>
						<td style="width:50px; text-align:center;">No.</td>
						<td style="width:80px;">Thumbnail</td>
						<td>Short Title / Title / Video Code / Thumbnail URL / Colorcode URL</td>
						<td style="width:125px; text-align:center;">Manage</td>
					</tr>
				</thead>
				<tbody>
					<?
						$count = 0;
						$offset = 0;
						
						$movies = getMovies('../movies');
						foreach ($movies as $movie)
						{
					?>
					<tr>
						<td style="text-align:center;"><?=number_format(count($movies) - $offset)?></td>
						<td style="text-align:center;">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<img src="<?=htmlspecialchars($movie['url'])?>" width="60" />
									</td>
								</tr>
								<tr>
									<td style="border:0;">
										<img src="<?=htmlspecialchars($movie['color'])?>" width="60" />
									</td>
								</tr>
							</table>
						</td>
						<td>
							<input type="text" id="stitle_<?=substr($movie['file'], 0, strrpos($movie['file'], '.'))?>" class="simpleInput" value="<?=htmlspecialchars($movie['sTitle'])?>" style="width:100%;" />
							<br />
							<input type="text" id="title_<?=substr($movie['file'], 0, strrpos($movie['file'], '.'))?>" class="simpleInput" value="<?=htmlspecialchars($movie['title'])?>" style="width:100%;" />
							<br />
							<input type="text" id="code_<?=substr($movie['file'], 0, strrpos($movie['file'], '.'))?>" class="simpleInput" value="<?=htmlspecialchars($movie['code'])?>" style="width:100%;" />
							<br />
							<input type="text" id="url_<?=substr($movie['file'], 0, strrpos($movie['file'], '.'))?>" class="simpleInput" value="<?=htmlspecialchars($movie['url'])?>" style="width:100%;" />
							<br />
							<input type="text" id="color_<?=substr($movie['file'], 0, strrpos($movie['file'], '.'))?>" class="simpleInput" value="<?=htmlspecialchars($movie['color'])?>" style="width:100%;" />
							<br />
							<br />
							<b>http://<?=$_SERVER['SERVER_NAME']?><?=substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], 'admin'))?>takeout.php?name=<?=$movie['file']?></b>
						</td>
						<td style="text-align:center;"><span class="simpleButton" onclick="javascript:modifyMovie('<?=substr($movie['file'], 0, strrpos($movie['file'], '.'))?>');">Modify</span> <span class="simpleButton" onclick="javascript:deleteMovie('<?=$movie['file']?>');">Delete</span></td>
					</tr>
					<?
							$offset++;
							$count++;
						}
						
						if ($count == 0)
						{
					?>
					<tr>
						<td colspan="4" style="text-align:center;">등록된 영상이 없습니다.</td>
					</tr>
					<?
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4"><button class="simpleButton" onclick="javascript:document.location.href = 'add.php';">&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;&nbsp;</button></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>