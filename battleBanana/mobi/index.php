<?
	session_start(); 
	include "./php/m_connect.php";
	include "toolbar.php";
	$prn_itemlist = '';
	$cnt = 0;
	$sql=mysql_query("select * from BBanana_items where item_expired > unix_timestamp(now()) order by item_expired ASC Limit 0,5") or die(mysql_error());
	
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
		}
		
		if($item_hour < 10) $item_hour = "0".$item_hour;
		if($item_min < 10) $item_min = "0".$item_min;
		if($item_sec < 10) $item_sec = "0".$item_sec;

		$prn_itemid[$cnt] = $row['item_id'];

		$prn_itemlist .= '
				<li class="arrow">
					<a class="href" href="#go_'.$row['item_id'].'" style="z-index:10px">
                    <p id="mi_1">'.$row['item_fname'].'</p>
                   <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div id="mi_p"><img src="../'.$row['item_img'].'"></div></td>
                        <td><div class="highlightable_'.$row['item_id'].'"><p id="mi_2"><span id="box_'.$row['item_id'].'" class="box_'.$row['item_id'].'">'.$item_hour.':'.$item_min.':'.$item_sec.'</span></p><p id="mi_3"><span class="price_'.$row['item_id'].'">'.number_format($row['item_price']).'원</span></p><p id="mi_4" class="bider_'.$row['item_id'].'">'.$row['item_lastbider'].'</p></div></td>
                      </tr>
                    </table>
					</a>
				</li>';

		++$cnt;
	}

	$sql_winner=mysql_query("select * from BBanana_winners order by RAND() LIMIT 1") or die(mysql_error());
	$row_winner=mysql_fetch_array($sql_winner);
?>
<!doctype html>
<html>
    <head>
	<meta charset="UTF-8" />
	<title>배틀바나나</title>
	<style type="text/css" media="screen">@import "./css/jqtouch.css";</style>
	<style type="text/css" media="screen">@import "./css/theme.css";</style>
	<script src="./js/jquery.1.3.2.min.js" type="application/x-javascript" charset="utf-8"></script>
	<script src="./js/jqtouch.js" type="application/x-javascript" charset="utf-8"></script>
	<script src="./js/mobile_item.js" type="application/x-javascript" charset="utf-8"></script>
	<script src="./js/jqueryTimers.js" type="application/x-javascript" charset="utf-8"></script>
	<script src="./js/jqt.floaty.js" type="application/x-javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
	var jQT = new $.jQTouch({
	    icon: './img/jqtouch.png',
	    addGlossToIcon: true,
	    startupScreen: './img/jqt_startup.png',
	    statusBar: 'black',
	    preloadImages: [
			'./img/img_logo.png',
			'./img/button.png',
	        './img/button_clicked.png',
	        './img/loading.gif',
			'./img/btn_01.png',
			'./img/btn_02.png',
			'./img/btn_03.png',
			'./img/btn_04.png',
			'./img/btn_01_o.png',
			'./img/btn_02_o.png',
			'./img/btn_03_o.png',
			'./img/btn_04_o.png',
			'./img/bg_menu_ex.png'
	        ]
	});
	$(function(){
		var loader = '<table width="100%" height="150px"><tr><td align="center" valign="middle"><img src="./img/ajax_loader_retangle.gif"/></td></tr></table></div>';
<?
	for($i=0; $i<$cnt; $i++){
?>
		$('#go_<?=$prn_itemid[$i]?>').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(6);//툴바?>'+loader).
				load('item.php?sid=<?=$prn_itemid[$i]?> #item_<?=$prn_itemid[$i]?>', function() {
					$(this).parent().data('loaded', true);
					$('#home').stopTime('sub_control');
					subItemList('<?=$prn_itemid[$i]?>');
			}));
		});
		$('#history_<?=$prn_itemid[$i]?>').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(6);//툴바?>'+loader).
				load('item.php?sid=<?=$prn_itemid[$i]?> #history', function() {
					$(this).parent().data('loaded', true);
			}));
		});
<?
	}
?>
		$('#menu1').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(1);//툴바?>'+loader).
				load('menu.php #favorite', function() {
					$(this).parent().data('loaded', true);
			}));
		});
		$('#menu2').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(2);//툴바?>'+loader).
				load('menu.php #win', function() {
					$(this).parent().data('loaded', true);
			}));
		});
		$('#menu3').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(3);//툴바?>'+loader).
				load('menu.php #bananalist', function() {
					$(this).parent().data('loaded', true);
			}));
		});
		$('#menu4').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(4);//툴바?>'+loader).
				load('menu.php #order', function() {
					$(this).parent().data('loaded', true);
			}));
		});
		$('#closed').bind('pageAnimationEnd', function(e, info){
			$(this).html($('<div><?=toolbar(4);//툴바?>'+loader).
				load('menu.php #closed', function() {
					$(this).parent().data('loaded', true);
			}));
		});
		$('.floaty').makeFloaty({
			spacing: 20,
			time: '0.2s'
		});

	});
</script>
</head>
<body>
<div class="battle_f">
바나나<img src="./img/bg_score.png">
</div>
<!--로그인창 시작-->
<div id="about2">
<?=toolbar(5);//툴바?>
<div class="pop_pad" style="margin:10px;-webkit-border-radius:10px;">
<div class="pop_top">
    <img src="./img/pop/img_login.gif"/ >
</div>
<div class="pop_sub">컴퓨터로 배틀바나나(www.battlebanana.com)에 접속하시면 회원가입과 아이디/비밀번호찾기를 하실 수 있습니다.</div>
<div class="pop_mid"></div>
    <div class="pop_mid" style="overflow:auto;">
      <table cellpadding="0" cellspacing="0" border="0">
          <tr>
			<td><img src="./img/pop/img_id.gif" style="padding-left:15px;" /></td>
            <td height="34"><img src="./img/pop/bg_input_l.gif"/></td>
            <td height="34" width="100%" style="background-image:url(./img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input name="login_id" type="text" class="search_box" id="login_id" style="outline-style:none;"  onBlur="checkid_login('login_id')" onKeyup="checkid_login('login_id')"/></td>
            <td><img src="./img/pop/bg_input_r.gif"/></td>
            <td><div id="login_id_layer"><img src="./img/pop/img_conf_x.gif" /></div></td>
          </tr>
      </table>
    </div>
	<div class="pop_mid" style="overflow:auto;">
	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
              <td><img src="./img/pop/img_pass.gif" /></td>
              <td height="34"><img src="./img/pop/bg_input_l.gif"/></td>
              <td height="34" width="100%" style="background-image:url(./img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input name="login_pass" type="password" class="search_box" id="login_pass" style="outline-style:none;" onBlur="checkpw_login('login_pass')"  onkeyup="checkpw_login('login_pass');" onkeypress="loginkey(event);"/></td>
              <td><img src="./img/pop/bg_input_r.gif"/></td>
              <td><div id="login_pass_layer"><img src="./img/pop/img_conf_x.gif" /></div></td>
          </tr>
      </table>
    </div>
    	<div class="pop_bottom" style="overflow:auto;-webkit-border-radius:0 0 7px 7px;">
        <a onclick="login()"><img src="./img/pop/btn_ok.gif"/></a><a href="#" class="goback"><img src="./img/pop/btn_cancel.gif"/></a>
    </div>
    </div>
    
    <div>
        <table width="290" height="143" border="0" cellspacing="0" cellpadding="0" class="score">
                          <tr>
                            <td background="./img/bg_score.png">
                            	<table width="205" border="0" cellspacing="0" cellpadding="0" align="right">
                                  <tr>
                                    <td>
                                    	<table width="185" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td  class="score_yellow_r"><span class="score_grey_r"><?=$row_winner['user_id']?></span> 님,</td>
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
										<?
											$rates1 = substr($row_winner['rates'],0,1);
											$rates2 = substr($row_winner['rates'],1,1);
										?>
                                          <td width="55"><img src="./img/img_<?=$rates1?>.gif" /></td>
                                          <td width="55"><img src="./img/img_<?=$rates2?>.gif" /></td>
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
                                    <td class="score_yellow">할인된 가격으로<br/><span class="score_grey"><?=mb_strimwidth($row_winner['item_name'], 0, 25, "...", "UTF-8")?></span> 낙찰!!</td>
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

<?
	for($i=0; $i<$cnt; $i++){
?>
		<div id="history_<?=$prn_itemid[$i]?>"></div>
		<div id="go_<?=$prn_itemid[$i]?>"></div>
<?
	}				
?>
		<div id="menu1"></div>
		<div id="menu2"></div>
		<div id="menu3"></div>
		<div id="menu4"></div>

		<div id="closed"></div>

        <!--★★ 메인페이지 시작 ★★-->
        <div id="home" class="current">
			<?=toolbar(0);//툴바?>
			<ul class="rounded">
			<?=$prn_itemlist?>
			</ul>
			<ul class="rounded">
				<li class="arrow" style="color:white"><a class="href" href="#closed">지난 경매 보기</a></li>
			</ul>
			<script>
				$('#item').stopTime('sub_control');
				mainItemList();
			</script>
			<!-- <div class="info">
				<p>"홈 화면에 추가"를 하시면 풀스크린모드로 쉽게 접속이 가능합니다.</p>
			</div> -->
        </div>
        <!--★★ 메인페이지 끝 ★★-->
<?                
			if($_SESSION["ID"])
					echo '<div class="floaty"><span id="quick_banana"></span></div>';
?>
    
    </body>
</html>