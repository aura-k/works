<%@ Page Language="C#" AutoEventWireup="true" CodeFile="index.aspx.cs" Inherits="dhevent" %>
<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>IBK</title>
	<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' /> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <style>
  body, ul, li, div, a { padding:0; margin:0; }
  #main {text-align:center; width:320px; height:416px; overflow:hidden; z-index:1;}
  .popup_more {position:absolute; z-index:9999; display:none;}/**/
  .popup_result {position:absolute; z-index:9999; display:none;}/**/
  .r_phone { color:#FFFFFF; font-weight:bold; padding:5px;}
  .r_comment { color:#feddc6; }
  input {font:1em Helvetica; height:30px; width:200px; margin-bottom:5px;}
  textarea {font:1em Helvetica; height:60px; width:200px; margin-bottom:5px;}
  #ticket { width:320px; height:416px;}
  </style>
  <script type="text/javascript">
  var drawEvent = 0;

	function sendAction(){
		var str = "type=<%=print_value%>";

		if (drawEvent == 0) {
			drawEvent = 1;
			$.post('index_action.aspx', str, function(data){
				drawEvent = 0;
			});
		}
	}
	function isUA(name) { 
        if (navigator.userAgent.indexOf(name) != -1) { 
                return true; 
        } 
        return false; 
	} 
	</script>
 </head>

 <body onload="window.scrollTo(0,0.9);">
 <!-- <a onclick="localStorage.removeItem('EVENT');alert('리셋완료');">리셋</a> -->
 <div id="main">
	<canvas id="ticket" width="320" height="416">이 브라우저에서는 사용할 수 없습니다.</canvas>
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
			curtainImage.width = 215;
			curtainImage.height = 285;
			curtainImage.onload = function(){
				if (isUA("Android 2.1")) context.drawImage(curtainImage, 0, 0, curtainImage.width, curtainImage.height);
				else context.drawImage(curtainImage, 0, 0);
			}
			curtainImage.src = "img/bg.png";
			
			$("#ticket").css("background-image", "url('img/gift_<%=print_value%>.jpg')");
			
			canvas.addEventListener("touchstart", function(event) {
				event.preventDefault();
				var x = event.targetTouches[0].pageX;
				var y = event.targetTouches[0].pageY;
				
				if(localStorage.getItem('EVENT') == null) context.clearRect(x, y, eraseWeight, eraseWeight);
				else alert('한번만 응모하실 수 있습니다!');

				setMarkedRegionByPoint(x, y, canvas.width, canvas.height);
			});
			
			canvas.addEventListener("touchmove", function(event) {
				event.preventDefault();
				
				var x = event.targetTouches[0].pageX;
				var y = event.targetTouches[0].pageY;
				
				if(localStorage.getItem('EVENT') == null) context.clearRect(x, y, eraseWeight, eraseWeight);
				else alert('한번만 응모하실 수 있습니다!');
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
				checkMarkedRegion(150);
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
						isAlreadyNotification = 1;
						if(<%=print_value%>) alert('뭐하고 있어?! 앞으로 나와서 받아가야지. 이 상품은 그냥 상품이 아니야! 1년간 경품만 준비해온 대홍인이 한가지한가지 준비한 경품이라구.');
						else alert('이게 최선입니까? 확실해요? 당신이란 사람, 상품탈 생각 5분만 했어도 이렇게 느리게 긁지는 않았을꺼야. 꽝이네요. ');
						context.clearRect(0, 0, canvas.width, canvas.height);
						localStorage.setItem('EVENT', 'YES'); 
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
</html>