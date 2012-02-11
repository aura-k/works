<?
	include "m_connect.php";
	session_start();
	include "../../php/define_battle.php";
	
	if($_GET['sid'] && $_SESSION['ID']){
	$sql=mysql_query("select * from BBanana_items where item_id='".$_GET['sid']."'") or die(mysql_error());
	$row=mysql_fetch_array($sql);

	$sql2=mysql_query("select * from BBanana_autobids where item_id='".$_GET['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
	$row2=mysql_fetch_array($sql2);
	
	if(!$row2) $auto_banana=0;
	else $auto_banana = $row2['auto_banana'];

	if($auto_banana == 0){
?>
<table cellpadding="0" cellspacing="0" border="0" style="padding:10px;background:white">
<tr>
	<td><img src="./img/pop/img_banana_num.gif"/></td>
	<td height="34"><img src="./img/pop/bg_input_l.gif"/></td>
	<td height="34" width="100%" style="background-image:url(./img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input name='auto_bids' type='text' class='input' id='auto_bids' onKeyUp='onlyNumber(this);autoInputVali()' onKeyPress='autokey(event, "<?=$_GET['sid']?>");' onKeyDown='onlyNumber(this);'/></td>
	<td><img src="./img/pop/bg_input_r.gif"/></td>
	<td><div id="auto_bids_layer"><img src="./img/pop/img_conf_x.gif" /></div></td>
</tr>
</table>
<?
	}else{
?>
<table cellpadding="0" cellspacing="0" border="0" style="padding:10px;background:white">
<tr>
	<td><img src="./img/pop/img_banana_num.gif"/></td>
	<td height="34"><img src="./img/pop/bg_input_l_d.gif"/></td>
	<td height="34" width="100%" style="background-image:url(./img/pop/bg_input_c_d.gif); background-repeat:repeat-x;">
	<?=$auto_banana?>개 대기중
	</td>
	<td style="background-image:url(./img/pop/bg_input_c_d.gif); background-repeat:repeat-x;" onclick="cancelAutoBattle('<?=$_GET['sid']?>')"><img src="./img/pop/btn_auto_cancel.gif"/></td>
	<td><img src="./img/pop/bg_input_r_d.gif"/></td>
</tr>
</table>
<?
	}	
	mysql_close($connect);
	}else{
?>
	잘못된 접근입니다.
<?
	}	
?>