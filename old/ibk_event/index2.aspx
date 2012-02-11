﻿<%@ Page Language="C#" AutoEventWireup="true" CodeFile="index2.aspx.cs" Inherits="www_index2" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<form id="form1" runat="server">
<%if(Request.UserAgent.IndexOf("Android") > -1 || Request.UserAgent.IndexOf("iPhone") > -1){%>
<head>
<title>IBK</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' /> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="script<%=isAn%>.js"></script>
	<link href="style<%=isAn%>.css" rel="stylesheet" type="text/css"/> 
	<script type="text/javascript">
		function goMenu(name){
			switch(name){
				case 'event':{
					//$.get('log.aspx?p=event',function(data){
						location.href = 'insert_event.aspx';
					//});

				}break;
				case 'main':{
					$.get('log.aspx?p=main',function(data){
						goMain();
					});
				}break;

				case 'lotto':{
					$.get('log.aspx?p=lotto',function(data){
						location.href = "draw.aspx";
					});
				}break;

				case 'cf':{
					$.get('log.aspx?p=cf',function(data){
						goCf();
					});
				}break;

				case 'cf_1':{
					$.get('log.aspx?p=cf_1',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d9/unsecured/media/88960803001/88960803001_609556699001_IBK----------20--9-15-.mp4?pub-id=88960803001";
					});
				}break;

				case 'cf_2':{
					$.get('log.aspx?p=cf_2',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d9/unsecured/media/88960803001/88960803001_609556917001_IBK-------------20--9-15-.mp4?pub-id=88960803001";
					});
				}break;

				case 'cf_3':{
					$.get('log.aspx?p=cf_3',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d15/unsecured/media/88960803001/88960803001_904876106001_-mix-0328-IBK-30s.mp4?pub-id=88960803001";
					});
				}break;
				
				case 'info':{
					$.get('log.aspx?p=info',function(data){
						goInfo();
					});
				}break;

				case 'info_0':{
					$.get('log.aspx?p=info_0',function(data){
						location.href = "insert_info3.html";
					});
				}break;

				case 'info_1':{
					$.get('log.aspx?p=info_1',function(data){
						location.href = "insert_info1.html";
					});
				}break;

				case 'info_2':{
					$.get('log.aspx?p=info_2',function(data){
						location.href = "insert_info2.html";
					});
				}break;

				case 'logic':{
					$.get('log.aspx?p=logic',function(data){
						goLogic();
					});
				}break;

				case 'input':{
					$.get('log.aspx?p=input',function(data){
						goInput();
					});
				}break;

				case 'ani':{
					$.get('log.aspx?p=ani',function(data){
						goAni();
					});
				}break;

				case 'ani_1':{
					$.get('log.aspx?p=ani_1',function(data){
						location.href = "insert_toon1.html";
					});
				}break;

				case 'ani_2':{
					$.get('log.aspx?p=ani_2',function(data){
						location.href = "insert_toon2.html";
					});
				}break;

				case 'ani_3':{
					$.get('log.aspx?p=ani_3',function(data){
						location.href = "insert_toon3.html";
					});
				}break;

				case 'ani_4':{
					$.get('log.aspx?p=ani_4',function(data){
						location.href = "insert_toon4.html";
					});
				}break;

				case 'ani_5':{
					$.get('log.aspx?p=ani_5',function(data){
						location.href = "insert_toon5.html";
					});
				}break;

				case 'char':{
					$.get('log.aspx?p=char',function(data){
						location.href = "insert_char.aspx";
					});
				}break;
				
				case 'char_1':{
					$.get('log.aspx?p=char_1',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d13/unsecured/media/88960803001/88960803001_729580844001_oasis-ep002.mp4?pub-id=88960803001";
					});
				}break;

				case 'char_2':{
					$.get('log.aspx?p=char_2',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d13/unsecured/media/88960803001/88960803001_729702582001_oasis-ep003.mp4?pub-id=88960803001";
					});
				}break;

				case 'char_3':{
					$.get('log.aspx?p=char_3',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d12/unsecured/media/88960803001/88960803001_639669661001_----ep6.mp4?pub-id=88960803001";
					});
				}break;

				case 'char_4':{
					$.get('log.aspx?p=char_4',function(data){
						location.href = "http://brightcove.vo.llnwd.net/d12/unsecured/media/88960803001/88960803001_639669575001_----ep7.mp4?pub-id=88960803001";
					});
				}break;

				case 'angel':{
					$.get('log.aspx?p=angel',function(data){
						location.href = "http://neonfly.co.kr/ibk/angel/";
					});
				}break;

				case 'app':{
					$.get('log.aspx?p=app',function(data){
						location.href = "http://itunes.apple.com/kr/app/id347880188?mt=8";
					});
				}break;

				case 'twit':{
					$.get('log.aspx?p=twit');
					//window.open("http://twitter.com/home?status=스마트IBK 스마트모닝 이벤트! 매일 아침 8시부터 선착순 100명에게 드리는 모닝커피 기프티콘! 실시간으로 받아가세요^^ http://blog.ibk.co.kr/157");
					window.open("http://twitter.com/home?status=IBK 기업은행 CF 캐릭터들의 재밌는 애니메이션 영상을 즐겨보세요_tagtv.co.kr/ibk");
				}break;
				
				case 'twit_phone':{
					$.get('log.aspx?p=twit_phone',function(data){
						//$.get('readTwit.aspx?id='+setID,function(data){
							//location.href = "http://twitter.com/home?status=핸드폰 요금 자동 이체하면, 전국 모든 은행 ATM수수료가 무료! http://blog.ibk.co.kr/157";
							location.href = "http://twitter.com/home?status=IBK 기업은행 CF 캐릭터들의 재밌는 애니메이션 영상을 즐겨보세요_tagtv.co.kr/ibk";
						//});
					});
				}break;

				case 'twit_pay':{
					$.get('log.aspx?p=twit_pay',function(data){
						//$.get('readTwit.aspx?id='+setID,function(data){
							//location.href = "http://twitter.com/home?status=월급 자동 이체만 해도, 전국 모든 은행 ATM 수수료가 무료! http://blog.ibk.co.kr/157";
							location.href = "http://twitter.com/home?status=IBK 기업은행 CF 캐릭터들의 재밌는 애니메이션 영상을 즐겨보세요_tagtv.co.kr/ibk";
						//});
					});
				}break;

				case 'etc1':{
					if (localStorage.getItem('IBK_PR') == null){
						$.get('log.aspx?p=main',function(data){
							location.href = "http://brightcove.vo.llnwd.net/d14/unsecured/media/88960803001/88960803001_818989279001_IBK-20-.mp4?pub-id=88960803001";
							localStorage.setItem('IBK_PR', 'Y'); 
						});
					}else{
						$.get('log.aspx?p=main');
					}
				}break;

				case 'etc2':{
					if (localStorage.getItem('IBK_PR') == null){
						$.get('log.aspx?p=main',function(data){
							if (navigator.appVersion.indexOf("iPhone") == -1)
							{
								location.href = "http://brightcove.vo.llnwd.net/d14/unsecured/media/88960803001/88960803001_818989279001_IBK-20-.mp4?pub-id=88960803001";
							}
							
							localStorage.setItem('IBK_PR', 'Y'); 
						});
					}else{
						$.get('log.aspx?p=main');
					}
				}break;
			}
		}
		function openPop(name){
			if(name == 'logic'){
				$('.popup').fadeIn(500);
			}/*else if(name == 'result1'){
				$.get("check_gift.aspx", function(data){
					if(data < 100) $('.popup_event1').fadeIn(500);
					else $('.popup_event1_1').fadeIn(500);
				});
			}else if(name == 'result2'){
				$.get("check_gift.aspx", function(data){
					if(data < 100) $('.popup_event2').fadeIn(500);
					else $('.popup_event2_1').fadeIn(500);
				});
			}else if(name == 'result3'){
				$.get("check_gift.aspx", function(data){
					if(data < 100) $('.popup_event3').fadeIn(500);
					else $('.popup_event3_1').fadeIn(500);
				});
			}else if(name == 'result4'){
				$.get("check_gift.aspx", function(data){
					if(data < 100) $('.popup_event4').fadeIn(500);
					else $('.popup_event4_1').fadeIn(500);
				});
			}*/
		}
		function closePop(name){
			if(name == 'logic'){
				$('.popup').hide();
			}else if(name == 'result1'){
				$('.popup_event1').hide();
			}else if(name == 'result2'){
				$('.popup_event2').hide();
			}else if(name == 'result3'){
				$('.popup_event3').hide();
			}else if(name == 'result4'){
				$('.popup_event4').hide();
			}else if(name == 'result1_1'){
				$('.popup_event1_1').hide();
			}else if(name == 'result2_1'){
				$('.popup_event2_1').hide();
			}else if(name == 'result3_1'){
				$('.popup_event3_1').hide();
			}else if(name == 'result4_1'){
				$('.popup_event4_1').hide();
			}else if(name == 'result_input1'){
				$('.popup_event_input1').hide();
			}else if(name == 'result_input2'){
				$('.popup_event_input2').hide();
			}
		}
		/*var joinEvent = 0;
		function checkForm(){
			var name = document.getElementById('name').value;
			var phone = document.getElementById('phone').value;
			var form = document.getElementById('form');
			
			if(name== ''){
				alert('이름을 입력해주세요.');
				return;
			}else if(phone.length < 9){
				alert('정확한 핸드폰번호를 입력해주세요.');
				return;
			}else if(confirm('다음의 정보가 맞습니까?\n이름: '+name+'\n핸드폰: '+phone)){
				if (joinEvent == 0) {
					joinEvent = 1;
					$.post('gifti.aspx', {"name":name, "phone":phone}, function(data){
						if(data == 'OK'){
							alert('기프티콘 전송이 성공적으로 완료되었습니다!\n상품 문자 도착까지는 다소 시간이 걸릴 수 있습니다.');
							goMain();
						}else if(data == 'RE'){
							//alert('이미 사용된 핸드폰번호 입니다!');
							$('.popup_event_input1').fadeIn(500);
						}else if(data == 'OVER'){
							//alert('죄송합니다.\n금일은 마감 되었습니다.\n내일 다시 이용해주세요.');
							$('.popup_event_input2').fadeIn(500);
						}else if(data == 'ERR52'){
							alert('수신자 번호가 올바르지 않습니다.');
						}else if(data == 'ERR33'){
							alert('상품 유효기간이 만료 되었습니다.');
						}else{
							alert(data);
						}
						joinEvent = 0;
						form.reset();
					});
				}else{
					alert('이미 전송 버튼을 누르셨습니다.\n현재 결과 처리중이오니 잠시만 기다려주세요.');
				}
			}
		}*/
		function saveLogic(name, num){
			localStorage.setItem(name, num); 
		}
		function onAction(){
			<%=ActionJS%>
			localStorage.removeItem('IBK_LOGIC');
		}
		function enableVideoClicks() {
		  var videos = document.getElementsByTagName('video') || [];
		  for (var i = 0; i < videos.length; i++) {
			// TODO: use attachEvent in IE
			videos[i].addEventListener('click', function(videoNode) {
			  return function() {
				videoNode.play();
			  };
			}(videos[i]));
		  }
		}
	</script>
</head>

<body onload="window.scrollTo(0,0.9);goMenu('etc2');onAction();enableVideoClicks();">
	<div class="frame">
		<ul>
			<style>
				@-webkit-keyframes upDownAnimation {
					from {
						top: 145px;
					}
					to {
						top: 160px;
					}
				}
				
				@-webkit-keyframes enlargeAnimation {
					from {
						width: 91px;
						height: 94px;
					}
					to {
						width: 105px;
						height: 108px;
					}
				}
				
				@-webkit-keyframes enlargePositionAnimation {
					from {
						left:11px;
						top:195px;
					}
					to {
						left:5px;
						top:189px;
					}
				}
			</style>
			<li class="hidden0" <%=hidden0%>>
				<div id="glove_below" style="position:absolute; top:163px; left:13px;">
					<a href="http://mini.ibk.co.kr" target="_self"><img src="images/btn_event.png"/></a>
                    <!--<a href="javascript:goMenu('event');"><img src="images/btn_event.png" style="-webkit-animation-name: enlargeAnimation; -webkit-animation-iteration-count: infinite; -webkit-animation-duration: 0.5s; -webkit-animation-direction: alternate;" /></a>-->
				</div>
                <div id="glove" style="position:absolute; top:140px; left:45px; -webkit-animation-name: upDownAnimation; -webkit-animation-iteration-count: infinite; -webkit-animation-duration: 0.5s; -webkit-animation-direction: alternate;">
					<img src="images/img_glove.png" />
				</div>
				
			  <div id="main">
			<img src="images/bg_main.png" usemap="#Map_main" />
				<map name="Map_main" id="Map_main">
					<!--<area shape="rect" coords="10,187,107,276" onclick="goMenu('event')" />-->
					<area shape="rect" coords="250,0,320,83" onclick="goMenu('info')" />
					<area shape="rect" coords="250,83,320,166" onclick="goMenu('cf')" />
					<area shape="rect" coords="250,166,320,249" onclick="goMenu('char')" />
					<area shape="rect" coords="250,249,320,332" onclick="goMenu('logic')" />
					<area shape="rect" coords="250,332,320,415" onclick="goMenu('app')" />
					
					<!--area shape="rect" coords="8,3,129,121" onclick="goMenu('logic')" />
					<area shape="rect" coords="68,115,157,204" onclick="goMenu('info')" />
					<area shape="rect" coords="149,63,246,172" onclick="goMenu('char')" />
					<area shape="rect" coords="232,21,319,103" onclick="goMenu('ani')" />
					<area shape="rect" coords="224,149,307,234" onclick="goMenu('cf')" />
					<area shape="rect" coords="223,313,318,412" onclick="goMenu('app')" />
					<!-- <area shape="circle" coords="69,104,56" onclick="goMenu('lotto')" /   >
					<area shape="circle" coords="161,64,46" onclick="goMenu('char')" />
					<area shape="circle" coords="271,77,42" onclick="goMenu('ani')" />
					<area shape="circle" coords="113,202,47" onclick="goMenu('info')" />
					<area shape="circle" coords="207,155,50" onclick="goMenu('logic')" />
					<area shape="circle" coords="268,210,43" onclick="goMenu('cf')" />
					<area shape="rect" coords="224,318,319,415" onclick="goMenu('app')" />
					<area shape="circle" coords="160,67,58" onclick="goMenu('angel')" />
					<area shape="circle" coords="79,122,34" onclick="goMenu('logic')" />
					<area shape="circle" coords="248,104,33" onclick="goMenu('cf')" />
					<area shape="circle" coords="51,215,39" onclick="goMenu('info')" />
					<area shape="circle" coords="268,200,42" onclick="goMenu('ani')" />
					<area shape="rect" coords="224,306,323,426" onclick="goMenu('app')" /> -->
				</map>
				</div>
			</li>
			<li class="hidden1" <%=hidden1%>>
				<div id="cf">
					<div class="twit"><a href="#" onclick="goMenu('twit')"><img src="btn_05.png" /></a></div>
					<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
					<div class="content_link"><a href="https://mini.ibk.co.kr:8081/mw/Reserve.ibk"><img src="ibkkk.png" /></a></div>
					<div class="content3"><video poster="images/thumb_cf01.jpg" src="http://brightcove.vo.llnwd.net/d15/unsecured/media/88960803001/88960803001_904876106001_-mix-0328-IBK-30s.mp4?pub-id=88960803001" width="280" height="168" controls autobuffer></video></div>
					<div class="content1"><video poster="images/thumb_cf02.jpg" src="http://brightcove.vo.llnwd.net/d9/unsecured/media/88960803001/88960803001_609556699001_IBK----------20--9-15-.mp4?pub-id=88960803001" width="280" height="168" controls autobuffer></video></div>
					<div class="content2"><video poster="images/thumb_cf03.jpg" src="http://brightcove.vo.llnwd.net/d9/unsecured/media/88960803001/88960803001_609556917001_IBK-------------20--9-15-.mp4?pub-id=88960803001" width="280" height="168" controls autobuffer></video></div>
				</div>
			</li>
			<li class="hidden2" <%=hidden2%>>
				<div id="info">
					<div class="twit"><a href="#" onclick="goMenu('twit')"><img src="btn_05.png" /></a></div>
					<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
					<div class="content0"><a href="http://mini.ibk.co.kr/mw/Card.ibk?command=View&prdc_cd=CR0000000212" target="_blank"><img src="btn_style.png" /></a></div>
				  <div class="content1"><a href="http://mini.ibk.co.kr/mw/Deposit.ibk?command=View&prdc_cd=DP0000000297" target="_blank"><img src="btn_phone.png" /></a></div>
					<div class="content2"><a href="http://mini.ibk.co.kr/mw/Deposit.ibk?command=View&prdc_cd=DP0000000305" target="_blank"><img src="btn_pay.png" /></a></div>
			  </div>
			</li>
			<li class="hidden3" <%=hidden3%>>
				<div id="ani">
				<div class="twit"><a href="#" onclick="goMenu('twit')"><img src="btn_05.png" /></a></div>
					<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
					<div class="content1"><a href="#" onclick="goMenu('ani_1')"><img src="btn_ep1.png" /></a></div>
					<div class="content2"><a href="#" onclick="goMenu('ani_2')"><img src="btn_ep2.png" /></a></div>
					<div class="content2"><a href="#" onclick="goMenu('ani_3')"><img src="btn_ep3.png" /></a></div>
					<div class="content2"><a href="#" onclick="goMenu('ani_4')"><img src="btn_ep4.png" /></a></div>
					<div class="content2"><a href="#" onclick="goMenu('ani_5')"><img src="btn_ep5.png" /></a></div>
				</div>
			</li>
			<li class="hidden4" <%=hidden4%>>
			<div class="popup_event_input1">
				<img src="pop_re<%=isAdd%>.png" usemap="#Map_input1" />
				<map name="Map_input1" id="Map_input1">
					<area shape="rect" coords="36,265,282,311" href="#" onclick="closePop('result_input1');"/>
				</map>
			</div>
			<div class="popup_event_input2">
				<img src="pop_next<%=hourPop+isAdd%>.png" usemap="#Map_input2" />
				<map name="Map_input2" id="Map_input2">
					<area shape="rect" coords="36,265,282,311" href="#" onclick="closePop('result_input2');"/>
				</map>
			</div>
				<div id="input1">
					<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
					<form id="form">
					<div class="content">
						<input type="text" name="name" size="8" id="name"><br>
						<input type="tel" name="phone" size="12" id="phone" maxlength="11">
					</div>
					<div class="button"><img src="btn_ok.png" onclick="alert('마감');"/></div>
					</form>
				</div>
			</li>
			<li class="hidden5" <%=hidden5%>>
				<div id="game">
					<ul>
						<li alt="lev0. 스타트페이지">
							<div class="logic_st">
								<div class="home">
								<a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 2);"><img src="btn_start.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="lev1. 나는 스스로 알뜰한 사람이라고 생각한다.">
							<div class="logic">
								<div class="home">
								<a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 3);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(1, 3);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="lev2. 대형마트 무료시식코너를 그냥 지나쳐 본적이 없다.">
							<div class="logic2">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_1_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 4);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(1, 4);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev2. 길바닥에 떨어진 동전을 줍고 작은 행복감을 느낀 적이 있다.">
							<div class="logic2">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_1_2.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(2, 4);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(3, 4);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="lev3. 할인쿠폰이나 적립카드 사용이 생활화되어 있다.">
							<div class="logic3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_3_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 5);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(1, 4);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev3. 인터넷 가격비교사이트를 자주 이용한다.">
							<div class="logic3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_3_2.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(1, 5);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(3, 5);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev3. 신용카드 적립금을 위해 가급적 정해진 카드만 쓴다.">
							<div class="logic3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_3_3.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(2, 5);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(3, 4);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev3. 갖고 싶은 물건이 있으면 반드시 사고야 만다.">
							<div class="logic3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_3_4.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(3, 5);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(2, 5);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="lev4. 나는 평소 내 은행계좌번호를 외우고 다닌다.">
						<div class="popup">
							<img src="pop_phone<%=isAdd%>.png" usemap="#Map" />
						<map name="Map" id="Map"><area shape="rect" coords="55,342,301,382" href="#" onclick="closePop('logic');nextLogic(1, 5);"/></map></div>
							<div class="logic">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_4_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 6);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="openPop('logic')"><!-- <a href="#" onclick="nextLogic(1, 5);"> --><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev4. 쓸데없이 나가는 ATM수수료가 아깝다.">
							<div class="logic">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_4_2.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 6);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(1, 6);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev4. 남들에게 선심을 잘 쓰는 편이다.">
							<div class="logic">
								<div class="home">
								<a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_4_3.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(1, 6);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(0, 6);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev4. 가끔 충동구매를 할 때가 있다.">
							<div class="logic">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_4_4.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(1, 6);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(2, 5);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="lev5. 나는 현재 만으로 40세 이하다.">
							<div class="logic2">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_5_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(0, 7);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(1, 8);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev5. 나는 현재 만으로 40세 이하다.">
							<div class="logic2">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_5_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(1, 7);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(3, 8);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="lev6. 나는 매달 정기적인 수입이 있다.">
							<div class="logic3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_6_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(1, 8);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(0, 8);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
						<li alt="lev6. 나는 매달 정기적인 수입이 있다.">
							<div class="logic3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<div class="qst"><img src="q_6_1.png" /></div>
								<div class="ans">
									<span class="yes"><a href="#" onclick="nextLogic(3, 8);"><img src="btn_yes.png" /></a></span>
									<span class="no"><a href="#" onclick="nextLogic(2, 8);"><img src="btn_no.png" /></a></span>
								</div>
							</div>
						</li>
					</ul>
					<ul>
						<li alt="res. 포피형">
							<div class="popup_event1">
								<img src="pop_event<%=isAdd%>.png" usemap="#Map2" />
							<map name="Map2" id="Map2">
								<area shape="rect" coords="66,321,172,363" href="#" onclick="closePop('result1');goMenu('input');"/>
								<area shape="rect" coords="180,320,286,362" href="#" onclick="closePop('result1');"/>
							</map>
							</div>
							<div class="popup_event1_1">
								<img src="pop_next<%=hourPop+isAdd%>.png" usemap="#Map2_1" />
							<map name="Map2_1" id="Map2_1">
								<area shape="rect" coords="36,265,282,311" href="#" onclick="closePop('result1_1');"/>
							</map>
							</div>
							<div class="result1">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<!-- <div class="event"><a href="#" onclick="openPop('result1')"><img src="btn_event.png" /></a></div> -->
								<div class="detail"><a href="#" onclick="saveLogic('IBK_LOGIC', '0');goMenu('info_1')"><img src="btn_detail.png" /></a></div>
							</div>
						</li>
						<li alt="res. 터틀맘형">
							<div class="popup_event2">
								<img src="pop_event<%=isAdd%>.png" usemap="#Map3" />
							<map name="Map3" id="Map3">
								<area shape="rect" coords="66,321,172,363" href="#" onclick="closePop('result2');goMenu('input');"/>
								<area shape="rect" coords="180,320,286,362" href="#" onclick="closePop('result2');"/>
							</map>
							</div>
							<div class="popup_event2_1">
								<img src="pop_next<%=hourPop+isAdd%>.png" usemap="#Map3_1" />
							<map name="Map3_1" id="Map3_1">
								<area shape="rect" coords="36,265,282,311" href="#" onclick="closePop('result2_1');"/>
							</map>
							</div>
							<div class="result2">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<!-- <div class="event"><a href="#" onclick="openPop('result2')"><img src="btn_event.png" /></a></div> -->
								<div class="detail"><a href="#" onclick="saveLogic('IBK_LOGIC', '1');goMenu('info_2')"><img src="btn_detail.png" /></a></div>
							</div>
						</li>
						<li alt="res. 오스카형">
							<div class="popup_event3">
								<img src="pop_event<%=isAdd%>.png" usemap="#Map4" />
							<map name="Map4" id="Map4">
								<area shape="rect" coords="66,321,172,363" href="#" onclick="closePop('result3');goMenu('input');"/>
								<area shape="rect" coords="180,320,286,362" href="#" onclick="closePop('result3');"/>
							</map>
							</div>
							<div class="popup_event3_1">
								<img src="pop_next<%=hourPop+isAdd%>.png" usemap="#Map4_1" />
							<map name="Map4_1" id="Map4_1">
								<area shape="rect" coords="36,265,282,311" href="#" onclick="closePop('result3_1');"/>
							</map>
							</div>
							<div class="result3">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<!-- <div class="event"><a href="#" onclick="openPop('result3')"><img src="btn_event.png" /></a></div> -->
								<div class="detail"><a href="#" onclick="saveLogic('IBK_LOGIC', '2');goMenu('info_1')"><img src="btn_detail.png" /></a></div>
							</div>
						</li>
						<li alt="res. 하치형">
							<div class="popup_event4">
								<img src="pop_event<%=isAdd%>.png" usemap="#Map5" />
							<map name="Map5" id="Map5">
								<area shape="rect" coords="66,321,172,363" href="#" onclick="closePop('result4');goMenu('input');"/>
								<area shape="rect" coords="180,320,286,362" href="#" onclick="closePop('result4');"/>
							</map>
							</div>
							<div class="popup_event4_1">
								<img src="pop_next<%=hourPop+isAdd%>.png" usemap="#Map5_1" />
							<map name="Map5_1" id="Map5_1">
								<area shape="rect" coords="36,265,282,311" href="#" onclick="closePop('result4_1');"/>
							</map>
							</div>
							<div class="result4">
								<div class="home"><a href="#" onclick="goMenu('main')"><img src="btn_logo.png" /></a></div>
								<!-- <div class="event"><a href="#" onclick="openPop('result4')"><img src="btn_event.png" /></a></div> -->
								<div class="detail"><a href="#" onclick="saveLogic('IBK_LOGIC', '3');goMenu('info_2')"><img src="btn_detail.png" /></a></div>
							</div>
						</li>
					</ul>
					<ul>
						
					</ul>
				</div>
			</li>
		</ul>
	</div>
</body>
<%
	}else{
%>
	<img src="images/ibk_smart_0309.jpg" />
<%
		//Response.Write("일반 웹에서는 지원하지 않습니다.");
	}
%>
</form>
</html>
