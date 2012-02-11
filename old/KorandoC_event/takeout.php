<?
	if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), 'MOBILE') === FALSE)
	{
		exit;
	}
	
	include_once "modules/movie.php";
	
	$movie = getMovie('./movies', $_GET['name']);
	
	if ($movie === NULL)
	{
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<title>롯데멤버스 Mobile Takeout</title>
	<script type="text/javascript">
		function shareFacebook()
		{
			window.open("http://m.facebook.com/sharer.php?u=<?=urlencode('http://apps.facebook.com/lottemembers_stage/detail.php?name='.$_GET['name'])?>&t=<?=urlencode($movie['title'])?>");
		}
		
		function shareTwitter()
		{
			window.open("http://twitter.com/intent/tweet?original_referer=<?=urlencode('http://apps.facebook.com/lottemembers_stage/detail.php?name='.$_GET['name'])?>&url=<?=urlencode('http://link.brightcove.com/services/player/bcpid966673287001?bckey=AQ~~,AAAAFLZ6ILk~,aWkqraLhqhR7EWw_Wod2JT0d7v7L3Vzz&bctid='.$movie['code'])?>&text=<?=urlencode($movie['title'])?>");
		}
	</script>
	<style type="text/css">
		body, html, form { margin:0; padding:0; background-color:#515151; }
		
		img { border:0; }
		
		#wrapper { background-color:#606060; width:100%; }
		
		#movie { width:100%; text-align:center; }
		#movie #thumbnail { position:absolute; top:10px; left:50%; margin-left:-150px; width:301px; height:233px; background:url('images/bg_mobi_vod.png') no-repeat; }
		#movie #thumbnail div { padding-top:70px; }
		#movie #title { padding-top:248px; padding-bottom:15px; font-size:10pt; font-weight:bold; font-family:dotum, apple gothic; color:#cccccc; white-space:nowrap; text-overflow:ellipsis; overflow:hidden; }
		
		#sheet { background-color:#515151; width:100%; text-align:center; }
		#sheet #shareFacebook { padding-top:20px; padding-bottom:3px; }
		#sheet #shareTwitter { padding-top:3px; padding-bottom:20px; }
	</style>
</head>
<body>
	<div id="wrapper">
		<div id="movie">
			<div style="height:10px;"></div>
			<div id="thumbnail">
				<div>
					<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
					<object id="myExperience677968207001" class="BrightcoveExperience">
						<param name="bgcolor" value="#000000" />
						<param name="width" value="250" />
						<param name="height" value="140" />
						<param name="playerID" value="891845248001" />
						<param name="playerKey" value="AQ~~,AAAAFLZ6ILk~,aWkqraLhqhSlv2m37iSdqnK8CLJia_W5" />
						<param name="isVid" value="true" />
						<param name="isUI" value="true" />
						<param name="dynamicStreaming" value="true" />
						<param name="@videoPlayer" value="<?=$movie['code']?>" />
					</object>
					<script type="text/javascript">brightcove.createExperiences();</script>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div id="title"><?=htmlspecialchars($movie['title'])?></div>
		</div>
		<div id="sheet">
			<div id="shareFacebook">
				<a href="javascript:shareFacebook();"><img src="images/btn_mobi_share_facebook.png" width="278" height="46" /></a>
			</div>
			<div id="shareTwitter">
				<a href="javascript:shareTwitter();"><img src="images/btn_mobi_share_twitter.png" width="278" height="46" /></a>
			</div>
		</div>
	</div>
</body>
</html>