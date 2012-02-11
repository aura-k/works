<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
	<title>보건복지부 이벤트</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
	<div id="introDiv">
		<img src="images/btn_intro_start.png" class="button" />
	</div>
	<div id="QuizDiv">
		<img src="images/btn_x.png" class="close" />
		<div id="q1">
			<img src="images/q1.png" class="title" />
			<img src="images/btn_q1_1.png" /><img src="images/q1_description.png" class="desc1" />
			<img src="images/btn_q1_2.png" />
			<img src="images/btn_q1_3.png" />
		</div>
		<div id="q2">
			<img src="images/q2.png" class="title" />
			<img src="images/btn_q2_1.png" />
			<img src="images/btn_q2_2.png" /><img src="images/q2_description.png" class="desc2" />
			<img src="images/btn_q2_3.png" />
		</div>
		<div id="q3">
			<img src="images/q3.png" class="title" />
			<img src="images/btn_q3_1.png" /><img src="images/btn_q3_2.png" /><img src="images/q3_description.png"class="desc3" />
		</div>
	</div>
	<div id="inputDiv">
		<img src="images/btn_x.png" class="close" />
		<input type="text" id="nameInput"/>
		<input type="tel" id="phoneInput"/>
		<img src="images/btn_fin_ok.png" class="button" />
	</div>
	<? include "logFn.php";writeLog(245); ?>
</body>
</html>