<?
	include '../php/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>쿠폰셔틀</title>
<link type="text/css" href="../css/common.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="../img/favi.ico" />
<script type='text/javascript' src='../js/jquery-1.4.2.min.js'></script>
<script type="text/javascript" src="../js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps2.js?apikey=213588fa994cfce16f7350dbec0d9969ca7056eb"></script>
<script type='text/javascript' src='../js/modalpop.js'></script>
<style>
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
  left:0;
  top:0;
  display:none;
  z-index:9999;
}
</style>
<script>
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
        currentfr.height = currentfr.Document.body.scrollHeight;
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
container.width = myframe.document.body.scrollWidth; 
} 

	function go(option, param){
		$('#list_button').html('<a onclick="go(\'list\')" style="cursor:pointer"><img src="../img/btn_list.gif" name="btn_list" id="btn_list" onmouseover=javascript:btn_list.src=\'../img/btn_list_o.gif\'; onmouseup=javascript:btn_list.src=\'../img/btn_list_o.gif\'; onmouseout=javascript:btn_list.src=\'../img/btn_list.gif\'; onmousedown=javascript:btn_list.src=\'../img/btn_list_c.gif\';></a>');
		$('#map_button').html('<a onclick="go(\'map\')" style="cursor:pointer"><img src="../img/btn_map.gif" name="btn_map" id="btn_map" onmouseover=javascript:btn_map.src=\'../img/btn_map_o.gif\'; onmouseup=javascript:btn_map.src=\'../img/btn_map_o.gif\'; onmouseout=javascript:btn_map.src=\'../img/btn_map.gif\'; onmousedown=javascript:btn_map.src=\'../img/btn_map_c.gif\';></a>');

		$('#contents').hide().html('<table width="920" height="500" cellspacing="0" cellpadding="0" align="center" style="margin:50px"><tr><td align="center">로딩중...</td></tr></table>');
		if(option == 'list'){
			$('#list_button').html('<img src="../img/btn_list_c.gif" />');
			$('#contents').fadeIn(1000).load('list.php');
		}else if(option == 'map'){
			$('#map_button').html('<img src="../img/btn_map_c.gif" />');
			if(param) $('#contents').fadeIn(1000).load('map.php?sid='+param);
			else $('#contents').fadeIn(1000).load('map.php');
		}else if(option == 'board'){
			$('#contents').fadeIn(1000).load('board.php');
		}
	}
</script>
</head>
<body onload="go('list')">
<div style="position:fixed;top:300px;z-index:999;"><a onclick="go('board')" style="cursor:pointer"><img src="../img/btn_board.gif" name="btn_board" id="btn_board" onmouseover=javascript:btn_board.src='../img/btn_board_o.gif'; onmouseup=javascript:btn_board.src='../img/btn_board_o.gif'; onmouseout=javascript:btn_board.src='../img/btn_board.gif';></a></div>
<table width="100%" height="276" border="0" cellspacing="0" cellpadding="0" style="background-image:url(../img/bg_main.gif); background-repeat:repeat-x;">
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
                            <td height="146" align="right"><img src="../img/logo_l.gif" /></td>
                          </tr>
                          <tr>
                            <td align="right" id="list_button"><a onclick="go('list')" style="cursor:pointer"><img src="../img/btn_list.gif" name="btn_list" id="btn_list" onmouseover="javascript:btn_list.src='../img/btn_list_o.gif';" onmouseup="javascript:btn_list.src='../img/btn_list_o.gif';" onmouseout="javascript:btn_list.src='../img/btn_list.gif';" onmousedown="javascript:btn_list.src='../img/btn_list_c.gif';"></a></td>
                          </tr>
                        </table>
                    </td>
                    <!--< td width="338"> 추가끝-->
                    <td width="240"><a href='#dialog_up' name='modal'><img src="../img/logo.jpg" name="logo" id="logo" onmouseover="javascript:logo.src='../img/logo_o.jpg';" onmouseout="javascript:logo.src='../img/logo.jpg';"></a></td>
                    <td width="380">
                  	  <table width="360" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="146" align="left"><img src="../img/logo_r.gif" /></td>
                          </tr>
                          <tr>
                            <td id="map_button"><a onclick="go('map')" style="cursor:pointer"><img src="../img/btn_map.gif" name="btn_map" id="btn_map" onmouseover="javascript:btn_map.src='../img/btn_map_o.gif';" onmouseup="javascript:btn_map.src='../img/btn_map_o.gif';" onmouseout="javascript:btn_map.src='../img/btn_map.gif';" onmousedown="javascript:btn_map.src='../img/btn_map_c.gif';"></a></td>
                        </tr>
                        </table>
                    </td>
                  </tr>
                </table>
				<div id="contents"></div>
        </td>
        </tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:40px; background-color:#cecece">
  <tr>
    <td align="center" height="50">ⓒ 2010 쿠폰셔틀</td>
  </tr>
</table>
<div id="boxes">
<div id="dialog" class="window" style="position:fixed;z-index:9999">
<img src="../img/ajax_loader.gif"/>
</div>
</div>
<div id="mask"></div>
</body>
</html>
<?
	mysql_close($connect);
?>