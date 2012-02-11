<?
	$backColor = "#9c9080";
	require_once "config.php";
	require_once _PHP."/sess_func.php";
	include_once _PHP."/checkLoged.php";
	include_once _INC."/header.php";
	include "./php/connect.php"; //디비 정의 페이지 
?>
<div id="search">
        <form id="searchForm" name="searchForm" method="post">
        <div style="margin-bottom:5px;color:#666">코드를 입력해 주세요.</div>
            <input type="text" name="codeVal" id="codeVal" />
        </form>
        <div class="button"><a href="javascript:search_submit()"><img src="img/btn_ok.gif"/></a></div>
        </div>
<?
	$codeVal = trim(preg_replace("/\|/", "", $_POST['codeVal']));
	if($codeVal != ""){
		$sql=@mysql_query("select * from lotte_code where code = '".$codeVal."'") or die(mysql_error()); 
		$row=mysql_fetch_array($sql);
		if($row['code'] != ""){
?>
        <div id="result">
        <div class="detail">
            <div style="margin-bottom:10px;color:#666">해당 코드에 당첨되신 고객님의 정보입니다.</div>
            <div style="margin:10px 0 3px 0;">코드</div><input type="text" name="code_txt" id="code_txt"  value="<?=iconv("EUC-KR","UTF-8", $row['code'])?>"/>
			<div style="margin:10px 0 3px 0;">전화번호</div><input type="text" name="phone_txt" id="phone_txt"  value="<?=iconv("EUC-KR","UTF-8", $row['phone'])?>"/>
            <div style="margin:10px 0 3px 0;">상품</div><input type="text" name="name_txt" id="name_txt" value="<?=iconv("EUC-KR","UTF-8", $row['name'])?>"/>
			<div style="margin:10px 0 3px 0;">상품수령여부</div>
			<?
			if($row['receive'] == "yes")
				echo '<input type="text" name="receive_txt" id="receive_txt" style="background-color:#b2ffb2;" value="예"/>';
			else
				echo '<input type="text" name="receive_txt" id="receive_txt" style="background-color:#ffb2b2;" value="아니오"/>';
			?>
            <div style="margin:10px 0 3px 0;">수령지점</div><input type="text" name="area_txt" id="area_txt" value="<?=iconv("EUC-KR","UTF-8", $row['area'])?>"/>
			<div style="margin:10px 0 3px 0;">코드생성일</div><input type="text" name="date_txt" id="date_txt" value="<?=iconv("EUC-KR","UTF-8", $row['date'])?>"/>
        </div>
		<div class="button">
		<?
		if($row['receive'] == "yes")
			echo '<a href="javascript:cancel_gift()"><img src="img/btn_take_cancel.gif"/></a>';
		else
			echo '<a href="javascript:receive_gift()"><img src="img/btn_take.gif"/></a>';
		?>
		</div>
<?
	}else{
?>
		<div id="result">
        <div class="detail">해당코드 '<?=$codeVal?>'가 존재하지 않습니다.</div>
		</div>
<?
	}
	}
?>
		<div id="blank"></div>
</div>
<?
include _INC."/footer.php";
mysql_close($connect);
?>