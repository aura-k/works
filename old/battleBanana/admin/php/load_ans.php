<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	
	$sql=mysql_query("select * from BBanana_qnas where no='".$_GET['no']."';") or die(mysql_error());
	$row=mysql_fetch_array($sql);
 ?>
  <textarea id="qna_description_<?=$_GET['no']?>" name="qna_description" style="width:400px; height:100px;"><?=$row['qna_answer']?></textarea>
  <br>
  <input type="button" value="답변수정" onclick="modify_answer('<?=$_GET['no']?>')">
  <input type="button" value="취소" onclick="location.reload();">