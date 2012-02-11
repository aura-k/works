<?
	include "m_connect.php";
	include "../../php/define_battle.php";
	
	$sql=mysql_query("select * from BBanana_items where item_id='".$_GET['sid']."'") or die(mysql_error());
	$row=mysql_fetch_array($sql);

	$sql2=mysql_query("select * from BBanana_autobids where item_id='".$_GET['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
	$row2=mysql_fetch_array($sql2);
	
	if(!$row2) $auto_banana=0;
	else $auto_banana = $row2['auto_banana'];

	if($auto_banana != 0){
?>
<table cellpadding="0" cellspacing="0" border="0" style="padding:10px;background:white">
<tr>
	<td><img src="../img/pop/img_banana_num.gif"/></td>
	<td height="34"><img src="../img/pop/bg_input_l.gif"/></td>
	<td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c.gif); background-repeat:repeat-x;"><input name="login_id" type="text" value="" class="search_box" id="login_id" style="outline-style:none;"  onBlur="checkid_login(\'login_id\')" onKeyup="checkid_login(\'login_id\')"/></td>
	<td><img src="../img/pop/bg_input_r.gif"/></td>
	<td><div id="login_id_layer"><img src="../img/pop/img_conf_x.gif" /></div></td>
</tr>
</table>
<?
	}else{
?>
<table cellpadding="0" cellspacing="0" border="0" style="padding:10px;background:white">
<tr>
	<td><img src="../img/pop/img_banana_num.gif"/></td>
	<td height="34"><img src="../img/pop/bg_input_l_d.gif"/></td>
	<td height="34" width="100%" style="background-image:url(../img/pop/bg_input_c_d.gif); background-repeat:repeat-x;">
	999개 대기중
	</td>
	<td style="background-image:url(../img/pop/bg_input_c_d.gif); background-repeat:repeat-x;"><img src="../img/pop/btn_auto_cancel.gif"/></td>
	<td><img src="../img/pop/bg_input_r_d.gif"/></td>
</tr>
</table>
<?
	}	
?>