<?
	// 한글
	
	include_once "modules/movie.php";
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>LotteMembers - Big Pleasure!</title>
	<style type="text/css">
		img { border:0; }
		
		.contentTitle { width:520px; background-color:#f2f2f2; border-top:1px solid #e2e2e2; padding:5px 0 5px 0; margin:0; }
		.contentTitle .contentTitleText { font-size:8pt; font-family:dotum, apple gothic; color:#202020; margin-left:5px; font-weight:bold; float:left; }
		.contentTitle .contentTitleMore a { font-size:8pt; font-family:dotum, apple gothic; color:#336699; margin-right:5px; float:right; text-decoration:none; }
		.contentTitle .contentTitleMore a:hover { text-decoration:underline; }
		
		.contentMore { width:520px; background-color:#edeff4; border:1px solid #d8dfea; padding:10px 0 10px 0; cursor:pointer; }
		.contentMore .contentMoreText { padding-left:10px; color:#336699; font-size:8pt; font-family:dotum, apple gothic; }
		
		#movieList { width:520px; }
		#movieList table { width:100%; }
		#movieList table tr .thumbnail { padding:5px 0 5px 0; border-bottom:1px solid #e9e9e9; width:110px; }
		#movieList table tr .thumbnail img { width:98px; height:60px; }
		#movieList table tr .title { border-bottom:1px solid #e9e9e9; }
		#movieList table tr .title a { font-size:8pt; font-weight:bold; font-family:dotum, apple gothic; color:#336699; text-decoration:none; }
		#movieList table tr .title a:hover { text-decoration:underline; }
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body style="margin:0; padding:0;">
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			var obj = new Object;
			obj.width = 520;
			obj.height = 600;
			FB.Canvas.setSize(obj);
			FB.Canvas.setAutoResize();
		};
		
		(function() {
			var e = document.createElement('script');
			e.src = document.location.protocol + '//connect.facebook.net/ko_KR/all.js';
			e.async = true;
			document.getElementById('fb-root').appendChild(e);
		}());
	</script>
	<div class="contentTitle">
		<div class="contentTitleText">전체 영상</div>
		<!--div class="contentTitleMore"><a href="index.php">&lt-</a></div-->
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
	<div id="movieList">
		<table cellspacing="0" cellpadding="0">
			<?
				$movies = getMovies('./movies');
				
				foreach ($movies as $movie)
				{
			?>
			<tr>
				<td class="thumbnail"><a href="detail.php?name=<?=$movie['file']?>"><img src="<?=$movie['url']?>" /></a></td>
				<td class="title"><a href="detail.php?name=<?=$movie['file']?>"><?=htmlspecialchars($movie['title'])?></a></td>
			</tr>
			<?
				}
			?>
		</table>
	</div>
	<br />
	<!--div class="contentMore">
		<div class="contentMoreText">게시물 더 보기</div>
	</div-->
</body>
</html>
