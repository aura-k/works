<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/integration_search//tpl/','header.html');
?>

<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/integration_search//tpl/filter/","insert_config.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/integration_search//tpl/../../widget/tpl/js/widget_admin.js--><?php Context::addJsFile("modules/integration_search//tpl/../../widget/tpl/js/widget_admin.js", true, ""); ?>

<form action="./" method="get" onsubmit="return procFilter(this, insert_config)">
    <input type="hidden" name="target_module_srl" id="target_module_srl" value="<?php @print($__Context->config->target_module_srl);?>" />
    <table cellspacing="0" class="rowTable">
    <tr class="row2">
        <th scope="row"><div><?php @print($__Context->lang->sample_code);?></div></th>
        <td class="wide">
            <textarea class="inputTypeTextArea fullWidth" readonly="readonly"><?php @print($__Context->sample_code);?></textarea>
            <p><?php @print($__Context->lang->about_sample_code);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin);?></div></th>
        <td>
            <select name="skin">
                <?php $Context->__idx[0]=0;if(count($__Context->skin_list))  foreach($__Context->skin_list as $__Context->key=>$__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                <option value="<?php @print($__Context->key);?>" <?php  if($__Context->config->skin==$__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                <?php  } ?>
            </select>
            <p><?php @print($__Context->lang->about_skin);?></p>
        </td>
    </tr>
    <tr class="row2">
        <th scope="row"><div><?php @print($__Context->lang->target);?></div></th>
        <td>
            <select name="target">
                <option value="include"><?php @print($__Context->lang->include_search_target);?></option>
                <option value="exclude" <?php  if($__Context->config->target=='exclude'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->exclude_search_target);?></option>
            </select>

            <select name="_target_module_srl" id="_target_module_srl" size="8" class="w200" style="display:block;margin:10px 0;"></select>

            <a href="<?php @print(getUrl('','module','module','act','dispModuleSelectList','id','target_module_srl'));?>" onclick="popopen(this.href, 'ModuleSelect');return false;" class="button blue"><span><?php @print($__Context->lang->cmd_insert);?></span></a>
            <a href="#" onclick="midRemove('target_module_srl');return false;" class="button red"><span><?php @print($__Context->lang->cmd_delete);?></span></a>

            <script type="text/javascript">
                jQuery( function() { getModuleSrlList('target_module_srl'); } );
            </script>
        </td>
    </tr>
    <tr class="row2">
        <th class="button" colspan="3">
            <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_registration);?>" accesskey="s" /></span>
        </th>
    </tr>
    </table>
</form>
