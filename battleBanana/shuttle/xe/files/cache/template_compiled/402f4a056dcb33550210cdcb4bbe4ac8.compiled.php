<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/trackback/tpl/filter/","insert_trackback_module_config.xml");
$oXmlFilter->compile();
?>


<form action="./" method="post" onsubmit="return procFilter(this, insert_trackback_module_config)">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->trackback_config->module_srl?$__Context->trackback_config->module_srl:$__Context->module_srls);?>" />

    <h4 class="xeAdmin"><?php @print($__Context->lang->trackback);?></h4> 
    <table cellspacing="0" class="rowTable">
    <tr>
        <th><div><?php @print($__Context->lang->enable_trackback);?></div></th>
        <td class="wide"><input type="checkbox" name="enable_trackback" value="Y" <?php  if($__Context->trackback_config->enable_trackback == "Y"){ ?>checked="checked"<?php  } ?> /></td>
    </tr>
    <tr class="row2">
        <th class="button" colspan="2"><span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>"/></span></th>
    </tr>
    </table>
</form>
