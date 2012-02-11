<?
	include "../php/connect.php";
	$prn_itemlist = '';
	$i = 0;
	$sql=mysql_query("select * from BBanana_items where item_expired > unix_timestamp(now()) order by item_expired ASC") or die(mysql_error());
	
	while($row=mysql_fetch_array($sql)){
		$now = mktime();
		$item_gaptime = $row['item_expired']-$now;
		if($item_gaptime > 0){
			$item_hour = floor($item_gaptime/3600);
			$item_min = floor($item_gaptime%3600/60);
			$item_sec = $item_gaptime%3600%60;
		}else{
			$item_hour = 0;
			$item_min = 0;
			$item_sec = 0;
			$battleButton = "<img src=\"../img/sub/btn_end.gif\" border=0>";
		}
		
		if($item_hour < 10) $item_hour = "0".$item_hour;
		if($item_min < 10) $item_min = "0".$item_min;
		if($item_sec < 10) $item_sec = "0".$item_sec;

		$prn_itemid[$i] = $row['item_id'];

		$prn_itemlist .= '
				<li class="arrow">
					<a href="#callback">
                	<div>
                    <p id="mi_1">'.$row['item_fname'].'</p>
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div id="mi_p"><img src="../'.$row['item_img'].'"></div></td>
                        <td><p id="mi_2" class="box_'.$row['item_id'].'">'.$item_hour.':'.$item_min.':'.$item_sec.'</p><p id="mi_3"><span class="price_'.$row['item_id'].'">'.number_format($row['item_price']).'</span>원</p><p id="mi_4" class="bider_'.$row['item_id'].'">'.$row['item_lastbider'].'</p></td>
                      </tr>
                    </table>
					</div>
					</a>
				</li>';

		++$i;
	}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>배틀바나나</title>
        <style type="text/css" media="screen">@import "./jqtouch/jqtouch.min.css";</style>
        <style type="text/css" media="screen">@import "./themes/jqt/theme.css";</style>
        <script src="./jqtouch/jquery.1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="./jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
		<script src="../js/mobile_item.js" type="text/javascript" charset="utf-8"></script>
		<script type='text/javascript' src='../js/jqueryTimers.js'></script>
        <script src="./extensions/jqt.floaty.js" type="application/x-javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                icon: 'jqtouch.png',
                addGlossToIcon: false,
                startupScreen: 'jqt_startup.png',
                statusBar: 'black',
                preloadImages: [
                    './themes/jqt/img/back_button.png',
                    './themes/jqt/img/back_button_clicked.png',
                    './themes/jqt/img/button_clicked.png',
                    './themes/jqt/img/grayButton.png',
                    './themes/jqt/img/whiteButton.png',
                    './themes/jqt/img/loading.gif'
                    ]
            });
            // Some sample Javascript functions:
            $(function(){
                // Show a swipe event on swipe test
                $('#swipeme').swipe(function(evt, data) {                
                    $(this).html('You swiped <strong>' + data.direction + '</strong>!');
                });
                $('a[target="_blank"]').click(function() {
                    if (confirm('This link opens in a new window.')) {
                        return true;
                    } else {
                        $(this).removeClass('active');
                        return false;
                    }
                });
                // Page animation callback events
                $('#pageevents').
                    bind('pageAnimationStart', function(e, info){ 
                        $(this).find('.info').append('Started animating ' + info.direction + '&hellip; ');
                    }).
                    bind('pageAnimationEnd', function(e, info){
                        $(this).find('.info').append(' finished animating ' + info.direction + '.<br /><br />');
                    });
                // Page animations end with AJAX callback event, example 1 (load remote HTML only first time)
                $('#callback').bind('pageAnimationEnd', function(e, info){
                    if (!$(this).data('loaded')) {                      // Make sure the data hasn't already been loaded (we'll set 'loaded' to true a couple lines further down)
                        $(this).append($('<div>Loading</div>').         // Append a placeholder in case the remote HTML takes its sweet time making it back
                            load('item.php #item_<?=$prn_itemid[2]?>', function() {        // Overwrite the "Loading" placeholder text with the remote HTML
                                $(this).parent().data('loaded', true);  // Set the 'loaded' var to true so we know not to re-load the HTML next time the #callback div animation ends
								subItemList('<?=$prn_itemid[2]?>');
                            }));
                    }
                });
                // Orientation callback event
                $('body').bind('turn', function(e, data){
                    $('#orient').html('Orientation: ' + data.orientation);
                });
            });
			
			// 로그인했을때 떠다니는 상태창 시작
			$(function(){

                
                $('.floaty').makeFloaty({
                    spacing: 20,
                    time: '0.1s'
                });

            });
			// 로그인했을때 떠다니는 상태창 끝
        </script>
        <style type="text/css" media="screen">
            body.fullscreen #home .info {
                display: none;
            }
            #about, #banana_list, #deli ,#email_share, #auto {
                /*padding: 100px 10px 40px;
                text-shadow: rgba(255, 255, 255, 0.3) 0px -1px 0;*/
				padding:3px;
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1f1f21), to(#606066));
				
            }
            #about p {
                margin-bottom: 8px;
            }
            #about a {
                color: #fff;
                font-weight: bold;
                text-decoration: none;
            }
			#bb_menu { padding-top:20px;
                font-size: 13px;
                text-align: center; background:#FFFFFF;
            }
            #bb_menu p {
                margin-bottom: 8px;
            }
			#bb_menu img {
			padding:2px;
            }
            #bb_menu a {
                color: #fff;
                font-weight: bold;
                text-decoration: none;
            }
			.floaty {
                -webkit-border-radius: 10px;
                -webkit-box-shadow: rgba(0,0,0, .5) 0px 1px 1px;
                width: 25%;
                margin: 0 5%;
                padding: 5px 10px;
                background: rgba(255,255,255,.7);
                color: #000;
            }
			/*로그인창*/
.pop_pad {padding:3px; background-color:#111111;}
.pop_top { padding:15px; background-color:#111111;}
.pop_sub { padding:0 15px 15px 15px; color:#878787; font-size:12px; background-color:#111111;}
.pop_mid { padding:0 15px 10px 15px; background-color:#ffffff; position:relative;}
.pop_bottom { padding:2px; background-color:#eeeeee; position:relative; text-align:center;}
.pop_bottom img { padding:3px;}
.search_box { width:90%; border:0 none; font-size:1em; -webkit-appearance:none;}
.pop_table {color: #303030; text-align:center; font-size:12px;}
.pop_title {font-weight: bold;}

.score {font-size:12px; margin:0 auto;}
.score_yellow {color: #ffbb36;}
.score_grey {color: #e2e2e2; font-weight: bold;}
.score_yellow_r {color: #ffbb36; text-align:right;}
.score_grey_r {color: #e2e2e2; font-weight: bold; text-align:right;}
.battle_f {position:fixed; z-index:999; width:100%; height:120px; border:solid 1px #bbbbbb;}
        </style>
    </head>
    <body>
    <div class="battle_f">
    바나나<img src="../img/bg_score.png">
    </div>
    <!---★★팝업시작★★->
    <!--로그인창 시작-->
    <div id="about">
    <div class="pop_pad">
	<div class="pop_top">
        <img src="../img/pop/img_login.gif"/ >
    </div>
<div class="pop_sub">컴퓨터로 배틀바나나(www.battlebanana.com)에 접속하시면 회원가입과 아이디/비밀번호찾기를 하실 수 있습니다.</div>
<div class="pop_mid"></div>
    <div class="pop_mid" style="overflow:auto;">
      <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          	  <td><img src="../img/pop/img_id.gif" style="padding-left:15px;" /></td>
              <td height="34"><img src="../img/pop/bg_input_l.gif"/></td>
              <td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input type="text" id="login_id" name="login_id" class="search_box"/></td>
              <td><img src="../img/pop/bg_input_r.gif"/></td>
              <td><img src="../img/pop/img_conf_x.gif"/></td>
          </tr>
      </table>
    </div>
	<div class="pop_mid" style="overflow:auto;">
	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
          	  <td><img src="../img/pop/img_pass.gif"/></td>
              <td height="34"><img src="../img/pop/bg_input_l.gif"/></td>
              <td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input type="password" id="login_pass" name="login_pass" class="search_box"/></td>
              <td><img src="../img/pop/bg_input_r.gif"/></td>
              <td><img src="../img/pop/img_conf_x.gif"/></td>
          </tr>
      </table>
    </div>
    	<div class="pop_bottom" style="overflow:auto;">
        <a href="#bb_menu" class="cube"><img src="../img/pop/btn_ok.gif"/></a><a href="#" class="goback"><img src="../img/pop/btn_cancel.gif"/></a>
    </div>
    </div>
    
    <div>
        <table width="290" height="143" border="0" cellspacing="0" cellpadding="0" class="score">
                          <tr>
                            <td background="../img/bg_score.png">
                            	<table width="205" border="0" cellspacing="0" cellpadding="0" align="right">
                                  <tr>
                                    <td>
                                    	<table width="185" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td  class="score_yellow_r"><span class="score_grey_r">배추도사무도사</span> 님,</td>
                                          </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <table width="110" border="0" cellspacing="0" cellpadding="0" align="left">
                                        <tr>
                                          <td width="55"><img src="../img/img_6.gif" /></td>
                                          <td width="55"><img src="../img/img_0.gif" /></td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                        <table width="290" height="43" border="0" cellspacing="0" cellpadding="0" class="score">
                          <tr>
                            <td>
                            	<table width="225" border="0" cellspacing="0" cellpadding="0" align="right">
                                  <tr>
                                    <td class="score_yellow">할인된 가격으로<br/><span class="score_grey">Apple iPod Touch 3세대 8GB</span> 낙찰!!</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                </table>
    </div>
    </div>
        <!--로그인창 끝-->
        
        <!--이메일공유 시작-->
        <div id="email_share"><div class="pop_pad">
<div class="pop_top">
        <img src="../img/pop/img_send_email.gif"/ >
</div>
<div class="pop_sub">상품명</div>
<div class="pop_mid"></div>
    <div class="pop_mid" style="overflow:auto;">
      <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          	  <td><img src="../img/pop/img_receiver_email.gif"/></td>
              <td height="34"><img src="../img/pop/bg_input_l.gif"/></td>
              <td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input type="text" id="email" name="email" class="search_box"/></td>
              <td><img src="../img/pop/bg_input_r.gif"/></td>
              <td><img src="../img/pop/img_conf_x.gif"/></td>
          </tr>
      </table>
    </div>
	<div class="pop_mid" style="overflow:auto;">
	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
          	  <td><img src="../img/pop/img_comment.gif" style="padding-left:47px;" /></td>
              <td height="34"><img src="../img/pop/bg_input_l.gif"/></td>
              <td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input type="text" id="comment" name="comment" class="search_box"/></td>
              <td><img src="../img/pop/bg_input_r.gif"/></td>
              <td><img src="../img/pop/img_conf_clear.gif"/></td>
          </tr>
      </table>
    </div>
    	<div class="pop_bottom" style="overflow:auto;">
        <a href="#bb_menu" class="cube"><img src="../img/pop/btn_ok.gif"/></a><a href="#" class="goback"><img src="../img/pop/btn_cancel.gif"/></a>
    </div>
    </div>
    </div>
        <!--이메일공유 끝-->
        <!--바나나통장 시작-->
        <div id="banana_list">
    <div class="pop_pad">
	<div class="pop_top">
        <img src="../img/pop/img_bananalist.gif"/ >
    </div>
<div class="pop_sub">바나나통장이긔</div>
<div class="pop_mid"></div>
    <div class="pop_mid" style="overflow:auto;">
      <table width="90%" class="pop_table" border="0" cellspacing="1" cellpadding="0" style="margin:15px;" bgcolor="#dddddd">
                  <tr bgcolor="#FFFFFF" class="pop_title">
                    <td width="28%" height="20">날짜</td>
                    <td width="50%">내용</td>
                    <td width="11%">in</td>
                    <td width="11%">out</td>
                  </tr>
                  <tr bgcolor="#FFFFFF" class="con">
                    <td  height="20">2010/04/22</td>
                    <td class="text_br"><a href="#">닌텐도DS Lite 신상품 8가지 색상</a></td>
                    <td class="text_grey">&nbsp;</td>
                    <td class="text_grey">200</td>
                </table>
    </div>
    	<div class="pop_bottom" style="overflow:auto;">
        <a href="#" class="goback"><img src="../img/pop/btn_ok.gif"/></a>
    </div>
    </div>
    </div>
        <!--바나나통장 끝-->
        <!--상품주문내역 시작-->
        <div id="deli">
    <div class="pop_pad">
	<div class="pop_top">
        <img src="../img/pop/img_orderlist.gif"/ >
    </div>
<div class="pop_sub">상품주문내역이긔</div>
<div class="pop_mid"></div>
    <div class="pop_mid" style="overflow:auto;">
      <table width="90%" class="pop_table" border="0" cellspacing="1" cellpadding="0" style="margin:15px;" bgcolor="#dddddd">
                  <tr bgcolor="#FFFFFF" class="pop_title">
                    <td width="28%" height="20">날짜</td>
                    <td width="50%">상품명</td>
                    <td width="22%">배송</td>
                  </tr>
                  <tr bgcolor="#FFFFFF" class="con">
                    <td  height="20">2010/04/22</td>
                    <td class="text_br"><a href="#">닌텐도DS Lite 신상품 8가지 색상</a></td>
                    <td class="text_grey">준비중</td>
                </table>
    </div>
    	<div class="pop_bottom" style="overflow:auto;">
        <a href="#" class="goback"><img src="../img/pop/btn_ok.gif"/></a>
    </div>
    </div>
    </div>
        <!--상품주문내역 끝-->
        <!--오토배틀 시작-->
<div id="auto">
    <div class="pop_pad">
	<div class="pop_top">
        <img src="../img/pop/img_auto.gif"/ >
    </div>
<div class="pop_sub">현재 0개의 바나나가 배틀 대기중입니다.</div>
<div class="pop_mid"></div>
    <div class="pop_mid" style="overflow:auto;">
      <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          	  <td><img src="../img/pop/img_banana_num.gif"/></td>
              <td height="34"><img src="../img/pop/bg_input_l.gif"/></td>
              <td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input type="text" id="login_id" name="login_id" class="search_box"/></td>
              <td><img src="../img/pop/bg_input_r.gif"/></td>
              <td><img src="../img/pop/img_conf_x.gif"/></td>
          </tr>
      </table>
    </div>
    	<div class="pop_bottom" style="overflow:auto;">
        <a href="#bb_menu" class="cube"><img src="../img/pop/btn_ok.gif"/></a><a href="#" class="goback"><img src="../img/pop/btn_cancel.gif"/></a>
    </div>
    </div>
    
    <div>
        <table width="290" height="143" border="0" cellspacing="0" cellpadding="0" class="score">
                          <tr>
                            <td background="../img/bg_score.png">
                            	<table width="205" border="0" cellspacing="0" cellpadding="0" align="right">
                                  <tr>
                                    <td>
                                    	<table width="185" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td  class="score_yellow_r"><span class="score_grey_r">배추도사무도사</span> 님,</td>
                                          </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <table width="110" border="0" cellspacing="0" cellpadding="0" align="left">
                                        <tr>
                                          <td width="55"><img src="../img/img_6.gif" /></td>
                                          <td width="55"><img src="../img/img_0.gif" /></td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                        <table width="290" height="43" border="0" cellspacing="0" cellpadding="0" class="score">
                          <tr>
                            <td>
                            	<table width="225" border="0" cellspacing="0" cellpadding="0" align="right">
                                  <tr>
                                    <td class="score_yellow">할인된 가격으로<br/><span class="score_grey">Apple iPod Touch 3세대 8GB</span> 낙찰!!</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                </table>
    </div>
    </div>
        <!--오토배틀 끝-->
        <!---★★팝업끝★★->
        
        <!--메뉴화면 시작-->
        <div id="bb_menu" class="selectable">
                <a href="#" class="goback"><img src="../img/btn_menu_01.png"></a><a href="#banana_list" class="pop"><img src="../img/btn_menu_02.png"></a><a href="#banana_list" class="pop"><img src="../img/btn_menu_03.png"></a><a href="#" class="goback"><img src="../img/btn_menu_04.png"></a><a href="#" class="goback"><img src="../img/btn_menu_05.png"></a><a href="#deli" class="pop"><img src="../img/btn_menu_06.png"></a><a href="#" class="goback"><img src="../img/btn_menu_close.png"></a><a href="#" class="goback"><img src="../img/btn_menu_logout.png"></a>
                <p><strong>배틀바나나 모바일 로그인</strong><br />Version 1.0 beta<br />
                    <a href="http://www.davidkaneda.com">By David Kaneda</a></p>
        </div>
        <!--메뉴화면 끝-->
        <div id="ajax">
            <div class="toolbar">
                <h1>AJAX</h1>
                <a class="back" href="#home">Home</a>
            </div>
            <ul class="rounded">
                <li class="arrow"><a href="#ajax_post">POST Form Example</a></li>
                <li class="arrow"><a href="ajax.html">GET Example</a></li>
                <li class="arrow"><a href="#callback">With Callback</a></li>
            </ul>
        </div>
        <div id="animations">
            <div class="toolbar">
                <h1>Animations</h1>
                <a class="back" href="#">Home</a>
            </div>
            <ul class="rounded">
                <li><a href="#animdemo">Slide</a></li>
                <li><a class="slideup" href="#animdemo">Slide Up</a></li>
                <li><a class="dissolve" href="#animdemo">Dissolve</a></li>
                <li><a class="fade" href="#animdemo">Fade</a></li>
                <li><a class="flip" href="#animdemo">Flip</a></li>
                <li><a class="pop" href="#animdemo">Pop</a></li>
                <li><a class="swap" href="#animdemo">Swap</a></li>
                <li><a class="cube" href="#animdemo">Cube</a></li>
            </ul>
            <div class="info">
                Custom animations are also <a href="http://code.google.com/p/jqtouch/wiki/Animations" target="_blank">easy to write</a>. <br />View the source in <code>demos/customanimation</code> to see how.
            </div>
        </div>
        <div id="animdemo">
            <div style="font-size: 1.5em; text-align: center; margin: 160px 0 160px; font-family: Marker felt;">
                Pretty smooth, eh?            
            </div>
            <a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="whiteButton goback">Go back</a>
        </div>
        <div id="callbacks">
            <div class="toolbar">
                <h1>Events</h1>
                <a class="back" href="#home">Home</a>
            </div>
            <ul class="rounded">
                <li><a href="#pageevents">Page events</a></li>
                <li id="swipeme">Swipe me!</li>
                <li id="orient">Orientation: <strong>profile</strong></li>
            </ul>
        </div>
        <div id="demos">
            <div class="toolbar">
                <h1>Demos</h1>
                <a class="back" href="#home">Home</a>
            </div>
            <div class="info">
                These apps open in a new window. Don&#8217;t forget to save them to your home screen to enable full-screen mode.
            </div>
            <ul class="rounded">
                <li class="forward"><a target="_webapp" href="../todo/">To-Do app</a></li>
                <li class="forward"><a target="_webapp" href="../clock/">Clock app</a></li>
            </ul>
        </div>
        <div id="edge">
            <div class="toolbar">
                <h1>Edge to Edge</h1>
                <a href="#" class="back">Back</a>
            </div>
            <ul class="edgetoedge">
                <li class="sep">F</li>
                <li><a href="#">Flintstone, <em>Fred</em></a></li>
                <li><a href="#">Flintstone, <em>Pebble</em></a></li>
                <li><a href="#">Flintstone, <em>Wilma</em></a></li>
                <li class="sep">J</li>
                <li><a href="#">Jetson, <em>Elroy</em></a></li>
                <li><a href="#">Jetson, <em>George</em></a></li>
                <li><a href="#">Jetson, <em>Jane</em></a></li>
                <li><a href="#">Jetson, <em>Judy</em></a></li>
                <li class="sep">R</li>
                <li><a href="#">Rubble, <em>Bambam</em></a></li>
                <li><a href="#">Rubble, <em>Barney</em></a></li>
                <li><a href="#">Rubble, <em>Betty</em></a></li>
            </ul>
        </div>
        <div id="extensions">
            <div class="toolbar">
                <h1>Extensions</h1>
                <a class="back" href="#home">Home</a>
            </div>
            <div class="info">
                These apps open in a new window. Don&#8217;t forget to save them to your home screen to enable full-screen mode.
            </div>
            <ul class="rounded">
                <li class="forward"><a target="_webapp" href="../ext_location/">Geo Location</a></li>
                <li class="forward"><a target="_webapp" href="../ext_offline/">Offline Utility</a></li>
                <li class="forward"><a target="_webapp" href="../ext_floaty/">Floaty Bar</a></li>
                <li class="forward"><a target="_webapp" href="../ext_autotitles/">Auto Titles</a></li>
            </ul>
        </div>
        <div id="forms">
            <div class="toolbar">
                <h1>Forms</h1>
                <a href="#" class="back">Back</a>
            </div>
            <form>
                <ul class="edit rounded">
                    <li><input type="text" name="name" placeholder="Text" id="some_name" /></li>
                    <li><input type="text" name="search" placeholder="Search" id="some_name" /></li>
                    <li><input type="text" name="phone" placeholder="Phone" id="some_name"  /></li>
                    <li><input type="text" name="zip" placeholder="Numbers" id="some_name" /></li>
                    <li><textarea placeholder="Textarea" ></textarea></li>
                    <li>Sample Toggle <span class="toggle"><input type="checkbox" /></span></li>
                    <li>
                        <select id="lol">
                            <optgroup label="Swedish Cars">
                                <option value ="volvo">Volvo</option>
                                <option value ="saab">Saab</option>
                            </optgroup>
                            <optgroup label="German Cars">
                                <option value ="mercedes">Mercedes</option>
                                <option value ="audi">Audi</option>
                            </optgroup>
                        </select>
                    </li>
                    <li><input type="password" name="some_name" value="iphonedelcopon" id="some_name" /></li>
                    <li><input type="checkbox" name="some_name" value="Hello" id="some_name" title="V8 Engine Type" /></li>
                    <li><input type="checkbox" name="some_name" value="Hello" checked="checked" id="some_name" title="V12 Engine Type" /></li>
                    <li><input type="radio" name="some_name" value="Hello" id="some_name" title="Only cars" /></li>
                    <li><input type="radio" name="some_name" value="Hello" id="some_name" title="Only motorbikes" /></li>
                </ul>
            </form>
        </div>
        <div id="callback">
            <!-- <div class="toolbar">
                <h1>AJAX w/Callback</h1>
                <a class="back" href="#">Ajax</a>
            </div> -->
			<div class="toolbar">
                <h1><img src="./themes/jqt/img/img_logo.png"></h1>
                <a class="button_help slideup" id="infoButton" href="#bb_menu">&nbsp;?&nbsp;</a>
                <a class="button pop" id="infoButton" href="#about">로그인</a>
            </div>
        </div>
        <!--★★ 메인페이지 시작 ★★-->
        <div id="home" class="current">
            <div class="toolbar">
                <h1><img src="./themes/jqt/img/img_logo.png"></h1>
                <a class="button_help slideup" id="infoButton" href="#bb_menu">&nbsp;?&nbsp;</a>
                <a class="button pop" id="infoButton" href="#about">로그인</a>
            </div>
			<ul class="rounded">
			<?=$prn_itemlist?>
            </ul>
<script>
$('#item').stopTime('sub_control');
mainItemList();
</script>
            <div class="info">
                <p>"홈 화면에 추가"를 하시면 풀스크린모드로 쉽게 접속이 가능합니다.</p>
            </div>
        </div>
        <!--★★ 메인페이지 끝 ★★-->
        <div class="floaty">
    바나나<br />
            바나나
            </div>
    
    </body>
</html>