<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/point/tpl/filter/","insert_point_module_config.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/point/tpl/js/point_admin.js--><?php Context::addJsFile("modules/point/tpl/js/point_admin.js", true, ""); ?>

<form action="./" method="get" onsubmit="return procFilter(this, insert_point_module_config);" id="fo_point">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->module_config['module_srl']?$__Context->module_config['module_srl']:$__Context->module_srls);?>" />

<h4 class="xeAdmin"><?php @print($__Context->lang->point);?></h4>
<table cellspacing="0" class="rowTable">
<tr>
    <th><div><?php @print($__Context->lang->point_insert_document);?></div></th>
    <td class="wide"><input type="text" name="insert_document" value="<?php @print($__Context->module_config['insert_document']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
    <th><div><?php @print($__Context->lang->point_insert_comment);?></div></th>
    <td><input type="text" name="insert_comment" value="<?php @print($__Context->module_config['insert_comment']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
    <th><div><?php @print($__Context->lang->point_upload_file);?></div></th>
    <td><input type="text" name="upload_file" value="<?php @print($__Context->module_config['upload_file']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
    <th><div><?php @print($__Context->lang->point_download_file);?></div></th>
    <td><input type="text" name="download_file" value="<?php @print($__Context->module_config['download_file']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
    <th><div><?php @print($__Context->lang->point_read_document);?></div></th>
    <td><input type="text" name="read_document" value="<?php @print($__Context->module_config['read_document']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
	<th><div><?php @print($__Context->lang->point_voted);?></div></th>
	<td><input type="text" name="voted" value="<?php @print($__Context->module_config['voted']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
	<th><div><?php @print($__Context->lang->point_blamed);?></div></th>
	<td><input type="text" name="blamed" value="<?php @print($__Context->module_config['blamed']);?>" class="inputTypeText w80" /> <?php @print($__Context->module_config['point_name']);?></td>
</tr>
<tr>
    <th colspan="2" class="button">
        <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>" /></span>
        <span class="button"><input type="button" value="<?php @print($__Context->lang->cmd_reset);?>" onclick="doPointReset('<?php @print($__Context->module_config['module_srl']?$__Context->module_config['module_srl']:$__Context->module_srls);?>'); return false"/></span>
    </th>
</tr>
</table>

<!-- 버튼 -->

</form>
<div class="gap1"></div>
