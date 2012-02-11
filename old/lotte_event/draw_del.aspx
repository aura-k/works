<%@ Page Language="C#" AutoEventWireup="true" CodeFile="draw.aspx.cs" Inherits="www_draw" %>
<!DOCTYPE html>
<html>
<%if(Request.UserAgent.IndexOf("Android") > -1 || Request.UserAgent.IndexOf("iPhone") > -1){%>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>IBK</title>
	<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' /> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <style>
  body, ul, li, div, a { padding:0; margin:0; }
  #main {background:url('bg_sc.png') repeat-y; text-align:center; width:320px; height:416px; overflow:hidden; z-index:1;}
  #main ul {  list-style:none; padding:0; margin:0; white-space:nowrap; }
  #main ul li {  padding:0; width:320px; }
  #main .home { text-align:right; }
  .no_bottom { margin-bottom:-5px; }
  .bottom_1 { margin-bottom:7px; }
  .bottom_2 { margin-bottom:5px; }
  #main #input_bg { background:url('img/bg_w_input.png') no-repeat; width:320px; height:330px;}
  #main #input_bg .input { padding:193px 23px 0 0; text-align:right; }
  #main #total_bg { background:url('img/bg_w_0.png') no-repeat; margin-left:12px; width:300px; height:70px;}
  #main #total_bg .total { text-align:right; font-size:25px; padding:15px 0 0 0; width:80px; color:#fcc72f; font-weight:bold; }
  #main #m_1_bg { background:url('img/bg_w_1.png') no-repeat; text-align:left; margin-left:12px; width:300px; height:70px;}
  #main #m_2_bg { background:url('img/bg_w_2.png') no-repeat; text-align:left; margin-left:12px; width:300px; height:70px;}
  #main #m_3_bg { background:url('img/bg_w_3.png') no-repeat; text-align:left; margin-left:12px; width:300px; height:70px;}
  #main #m_4_bg { background:url('img/bg_w_4.png') no-repeat; text-align:left; margin-left:12px; width:300px; height:70px;}
  #main #m_5_bg { background:url('img/bg_w_5.png') no-repeat; text-align:left; margin-left:12px; width:300px; height:70px;}
  .popup_more {position:absolute; z-index:9999; display:none;}/**/
  .popup_result {position:absolute; z-index:9999; display:none;}/**/
  .r_phone { color:#FFFFFF; font-weight:bold; padding:5px;}
  .r_comment { color:#feddc6; }
  input {font:1em Helvetica; height:30px; width:200px; margin-bottom:5px;}
  textarea {font:1em Helvetica; height:60px; width:200px; margin-bottom:5px;}
  #ticket { width:282px; height:214px; margin-top:141px;}
  .popup_more {background:url('pop_gift_<%=print_value%>.png'); width:320px; height:416px;}
  .popup_more .popup_input {margin:145px 0 0 85px;}
  .popup_more .popup_input > input {width:150px}
  .popup_more .popup_button {width:226px;margin:7px 0 0 25px;}
  </style>
  <script type="text/javascript">
  var drawEvent = 0;

	function sendAction(){
		//var str = $("#actionForm").serialize();
		var nameVal = $("#name").val();
		var phoneVal = $("#phone").val();
		var emailVal = $("#email").val();
		var typeVal = $("#type").val();
		var str = "name="+nameVal+"&phone="+phoneVal+"&email="+emailVal+"&type="+typeVal;
		
		if(!checkEmail(emailVal)) {
			alert("이메일 형식이 잘못 되었습니다.");
			return;
		}

		if(nameVal != '' && phoneVal != '' && emailVal != ''){
			if (drawEvent == 0) {
				drawEvent = 1;
				$.post('draw_action.aspx', str, function(data){
					if(data == "ok"){
						openResultPop();
						document.getElementById('name').value='';
						document.getElementById('phone').value='';
						document.getElementById('email').value='';
					}else if(data == "re"){
						alert("이미 참여하신 이벤트 입니다!");
						document.getElementById('name').value='';
						document.getElementById('phone').value='<%=print_phoneVal%>';
						document.getElementById('email').value='<%=print_emailVal%>';
						closePop();
					}else alert("발송이 실패되었습니다.다시한번 시도해 주세요.");
					drawEvent = 0;
				});
			}
		}
	}
	function openResultPop(){
		$('.popup_more').fadeOut(500);		
		$('.popup_result').fadeIn(500);			
	}
	function closeResultPop(){	
		$('.popup_result').fadeOut(500);			
	}
	function goMain(){
		$.get('log.aspx?p=main',function(data){
			location.href = "index2.aspx";
		});
	}
	function goAni(){
		$.get('log.aspx?p=char',function(data){
			location.reload();
			location.href = "insert_char.aspx";
		});
	}
	function isUA(name) { 
        if (navigator.userAgent.indexOf(name) != -1) { 
                return true; 
        } 
        return false; 
	} 
	function checkEmail(email){
		if(email == 'none') return true;
		if(/^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.)+([0-9a-zA-Z-]+)([\.0-9a-zA-Z-])*$/.test(email) == false) return false;
		return true;
	}
	</script>
 </head>

 <body onload="window.scrollTo(0,0.9);">
 <div class="popup_more">
	<div class="popup_input">
		<input type="text" name="name" id="name" maxlength="12"/><br>
		<input type="<%=print_phoneType%>" name="phone" id="phone" maxlength="12" value="<%=print_phoneVal%>"/>
		<input type="<%=print_emailType%>" name="email" id="email" value="<%=print_emailVal%>"/>
		<input type="hidden" name="type" id="type" value="<%=print_value%>"/>
	</div>
	<div class="popup_button">
		<img src="btn_sc.png" usemap="#Map"/>
		<map name="Map" id="Map">
			<area shape="rect" coords="5,3,109,39" href="#" onclick="sendAction()"/>
			<area shape="rect" coords="113,3,217,39" href="#" onclick="closePop()"/>
		</map>
	</div>
 </div>
 <div class="popup_result">
	<img src="pop_gift_result.png" usemap="#Map2"/>
	<map name="Map2" id="Map2">
		<area shape="rect" coords="19,237,257,284" href="#" onclick="goAni()"/>
	</map>
 </div>
 <div id="main">
	<div class="home"><a href="#" onclick="goMain()"><img src="btn_sc_main.png" /></a></div>
	<canvas id="ticket">이 브라우저에서는 사용할 수 없습니다.</canvas>
 </div>
 </body>
 <script type="text/javascript">
	$(function(){
		var canvas = document.querySelector('#ticket');
		var context = canvas.getContext('2d');
		
		var offset = $('#ticket').offset();
		var eraseWeight = 40;
		
		context.fillStyle = 'rgba(0, 0, 0, 1)';
		
		var curtainImage = new Image();
		curtainImage.width=200;
		curtainImage.height=100;
		curtainImage.onload = function(){
			$.get('log.aspx?p=lotto_pop');
			if (isUA("Android 2.1")) context.drawImage(curtainImage, 0, 0, curtainImage.width, curtainImage.height);
			else context.drawImage(curtainImage, 0, 0, canvas.width, canvas.height);
		}
		curtainImage.src = "img_sc.png";
		
		$("#ticket").css("background-image", "url('img_gift_<%=print_value%>.png')");
		
		canvas.addEventListener("touchstart", function(event) {
			event.preventDefault();
			var x = event.targetTouches[0].pageX;
			var y = event.targetTouches[0].pageY-210;
			
			context.clearRect(x, y, eraseWeight, eraseWeight);
			setMarkedRegionByPoint(x, y, canvas.width, canvas.height);
		});
		
		canvas.addEventListener("touchmove", function(event) {
			event.preventDefault();
			
			var x = event.targetTouches[0].pageX;
			var y = event.targetTouches[0].pageY-210;
			
			context.clearRect(x, y, eraseWeight, eraseWeight);
			setMarkedRegionByPoint(x, y, canvas.width, canvas.height);
		});
		
		canvas.addEventListener("touchend", function(event) {
		});
		
		
		canvas.addEventListener("touchcancel", function(event) {
		});
		
		
		
		var piecesOfRegion = 30;
		
		var region = new Array(piecesOfRegion);
		for (var i = 0; i < piecesOfRegion; i++){ region[i] = new Array(piecesOfRegion); }
		
		for (var i = 0; i < piecesOfRegion; i++)
		{
			for (var j = 0; j < piecesOfRegion; j++)
			{
				region[i][j] = 0;
			}
		}
		
		function setMarkedRegionByPoint(x, y, width, height)
		{
			var offsetX = Math.ceil(x / (width / piecesOfRegion));
			var offsetY = Math.ceil(y / (height / piecesOfRegion));
			
			if (offsetX < 0) offsetX = 0;
			if (offsetX > piecesOfRegion - 1) offsetX = piecesOfRegion - 1;
			
			if (offsetY < 0) offsetY = 0;
			if (offsetY > piecesOfRegion - 1) offsetY = piecesOfRegion - 1;
			
			region[offsetX][offsetY] = 1;
			checkMarkedRegion(80);
		}
		
		var isAlreadyNotification = 0;
		
		function checkMarkedRegion(limit)
		{
			var count = 0;
			for (var i = 0; i < piecesOfRegion; i++)
			{
				for (var j = 0; j < piecesOfRegion; j++)
				{
					if (region[i][j] == 1) count++;
					if (count >= limit) break;
				}
				if (count >= limit) break;
			}
			
			if (count >= limit)
			{
				if (isAlreadyNotification == 0)
				{
					isAlreadyNotification = 0;
					openPop();
					//alert('축하합니다!');
				}
			}
		}

		function openPop(){
			$('.popup_more').fadeIn(500);			
		}
		
	});
	
	function closePop(){
		$('.popup_more').fadeOut(500);
	}
	</script>

<%
	}else{
		Response.Write("일반 웹에서는 지원하지 않습니다.");
	}
%>
</html>