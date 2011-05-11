<?
	session_start();
	require_once "config.php";
	if($_SESSION["ADMIN"]  != "yes"){
		$url = _ROOT.'/index.php';
		echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		exit;
	}
	$backColor = "#efefef";
	require_once _PHP."/sess_func.php";
	include_once _INC."/header.php";
	include "./php/connect.php"; //디비 정의 페이지 
?>
<div id="list" align="right">
	<div class="list_search">
		<span><input type="text" name="search_txt" id="search_txt" /></span>
		<span><img src="img/btn_search.gif" align="absbottom"/></span>
	</div>
	<table id="table_list" border="0" class="list">
	  <thead>
	  <tr>
		<td>코드번호</td>
		<td>전화번호</td>
		<td>상품</td>
		<td>코드발행여부</td>
		<td>상품수령여부</td>
		<td>수령지점</td>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  </tbody>
	</table>
	<div class="pagenation">&lt; 1 2 3 4 5 &gt;</div>
  </div>
<?include "./inc/footer.php";?>