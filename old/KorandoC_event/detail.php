<?
	// 한글
	
	include_once "modules/movie.php";
	
	$movie = getMovie('./movies', $_GET['name']);
	
	if ($movie === NULL)
	{
		header('Location:index.php');
		exit;
	}
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="title" content="<?=htmlspecialchars($movie['title'])?>" />
	<meta name="description" content="<?=htmlspecialchars($movie['title'])?>" />
	<link rel="image_src" href="<?=$movie['url']?>" />
	<link rel="video_src" href="http://c.brightcove.com/services/viewer/federated_f9?isVid=1&isUI=1&publisherID=20318290001&playerID=966673287001&domain=embed&videoId=<?=$movie['code']?>" />
	<title><?=htmlspecialchars($movie['title'])?></title>
	<style type="text/css">
		img { border:0; }
		
		.contentTitle { width:520px; background-color:#f2f2f2; border-top:1px solid #e2e2e2; padding:5px 0 5px 0; margin:0; }
		.contentTitle .contentTitleText { font-size:8pt; font-family:dotum, apple gothic; color:#202020; margin-left:5px; font-weight:bold; float:left; }
		.contentTitle .contentTitleMore a { font-size:8pt; font-family:dotum, apple gothic; color:#336699; margin-right:5px; float:right; text-decoration:none; }
		.contentTitle .contentTitleMore a:hover { text-decoration:underline; }
		
		.contentMore { width:520px; background-color:#edeff4; border:1px solid #d8dfea; padding:10px 0 10px 0; cursor:pointer; }
		.contentMore .contentMoreText { padding-left:10px; color:#336699; font-size:8pt; font-family:dotum, apple gothic; }
		
		#bigPleasure { width:520px; overflow:hidden; }
		
		#bigPleasure #bigPleasurePlayer { position:absolute; top:0; left:0; background:url('images/bg_main.png') no-repeat; width:520px; height:487px; position:absolute; }
		#bigPleasure #bigPleasurePlayer #bigPleasurePlayerThumbnail { position:absolute; top:90px; width:464px; left:32px; height:353px; }
		#bigPleasure #bigPleasurePlayer #bigPleasurePlayerText { position:absolute; top:455px; left:40px; width:440px; color:#cccccc; font-size:10pt; font-family:dotum, apple gothic; font-weight:bold; text-overflow:ellipsis; white-space:nowrap; overflow:hidden; }
		
		#bigPleasure #bigPleasureShare { position:absolute; top:515px; left:8px; width:512px; }
		#bigPleasure #bigPleasureShare #bigPleasureShareFacebook { position:absolute; left:0; top:0; }
		#bigPleasure #bigPleasureShare #bigPleasureShareTwitter { position:absolute; left:0; top:59px; }
		#bigPleasure #bigPleasureShare #bigPleasureShareTakeOut { position:absolute; left:189px; top:0; background:url('images/bg_share_mobile.png') no-repeat; width:323px; height:115px; }
		#bigPleasure #bigPleasureShare #bigPleasureShareTakeOut #bigPleasureShareTakeOutColor { position:absolute; top:17px; left:111px; width:84px; height:84px; }
		#bigPleasure #bigPleasureShare #bigPleasureShareTakeOut #bigPleasureShareTakeOutiPhone { position:absolute; top:80px; left:205px;  }
		#bigPleasure #bigPleasureShare #bigPleasureShareTakeOut #bigPleasureShareTakeOutAndroid { position:absolute; top:80px; left:246px;  }
		
		#bigPleasure #bigPleasureLatest { position:absolute; left:0; top:520px; white-space:nowrap; overflow:hidden; width:520px; height:110px; }
		#bigPleasure #bigPleasureLatest .latestContentList { float:left; margin:5px 3px 0 2px; }
		#bigPleasure #bigPleasureLatest .latestContentList .latestBackgroundFrame { position:absolute; background:url('images/img_thumb_frame.gif') no-repeat; width:98px; height:60px; overflow:hidden; }
		#bigPleasure #bigPleasureLatest .latestContentList .latestDescription { width:98px; margin-top:2px; text-align:center; font-family:dotum, apple gothic; color:#336699; font-size:8pt; text-overflow:ellipsis; white-space:nowrap; overflow:hidden; }
		#bigPleasure #bigPleasureLatest .latestContentList .latestDescription a { text-decoration:none; color:#336699; }
		#bigPleasure #bigPleasureLatest .latestContentList .latestDescription a:hover { text-decoration:underline; color:#336699; }
		#bigPleasure #bigPleasureLatest .latestContentList .latestDescription a:visit { text-decoration:none; color:#336699; }
		#bigPleasure #bigPleasureLatest .latestContentList img { width:98px; height:60px; }
		
		#bigPleasure #bigPleasureComment { position:absolute; left:0; top:775px; }
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body style="margin:0; padding:0; width:520px;">
	<script>
		window.fbAsyncInit = function() {
			var obj = new Object;
			obj.width = 520;
			obj.height = 900;
			FB.Canvas.setSize(obj);
			FB.Canvas.setAutoResize();
		};
		
		(function() {
			var e = document.createElement('script');
			e.src = document.location.protocol + '//connect.facebook.net/ko_KR/all.js';
			e.async = true;
			document.getElementById('fb-root').appendChild(e);
		}());
		
		function shareFacebook()
		{
			window.open("http://www.facebook.com/sharer/sharer.php?u=<?=urlencode('http://apps.facebook.com/lottemembers_stage/detail.php?name='.$_GET['name'])?>&t=<?=urlencode($movie['title'])?>", 'LOTTEMEMBERS_SHARE_FACEBOOK', 'width=500, height=500');
		}
		
		function shareTwitter()
		{
			window.open("http://twitter.com/intent/tweet?original_referer=<?=urlencode('http://apps.facebook.com/lottemembers_stage/detail.php?name='.$_GET['name'])?>&url=<?=urlencode('http://link.brightcove.com/services/player/bcpid966673287001?bckey=AQ~~,AAAAFLZ6ILk~,aWkqraLhqhR7EWw_Wod2JT0d7v7L3Vzz&bctid='.$movie['code'])?>&text=<?=urlencode($movie['title'])?>", 'LOTTEMEMBERS_SHARE_TWITTER', 'width=500, height=500');
		}
	</script>
	<script src="http://connect.facebook.net/ko_KR/all.js#xfbml=1"></script>
	<div id="bigPleasure">
		<div id="bigPleasurePlayer">
			<div id="bigPleasurePlayerThumbnail">
				<!-- Start of Brightcove Player -->
				<div style="display:none">
				</div>
				<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
				<object id="myExperience677968207001" class="BrightcoveExperience">
					<param name="bgcolor" value="#000000" />
					<param name="width" value="464" />
					<param name="height" value="353" />
					<param name="playerID" value="891845248001" />
					<param name="playerKey" value="AQ~~,AAAAFLZ6ILk~,aWkqraLhqhSlv2m37iSdqnK8CLJia_W5" />
					<param name="isVid" value="true" />
					<param name="isUI" value="true" />
					<param name="dynamicStreaming" value="true" />
					<param name="@videoPlayer" value="<?=$movie['code']?>" />
				</object>
				<script type="text/javascript">brightcove.createExperiences();</script>
				<!-- End of Brightcove Player -->
			</div>
			<div id="bigPleasurePlayerText"><?=$movie['title']?></div>
		</div>
		<div id="bigPleasureLatest">
			<?
				$count = 0;
				$movies = getMovies('./movies', 5);
				foreach ($movies as $movieItem)
				{
					if ($count >= 5) break;
			?>
			<div class="latestContentList">
				<a href="detail.php?name=<?=$movieItem['file']?>"><div class="latestBackgroundFrame">&nbsp;</div><img src="<?=htmlspecialchars($movieItem['url'])?>" /></a><div class="latestDescription"><a href="detail.php?name=<?=$movieItem['file']?>"><?=$movieItem['sTitle']?></a></div>
			</div>
			<?
					$count++;
				}
			?>
		</div>
		<div id="bigPleasureComment">
			<!-- <div style="margin-bottom:5px;">
				<fb:like width="500" show_faces="no" href="http://apps.facebook.com/lottemembers_stage/detail.php?name=<?=$movie['file']?>"></fb:like>
			</div> -->
			<div>
				<fb:comments href="http://apps.facebook.com/lottemembers_stage/detail.php?name=<?=$movie['file']?>" num_posts="8" width="520"></fb:comments>
			</div>
		</div>
	</div>
	<div class="clear:both;"></div>
	<div id="fb-root"></div>
</body>
</html>
