<?
	include '../php/connect.php';
	
	$now_date = mktime(00,00,00,date('m'),date('d'),date('Y'));
	$result = @mysql_query("SELECT * FROM C_xml_datalist where c_date = '".$now_date."' and c_name = '".$_GET['cp']."'");
	$row = mysql_fetch_array($result);
	if(!$row) return;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0106)http://cyimg31.cyworld.com/common/file_down.asp?redirect=%2F310016%2F2010%2F8%2F10%2F69%2Fmap%5Fbox%2Ehtml -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META http-equiv="Content-Type" content="text/html; charset=UTF-8">

<TITLE><?=$row['c_title']?></TITLE>
<LINK type="text/css" href="/css/common.css" rel="stylesheet">
</HEAD><BODY style="background-color:white;">
<DIV class="box">
    <DIV class="item_img"><A href="/php/go.php?id=<?=$row['c_name']?>&url=<?=$row['c_url']?>" target="_blank"><IMG src="<?=$row['c_img']?>" height="100" width="178" alt="<?=$row['c_title']?>" title="<?=$row['c_title']?>"></A></DIV>
    <DIV class="item_tit"><A href="/php/go.php?id=<?=$row['c_name']?>&url=<?=$row['c_url']?>" target="_blank" alt="<?=$row['c_title']?>" title="<?=$row['c_title']?>"><?=mb_strimwidth($row['c_title'], 0, 27, "...", "UTF-8")?></A></DIV>
    <DIV class="item_con"><?=$row['c_people']?> 명 구입</DIV>
    <DIV class="item_pri"><SPAN><?=number_format($row['c_ori_price'])?></SPAN>원 → <?=number_format($row['c_price'])?>원</DIV>
    <DIV class="com_img"><a href="/php/go.php?id=<?=$row['c_name']?>&url=<?=$row['c_url']?>" target="_blank"><img src="../img/com_<?=substr($row['c_name'],0,2)?>.gif"/></a></DIV>
</DIV>

</BODY></HTML>
<?
	mysql_close($connect);
?>