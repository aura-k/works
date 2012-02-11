<?
	include "dbConfig.php";

	$selDate = $_POST[selDate];

	if($selDate == "")
		$query = "SELECT email, ipaddr, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=105 ORDER BY regdate";
	else
		$query = "SELECT email, ipaddr, Convert(varchar(19),regdate,120) as regdate FROM EVENT_USRLOG WHERE tcode=105 AND Convert(varchar(19),regdate,23) = Convert(varchar(19),'$selDate',23) ORDER BY regdate";

	$result = mssql_query($query);
	
	$querySel = "SELECT distinct Convert(varchar(19),regdate,23) as regdate FROM EVENT_USRLOG WHERE tcode=105 ORDER BY regdate DESC";
	$resultSel = mssql_query($querySel);
	$i = 0;
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>uplus이벤트 사용자 참여 리스트</title>
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
<h1>LG U+Zone이벤트 사용자 참여리스트</h1>
<form action="userList.php" method="post">
<select name="selDate" onchange="goCondition()">
	<option value="">날짜선택</option>
<?
	while($rowSel = mssql_fetch_array($resultSel)) {
		if($rowSel[regdate] == $selDate) echo("<option value=\"$rowSel[regdate]\" selected>$rowSel[regdate]</option>");
		else echo("<option value=\"$rowSel[regdate]\">$rowSel[regdate]</option>");
	}
?>
</select>
</form>
<table class="listTable">
<tr>
<th width="50">No</th><th width="200">이메일</th><th width="200">IP</th><th width="150">참여날짜</th>
</tr>
<?
	while($row = mssql_fetch_array($result)) {
	$i ++;
?>
<tr>
<td><?=$i?></td><td><?=$row[email]?></td><td><?=$row[ipaddr]?></td><td><?=$row[regdate]?></td>
<? 
	}	
?>

</table>

 </body>
</html>