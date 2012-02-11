<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>롯데백화점 - 컬러코드 이벤트 관리 시스템</title>
<link rel="stylesheet" href="./css/common.css" type="text/css" charset="utf-8"/> 
<script type='text/javascript' src='./js/jquery-1.4.2.min.js'></script>
<script type='text/javascript' src='./js/script.js'></script>
</head>
<body bgcolor="<?=$backColor?>">
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td height="80px" bgcolor="#232323">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/img_logo.gif"/></td>
            <td></td>
            <td width="117px"><a href="index.php" target="_self"><img src="img/btn_menu01.gif"/></a></td>
            <td width="117px"><a href="list.php" target="_self"><img src="img/btn_menu02.gif"/></a></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td bgcolor="#ffffff" height="35px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?
		if($_SESSION['ID'])
		echo $_SESSION['ID']."(".$_SESSION['AREA']."점) 로그인&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"./php/logout_action.php\">로그아웃</a>";
	?></td>
  </tr>
  <tr>
  	<td>