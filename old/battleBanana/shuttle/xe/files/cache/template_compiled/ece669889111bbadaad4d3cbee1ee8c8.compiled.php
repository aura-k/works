<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","insert_document_module_config.xml");
$oXmlFilter->compile();
?>


<form action="./" method="post" onsubmit="return procFilter(this, insert_document_module_config)">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->module_info->module_srl?$__Context->module_info->module_srl:$__Context->module_srls);?>" />

    <h4 class="xeAdmin"><?php @print($__Context->lang->document);?></h4>
    <p class="summary"><?php @print($__Context->lang->about_use_history);?></p>
    <table cellspacing="0" class="rowTable">
    <tr>    
        <th><div><?php @print($__Context->lang->history);?></div></th>
        <td class="wide">
            <select name="use_history" class="w100">
                <option value="N" <?php  if($__Context->document_config->use_history=='N'){ ?>selected<?php  } ?>><?php @print($__Context->lang->notuse);?></option>
                <option value="Y" <?php  if($__Context->document_config->use_history=='Y'){ ?>selected<?php  } ?>><?php @print($__Context->lang->use);?></option>
                <option value="Trace" <?php  if($__Context->document_config->use_history=='Trace'){ ?>selected<?php  } ?>><?php @print($__Context->lang->trace_only);?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th class="button" colspan="2">
            <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>"/></span>
        </th>
    </tr>
    </table>

</form>
