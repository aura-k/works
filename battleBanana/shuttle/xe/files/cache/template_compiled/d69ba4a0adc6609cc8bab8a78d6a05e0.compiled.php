<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/communication/tpl/js/communication_admin.js--><?php Context::addJsFile("modules/communication/tpl/js/communication_admin.js", true, ""); ?>
<!--Meta:modules/communication/tpl/../../editor/tpl/js/editor_module_config.js--><?php Context::addJsFile("modules/communication/tpl/../../editor/tpl/js/editor_module_config.js", false, ""); ?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/communication/tpl/filter/","insert_config.xml");
$oXmlFilter->compile();
?>


<h3 class="xeAdmin"><?php @print($__Context->lang->communication);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>

<div class="infoText"><?php @print(nl2br($__Context->lang->about_communication));?></div>

<form action="./" method="get" onsubmit="return procFilter(this, insert_config)">

    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->editor_skin);?></div></th>
        <td>
            <select name="editor_skin" onchange="getEditorSkinColorList(this.value)">
            <?php $Context->__idx[0]=0;if(count($__Context->editor_skin_list))  foreach($__Context->editor_skin_list as $__Context->editor_skin){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <option value="<?php @print($__Context->editor_skin);?>" <?php  if($__Context->editor_skin==$__Context->communication_config->editor_skin){ ?>selected="selected"<?php  } ?>><?php @print($__Context->editor_skin);?></option>
            <?php  } ?>
            </select>
            <select name="editor_colorset" id="sel_editor_colorset" style="display:none">
            </select>
            <script type="text/javascript">//<![CDATA[
                getEditorSkinColorList('<?php @print($__Context->communication_config->editor_skin);?>','<?php @print($__Context->communication_config->editor_colorset);?>');
            //]]></script>
        </td>
    </tr>

    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin);?></div></th>
        <td>
            <select name="skin" onchange="doGetSkinColorset(this.options[this.selectedIndex].value);return false;">
            <?php $Context->__idx[1]=0;if(count($__Context->communication_skin_list))  foreach($__Context->communication_skin_list as $__Context->key=>$__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
            <option value="<?php @print($__Context->key);?>" <?php  if($__Context->key==$__Context->communication_config->skin){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
            <?php  } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->colorset);?></div></th>
        <td><div id="communication_colorset"></div></td>
    </tr>

    <tr>
        <th colspan="2" class="button">
            <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_registration);?>" /></span>
        </th>
    </tr>
    </table>

</form>

<script type="text/javascript">
    jQuery(function() { doGetSkinColorset("<?php @print($__Context->communication_config->skin);?>"); });
</script>
