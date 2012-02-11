<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/comment/tpl/filter/","insert_comment_module_config.xml");
$oXmlFilter->compile();
?>


<form action="./" method="post" onsubmit="return procFilter(this, insert_comment_module_config)">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->module_info->module_srl?$__Context->module_info->module_srl:$__Context->module_srls);?>" />

    <h4 class="xeAdmin"><?php @print($__Context->lang->comment);?></h4>
    <p class="summary"><?php @print($__Context->lang->about_comment_count);?></p>
    <table cellspacing="0" class="rowTable">
    <tr>    
        <th><div><?php @print($__Context->lang->comment_count);?></div></th>
        <td class="wide">
            <input type="text" name="comment_count" value="<?php @print($__Context->comment_config->comment_count);?>" class="inputTypeText w80" />
        </td>
    </tr>
    <tr>
        <th colspan="2" class="button">
            <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>"/></span>
        </th>
    </tr>
    </table>

</form>
