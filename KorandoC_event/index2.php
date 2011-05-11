<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <title>코란도</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script src="http://connect.facebook.net/ko_KR/all.js#xfbml=1"></script>
  <style type="text/css">
    body { margin:0px; padding:0px; }
	img { border:0; }
	#top { background:url('images/bg_main.png') no-repeat; width:520px; height:500px; }
	.player { padding:70px 0 0 30px; }
  </style>
 </head>
 <body>
 <script>
	window.fbAsyncInit = function() {
		var obj = new Object;
		obj.width = 520;
		obj.height = 900;
		FB.Canvas.setSize(obj);
		FB.Canvas.setAutoResize();
	};
 </script>
 <div id="top">
	 <div class="player">
	 <!-- Start of Brightcove Player -->
		<div style="display:none;">
		</div>
		<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
		<object id="myExperience677968207001" class="BrightcoveExperience">
			<param name="bgcolor" value="#000000" />
			<param name="width" value="460" />
			<param name="height" value="303" />
			<param name="playerID" value="891845248001" />
			<param name="playerKey" value="AQ~~,AAAAFLZ6ILk~,aWkqraLhqhSlv2m37iSdqnK8CLJia_W5" />
			<param name="isVid" value="true" />
			<param name="isUI" value="true" />
			<param name="dynamicStreaming" value="true" />
			<param name="@videoPlayer" value="677966498001" />
		</object>
		<script type="text/javascript">brightcove.createExperiences();</script>
	 <!-- End of Brightcove Player -->
	 </div>
 </div>
 <ul id="deg_1">
	<li style="width:80px;height:50px;background-color:#000033;"></li>
	<li style="width:80px;height:50px;background-color:#000033;"></li>
	<li style="width:80px;height:50px;background-color:#000033;"></li>
	<li style="width:80px;height:50px;background-color:#000033;"></li>
 </div>
 </body>
</html>
