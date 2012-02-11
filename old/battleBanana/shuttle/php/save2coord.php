<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type='text/javascript' src='../js/jquery-1.4.2.min.js'></script>
<link type="text/css" href="../css/common.css" rel="stylesheet" />
<?
include './connect.php';
/*
┌------ 업체약어 --------┐
│01.쇼킹온----------sk1,2│
│02.티켓몬스터------tm1,2│
│03.슈거딜----------sg   │
│04.원데이플레이스--op   │
│05.데일리픽--------dp   │
│06.쿠펀------------kf   │
│07.키위------------qw   │
│08.파티윈----------pw   │
│10.할인의추억------cm   │
│11.kupon-----------kp123│
│12.딜즈온----------do(X)│
│13.반토막티켓------bt(X)│
│14.트윗폰----------tp   │
│15.쿠팡------------cp   │
│16.위폰------------wp   │
└------------------------┘
*/
?>
<script>
function saveadd(sid){
	var add = document.getElementById('add_'+sid).value;
	
	$.post("./coordAction.php", {"sid" : sid, "add" : add},function(data){
		if(data == 'ok'){
			location.reload();
			return;
		}else{
			alert('저장에 실패하였습니다.');
			location.reload();
			return;
		}
	});
}
</script>
<body>
<table width="550px" cellpadding="5" cellspacing="1" border="0" style="color:black;font-size:12px">
<?
$sql=mysql_query("SELECT * FROM `C_datalist` as A where c_date = (SELECT MAX(c_date) FROM `C_datalist` where c_name = A.c_name) order by no asc") or die(mysql_error());
	$i=0;
	$cnt=0;
	while($row=mysql_fetch_array($sql)){
?>
<tr>
	<td rowspan="2" width="20px" align="center" bgcolor="#C6C6C6"><?=$row['no']?></td>
	<td colspan="3" bgcolor="#7DB87C"><b>|<?=$row['c_name']?>|</b> - <a href="<?=$row['c_url']?>" target="_blank" style="color:black;text-decoration:none;font-size:12px"><?=$row['c_title']?></a></td>
</tr>
<tr>
	<td width="30px" align="center">주소</td>
	<td width="420px"><input type="text" id="add_<?=$row['no']?>" style="width:410px" value="<?=$row['c_add']?>"></td>
	<td><input type="button" value="입력" onclick="saveadd('<?=$row['no']?>')"></td>
</tr>
<tr>
	<td height="10px" colspan="4"></td>
</tr>
<?
		$i++;
		++$cnt;
	}
	mysql_close($connect);
?>
</body>