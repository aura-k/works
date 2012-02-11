<%If Request.UserAgent.IndexOf("Android") > -1 or Request.UserAgent.IndexOf("iPhone") > -1 Then%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>IBK</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<meta content='width=device-width; initial-scale=1.0; maximum-scale=3.0; user-scalable=1;' name='viewport' /> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
 </HEAD>
<%If Request.UserAgent.IndexOf("Android") > -1 Then%>
	<link href="insert_style_an.css" rel="stylesheet" type="text/css"/> 
	<script language="javascript" src="insert_script.js" type="text/javascript"></script> 
<%else If Request.UserAgent.IndexOf("iPhone") > -1 Then%>
	<link href="insert_style.css" rel="stylesheet" type="text/css"/> 
	<script language="javascript" src="insert_script.js" type="text/javascript"></script> 
<%End If%>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 <BODY>
	<div id="ani">
		<div class="twit"><a href="#" onclick="goMenu('twit')"><img src="btn_05.png" /></a></div>
		<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
		<div class="content1"><a href="#" onclick="goMenu('ani_1')"><img src="btn_ep1.png" /></a></div>
		<div class="content2"><a href="#" onclick="goMenu('ani_2')"><img src="btn_ep2.png" /></a></div>
		<div class="content2"><a href="#" onclick="goMenu('ani_3')"><img src="btn_ep3.png" /></a></div>
		<div class="content2"><a href="#" onclick="goMenu('ani_4')"><img src="btn_ep4.png" /></a></div>
		<div class="content2"><a href="#" onclick="goMenu('ani_5')"><img src="btn_ep5.png" /></a></div>
	</div>
 </BODY>
</HTML>
<%Else%>
일반 웹에서는 지원하지 않습니다.
<%End If%>