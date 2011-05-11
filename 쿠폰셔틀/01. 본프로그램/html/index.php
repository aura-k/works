<?
	include '../php/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>쿠폰셔틀</title>
<link type="text/css" href="/css/common.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="/img/favi.ico" />
<script type='text/javascript' src='/js/jquery-1.4.2.min.js'></script>
<script type="text/javascript" src="/js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="/js/jquery.endless-scroll-1.3.js"></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps2.js?apikey=8e655bb7cb2508a69d28542aaefa1c22239c1549"></script>
<script type='text/javascript' src='/js/modalpop.js'></script>
<script type="text/javascript" src="/js/trustlogo.js"></script>
<style type="text/css">
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
  
#boxes .window {
  position:absolute;
  _position:absolute;
  left:0;
  top:0;
  display:none;
  z-index:9999;
  position:fixed;
}
#boxes{
	position:fixed;
	_position:absolute;
	z-index:9999;
	clip:rect(0 100 85 0);
	_top:expression(document.documentElement.scrollTop+document.documentElement.clientHeight/2-this.clientHeight/2);
	_left:expression(document.documentElement.clientWidth/2 - 221);
}
.png24 {
   tmp:expression(setPng24(this));
}
</style>
<script>
var RemainTime;
var insert_cate="", insert_region="";

function showCountdown(ExpireTime){
	var day, hour, min, sec, mod;
	var CountText;
	RemainTime = ExpireTime - 1;

	CountText = "";

	if (RemainTime >= 0){
		day = Math.floor(ExpireTime / (3600 * 24));
		mod = ExpireTime % (24 * 3600);

		hour = Math.floor(ExpireTime / 3600);
		mod = mod % 3600;

		min = Math.floor(mod / 60);

		sec = mod % 60;
		
		if(hour<10) hour = "0"+hour;
		if(min<10) min = "0"+min;
		if(sec<10) sec = "0"+sec;

		CountText = hour+':'+min+':'+sec;
	}

	$('#cdown').text(CountText);

	if (CountText != "00:00:00"){
		setTimeout("showCountdown(RemainTime)", 1000);
	}
}
var c_table_x = 146;
/*$(window).scroll(function () {
	if($(window).scrollTop() >= c_table_x) {
		document.getElementById("hidden_menu").style.opacity = "0.95";
		$('#hidden_menu').show();
		$('#hidden_menu').addClass('floatHeader');
		//$('#chartHeaderHidden').css("display", "inline"); 
	} else {
		
		$('#hidden_menu').hide();
		$('#hidden_menu').removeClass('floatHeader');
		//$('#chartHeaderHidden').css("display", "none"); 
	}
});
$(document).endlessScroll({
	bottomPixels: 50,
	fireDelay: 10,
	callback: function(p){
		AppendList(1);
		//$("#append_0").trigger("click");
	}
});
*/
function setPng24(obj) {
	obj.width=obj.height=1;
	obj.className=obj.className.replace(/\bpng24\b/i,'');
	obj.style.filter =
	"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');"
	obj.src=''; 
	return '';
}

if(typeof document.compatMode!='undefined'&&document.compatMode!='BackCompat'){
	cot_t1_DOCtp="_top:expression(document.documentElement.scrollTop+document.documentElement.clientTop-this.clientTop+274);_left:0;}";
}else{
	cot_t1_DOCtp="_top:expression(document.body.scrollTop+document.body.clientHeight-this.clientHeight);_left:expression(document.body.scrollLeft + document.body.clientWidth - offsetWidth);}";
}
var cot_tl_fixedCSS='#win_fixed{position:fixed;';
var cot_tl_fixedCSS=cot_tl_fixedCSS+'_position:absolute;';
var cot_tl_fixedCSS=cot_tl_fixedCSS+'top:274px;';
var cot_tl_fixedCSS=cot_tl_fixedCSS+'left:0;';
var cot_tl_fixedCSS=cot_tl_fixedCSS+'clip:rect(0 142 110 0);';
var cot_tl_fixedCSS=cot_tl_fixedCSS+cot_t1_DOCtp;
document.write('<style type="text/css">'+cot_tl_fixedCSS+'</style>');
TrustLogo("", "SC2", "none");


var iframeids=["myframe"]
var iframehide="yes"
 
var getFFVersion=navigator.userAgent.substring(navigator.userAgent.indexOf("Firefox")).split("/")[1]
var FFextraHeight=getFFVersion>=0.1? 16 : 20 //extra height in px to add to iframe in FireFox 1.0+ browsers
 
function resizeCaller() {
    var dyniframe=new Array()
    for (i=0; i<iframeids.length; i++){
    if (document.getElementById)
        resizeIframe(iframeids[i])
    if ((document.all || document.getElementById) && iframehide=="no"){
    var tempobj=document.all? document.all[iframeids[i]] : document.getElementById(iframeids[i])
        tempobj.style.display="block"
        }
    }
}
 
function resizeIframe(frameid){
    var currentfr=document.getElementById(frameid)
    if (currentfr && !window.opera){
        currentfr.style.display="block"
    if (currentfr.contentDocument && currentfr.contentDocument.body.offsetHeight) //ns6 syntax
        currentfr.height = currentfr.contentDocument.body.offsetHeight+FFextraHeight; 
    else if (currentfr.Document && currentfr.Document.body.scrollHeight) //ie5+ syntax
        currentfr.height = currentfr.Document.body.scrollHeight+50;
    if (currentfr.addEventListener)
        currentfr.addEventListener("load", readjustIframe, false)
    else if (currentfr.attachEvent){
        currentfr.detachEvent("onload", readjustIframe) // Bug fix line
        currentfr.attachEvent("onload", readjustIframe)
        }
    }
}
 
function readjustIframe(loadevt) {
    var crossevt=(window.event)? event : loadevt
    var iframeroot=(crossevt.currentTarget)? crossevt.currentTarget : crossevt.srcElement
    if (iframeroot)
        resizeIframe(iframeroot.id);
}
 
function loadintoIframe(iframeid, url){
    if (document.getElementById)
        document.getElementById(iframeid).src=url
    }
    if (window.addEventListener)
        window.addEventListener("load", resizeCaller, false)
    else if (window.attachEvent)
        window.attachEvent("onload", resizeCaller)
    else
        window.onload=resizeCaller
 
function doResize() 
{ 
container.height = myframe.document.body.scrollHeight; 
container.width = myframe.document.body.scrollWidth+100; 
} 

	function go(option, param){
		if(!$.browser.msie){
			$('#onlyie').hide();
		}
		$('#list_button').html('<a onclick="go(\'list\')" style="cursor:pointer"><img src="/img/btn_list.png" name="btn_list" id="btn_list" onmouseover=javascript:btn_list.src=\'/img/btn_list_o.png\'; onmouseup=javascript:btn_list.src=\'/img/btn_list_o.png\'; onmouseout=javascript:btn_list.src=\'/img/btn_list.png\'; onmousedown=javascript:btn_list.src=\'/img/btn_list_c.png\';></a>');
		$('#map_button').html('<a onclick="go(\'map\')" style="cursor:pointer"><img src="/img/btn_map.png" name="btn_map" id="btn_map" onmouseover=javascript:btn_map.src=\'/img/btn_map_o.png\'; onmouseup=javascript:btn_map.src=\'/img/btn_map_o.png\'; onmouseout=javascript:btn_map.src=\'/img/btn_map.png\'; onmousedown=javascript:btn_map.src=\'/img/btn_map_c.png\';></a>');

		$('#hidden_list_button').html('<a onclick="go(\'list\')" style="cursor:pointer"><img src="/img/btn_list.png" name="btn_list" id="btn_list" onmouseover=javascript:btn_list.src=\'/img/btn_list_o.png\'; onmouseup=javascript:btn_list.src=\'/img/btn_list_o.png\'; onmouseout=javascript:btn_list.src=\'/img/btn_list.png\'; onmousedown=javascript:btn_list.src=\'/img/btn_list_c.png\';></a>');
		$('#hidden_map_button').html('<a onclick="go(\'map\')" style="cursor:pointer"><img src="/img/btn_map.png" name="btn_map" id="btn_map" onmouseover=javascript:btn_map.src=\'/img/btn_map_o.png\'; onmouseup=javascript:btn_map.src=\'/img/btn_map_o.png\'; onmouseout=javascript:btn_map.src=\'/img/btn_map.png\'; onmousedown=javascript:btn_map.src=\'/img/btn_map_c.png\';></a>');
		$('#hidden_menu').hide();

		$('#contents').hide().html('<table width="920" height="500" cellspacing="0" cellpadding="0" align="center" style="margin:50px"><tr><td align="center">로딩중...</td></tr></table>');
		if(option == 'list'){
			$('#list_button').html('<img src="/img/btn_list_c.png" />');
			$('#hidden_list_button').html('<img src="/img/btn_list_c.png" />');

			$('#contents').fadeIn(1000).load('./list.php?cate='+insert_cate+'&region='+insert_region);
		}else if(option == 'map'){
			$('#map_button').html('<img src="/img/btn_map_c.png" />');
			$('#hidden_map_button').html('<img src="/img/btn_map_c.png" />');

			if(param) $('#contents').fadeIn(1000).load('./map.php?sid='+param);
			else $('#contents').fadeIn(1000).load('./map.php');
		}else if(option == 'board'){
			$('#contents').fadeIn(1000).load('./html/board.php');
		}
	}
	function AppendList(num){
		$('#append_'+(num-1)).load('./list.php?p='+num+'&cate='+insert_cate+'&region='+insert_region);
		/*$('#append_'+(num-1)).html('');
		$.get('./html/list.php?p='+num, function(data){
			$('#contents').append(data);
		});*/
	}

function bookmarksite(title,url){ 
	if (window.sidebar) // firefox 
		window.sidebar.addPanel(title, url, ""); 
	else if(window.opera && window.print){ // opera 
		var elem = document.createElement('a'); 
		elem.setAttribute('href',url); 
		elem.setAttribute('title',title); 
		elem.setAttribute('rel','sidebar'); 
		elem.click(); 
	} 
	else if(document.all)// ie 
		window.external.AddFavorite(url, title); 
} 
function cateOnChange(){
	insert_cate = $('#cate').val();
	insert_region = $('#region').val();
	go("list");
}
</script>
</head>
<?
	if(date('D') == "Fri") $remain_time = mktime(00, 05, 00, date('m'), date('d')+3, date('Y'))-mktime();
	else if(date('D') == "Sat") $remain_time = mktime(00, 05, 00, date('m'), date('d')+2, date('Y'))-mktime();
	else $remain_time = mktime(00, 05, 00, date('m'), date('d')+1, date('Y'))-mktime();
?>
<body onload="go('list');showCountdown(<?=$remain_time?>)">
<div id="boxes"><div id="dialog" class="window"></div></div>
<div id="mask"></div>
<!-- <div id="win_fixed"><p id="onlyie"><a onclick="bookmarksite('쿠폰셔틀', 'http://www.couponshuttle.com')" style="cursor:pointer"><img src="/img/btn_fav.gif" name="btn_fav" id="btn_fav" onmouseover=javascript:btn_fav.src='/img/btn_fav_o.gif'; onmouseup=javascript:btn_fav.src='/img/btn_fav_o.gif'; onmouseout=javascript:btn_fav.src='/img/btn_fav.gif';></a></p><p><a onclick="go('board')" style="cursor:pointer"><img src="/img/btn_board.gif" name="btn_board" id="btn_board" onmouseover=javascript:btn_board.src='/img/btn_board_o.gif'; onmouseup=javascript:btn_board.src='/img/btn_board_o.gif'; onmouseout=javascript:btn_board.src='/img/btn_board.gif';></a></p></div> -->

<div id="hidden_menu" style="display:none;width:100%">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-image:url(/img/bg_main_b.png); background-repeat:repeat-x;">
  <tr>
    <td align="center">
<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="380" align="right" id="hidden_list_button"><a onclick="go('list')" style="cursor:pointer"><img src="/img/btn_list.png" name="btn_hidden_list" id="btn_hidden_list" class="unitPng" onmouseover="javascript:btn_hidden_list.src='/img/btn_list_o.png';" onmouseup="javascript:btn_hidden_list.src='/img/btn_list_o.png';" onmouseout="javascript:btn_hidden_list.src='/img/btn_list.png';" onmousedown="javascript:btn_hidden_list.src='/img/btn_list_c.png';"></a>
    </td>
    <td width="240"></td>
    <td width="380" align="left" id="hidden_map_button"><a onclick="go('map')" style="cursor:pointer"><img src="/img/btn_map.png" name="btn_hidden_map" id="btn_hidden_map" class="unitPng" onmouseover="javascript:btn_hidden_map.src='/img/btn_map_o.png';" onmouseup="javascript:btn_hidden_map.src='/img/btn_map_o.png';" onmouseout="javascript:btn_hidden_map.src='/img/btn_map.png';" onmousedown="javascript:btn_hidden_map.src='/img/btn_map_c.png';"></a>
    </td>
	</tr>
</table>
</td>
</tr>
</table>
</div>


<table width="100%" height="276" border="0" cellspacing="0" cellpadding="0" style="background-image:url(/img/bg_main.gif); background-repeat:repeat-x;">
  <tr valign="top">
    <td>
        <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
				
				
                <table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <!-- <td width="338"> 추가시작-->
                    <td width="380">
                        <table width="360" border="0" cellspacing="0" cellpadding="0" align="right">
                          <tr>
                            <td height="146">
                            <table width="360" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td valign="top" class="top_text" >다음 쿠폰셔틀은 <span id="cdown">00:00:00</span> 뒤에 도착합니다.</td>
                                <td align="right"><img src="/img/logo_l.gif" /></td>
                              </tr>
                            </table>

                            </td>
                          </tr>
                          <tr>
                            <td align="right" id="list_button"><a onclick="go('list')" style="cursor:pointer"><img src="/img/btn_list.gif" name="btn_list" id="btn_list" onmouseover="javascript:btn_list.src='/img/btn_list_o.gif';" onmouseup="javascript:btn_list.src='/img/btn_list_o.gif';" onmouseout="javascript:btn_list.src='/img/btn_list.gif';" onmousedown="javascript:btn_list.src='/img/btn_list_c.gif';"></a></td>
                          </tr>
                        </table>
                    </td>
                    <!--< td width="338"> 추가끝-->
                    <td width="240"><a href='#dialog_up' name='modal' onfocus="this.blur()"><img src="/img/logo.jpg" name="logo" id="logo" onmouseover="javascript:logo.src='/img/logo_o.jpg';" onmouseout="javascript:logo.src='/img/logo.jpg';"></a></td>
                    <td width="380">
                  	  <table width="360" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="146" align="left"><img src="/img/logo_r.gif" /></td>
                          </tr>
                          <tr>
                            <td id="map_button"><a onclick="go('map')" style="cursor:pointer"><img src="/img/btn_map.gif" name="btn_map" id="btn_map" onmouseover="javascript:btn_map.src='/img/btn_map_o.gif';" onmouseup="javascript:btn_map.src='/img/btn_map_o.gif';" onmouseout="javascript:btn_map.src='/img/btn_map.gif';" onmousedown="javascript:btn_map.src='/img/btn_map_c.gif';"></a></td>
                        </tr>
                        </table>
                    </td>
                  </tr>
                </table>
				<div id="category">
					<select id="region" name="region" onchange="cateOnChange()">
						<option value="" selected>-- 전국 --</option>
						<option value="1">서울</option>
						<option value="2">경기</option>
						<option value="3">인천</option>
						<option value="4">부산</option>
						<option value="5">대구</option>
						<option value="6">광주</option>
						<option value="7">대전</option>
						<option value="8">울산</option>
						<option value="9">강원</option>
						<option value="10">충북</option>
						<option value="11">충남</option>
						<option value="12">전북</option>
						<option value="13">전남</option>
						<option value="14">경북</option>
						<option value="15">경남</option>
						<option value="16">제주</option>
						<option value="0">기타</option>
					</select>
					<select id="cate" name="cate" onchange="cateOnChange()">
						<option value="" selected>-- 전체 --</option>
						<option value="1">맛집/카페</option>
						<option value="2">뷰티/생활</option>
						<option value="3">여행/레저</option>
						<option value="4">공연/전시</option>
						<option value="5">패션</option>
						<option value="6">교육</option>
						<option value="7">배송상품/기타</option>
						<option value="8">미분류</option>
					</select>					
				</div>
				<div id="contents"></div>
        </td>
        </tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:40px; background-color:#cecece">
  <tr>
    <td align="center" height="50">ⓒ 2010 쿠폰셔틀</td>
  </tr>
</table>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20131049-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
<?
	mysql_close($connect);
?>