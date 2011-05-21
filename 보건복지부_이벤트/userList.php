<?
	include "dbConfig.php";

	if($_POST[selDate] == "") $selDate = date("Y-m-d",time());
	else $selDate = $_POST[selDate]; 

	$radioOption = $_POST[radioOption];

	if($selDate == "" && $radioOption == "")
		$query = "SELECT name, phone, ipaddr, chk1, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=119 ORDER BY regdate DESC";
	else if($selDate != "" && $radioOption == "")
		$query = "SELECT name, phone, ipaddr, chk1, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=119 AND Convert(varchar(19),regdate,23) = Convert(varchar(19),'$selDate',23) ORDER BY regdate DESC";
	else if($selDate == "" && $radioOption != ""){
		if($radioOption == "pa")
			$query = "SELECT name, phone, ipaddr, chk1, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=119 AND chk1 BETWEEN 1 AND 3 ORDER BY regdate DESC";
		else
			$query = "SELECT name, phone, ipaddr, chk1, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=119 AND chk1='$radioOption' ORDER BY regdate DESC";
	}else{
		if($radioOption == "pa")
			$query = "SELECT name, phone, ipaddr, chk1, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=119 AND chk1 BETWEEN 1 AND 3 AND Convert(varchar(19),regdate,23) = Convert(varchar(19),'$selDate',23) ORDER BY regdate DESC";
		else
			$query = "SELECT name, phone, ipaddr, chk1, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=119 AND chk1='$radioOption' AND Convert(varchar(19),regdate,23) = Convert(varchar(19),'$selDate',23) ORDER BY regdate DESC";
	}
	

	$result = mssql_query($query);
	
	$querySel = "SELECT distinct Convert(varchar(19),regdate,23) as regdate FROM EVENT_USRLOG WHERE tcode=119 ORDER BY regdate DESC";
	$resultSel = mssql_query($querySel);
	$i = 0;
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>보건복지부 이벤트 사용자 참여 리스트</title>
  <style type="text/css">
   body { font-size:10pt; }
  .listTable { font-size:10pt; border-collapse:collapse; }
  .listTable th { background-color:#0d0d0d; color:#ffffff; padding:5px; }
  .listTable td { border:1px solid #0d0d0d; color:#0d0d0d; padding:5px; }
  </style>
  <script type="text/JavaScript">
	function goCondition(){
		document.forms[0].submit();
	}
  </script>
 </head>
 <body>
<h1>보건복지부 이벤트 사용자 참여리스트</h1>
<form action="userList.php" method="post">
<select name="selDate" onchange="goCondition()">
	<option value="">모두보기</option>
<?
	while($rowSel = mssql_fetch_array($resultSel)) {
		if($rowSel[regdate] == $selDate) echo("<option value=\"$rowSel[regdate]\" selected>$rowSel[regdate]</option>");
		else echo("<option value=\"$rowSel[regdate]\">$rowSel[regdate]</option>");
	}
?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
	$radio = "";
	$radio0 = "";
	$radio1 = "";
	$radio2 = "";
	$radio3 = "";

	if($radioOption == "") $radio = " checked";
	else if($radioOption == "0") $radio0 = " checked";
	else if($radioOption == "pa") $radio1 = " checked";
	// if($radioOption == "2") $radio2 = " checked";
	//else if($radioOption == "3") $radio3 = " checked";
?>
<input type="radio" name="radioOption" value="" onclick="goCondition()"<?=$radio?>>모두보기&nbsp;&nbsp;
<input type="radio" name="radioOption" value="0" onclick="goCondition()"<?=$radio0?>>스타벅스(당첨)&nbsp;&nbsp;
<input type="radio" name="radioOption" value="pa" onclick="goCondition()"<?=$radio1?>>파리크라상&nbsp;&nbsp;
<!-- <input type="radio" name="radioOption" value="2" onclick="goCondition()"<?=$radio2?>>파리크라상(한도초과)&nbsp;&nbsp;
<input type="radio" name="radioOption" value="3" onclick="goCondition()"<?=$radio2?>>파리크라상(시간) -->
</form>
<table class="listTable">
<tr>
<th width="50">No</th><th width="200">이름</th><th width="200">전화번호</th><th width="200">IP</th><th width="150">참여날짜</th><th width="130">비고</th>
</tr>
<?
	while($row = mssql_fetch_array($result)) {
	$i ++;

	if($row[chk1] == "0") $chk1Name = "<font color='green'>스타벅스</font>";
	else if($row[chk1] == "1") $chk1Name = "<font color='red'>파리크라상(중복참여)</font>";
	else if($row[chk1] == "2") $chk1Name = "<font color='red'>파리크라상(한도초과)</font>";
	else if($row[chk1] == "3") $chk1Name = "<font color='red'>파리크라상(시간외)</font>";
	else $chk1Name = "<font color='grey'>에러</font>";
?>
<tr>
<td><?=$i?></td><td><?=iconv('EUC-KR', 'UTF-8', $row[name])?></td><td><?=$row[phone]?></td><td><?=$row[ipaddr]?></td><td><?=$row[regdate]?></td><td><?=$chk1Name?></td>
<? 
	}	
?>

</table>

 </body>
</html>