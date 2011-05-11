<?
$backColor = "#9c9080";
include "./inc/header.php";
?>
<div id="login">
	<form id="loginForm">
	<div style="margin:0 0 3px 0;color:#666">아이디</div><input type="text" name="id" id="id" />
	<div style="margin:10px 0 3px 0;color:#666">비밀번호</div><input type="password" name="pw" id="pw" onkeypress="loginkey(event);" />
	</form>
	<div class="button"><a href="javascript:login_submit();"><img src="img/btn_ok.gif"/></a></div>
</div>
<?include "./inc/footer.php";?>