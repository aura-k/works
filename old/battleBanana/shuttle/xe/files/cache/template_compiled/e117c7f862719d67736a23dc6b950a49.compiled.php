<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/document/tpl/js/document_admin.js--><?php Context::addJsFile("modules/document/tpl/js/document_admin.js", true, ""); ?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","insert_extra_var.xml");
$oXmlFilter->compile();
?>

<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","delete_extra_var.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/document/tpl/js/module_admin.js--><?php Context::addJsFile("modules/document/tpl/js/module_admin.js", true, ""); ?>

<?php  if($__Context->selected_var_idx && $__Context->extra_keys[$__Context->selected_var_idx]){ ?>
    <?php @$__Context->selected_var = $__Context->extra_keys[$__Context->selected_var_idx];?>
<?php  } ?>

<?php  if($__Context->type == 'insertExtraForm' || $__Context->selected_var_idx){ ?>
    <form action="./" method="post" onsubmit="return procFilter(this, insert_extra_var)">
    <input type="hidden" name="module_srl" value="<?php @print($__Context->module_srl);?>" />
    <input type="hidden" name="var_idx" value="<?php @print($__Context->selected_var_idx);?>" />

        <h4 class="xeAdmin"><?php @print($__Context->lang->extra_vars);?> <?php @print($__Context->selected_var_idx);?></h4>
        <table cellspacing="0" class="crossTable ">
        <tr>
            <th><div><?php @print($__Context->lang->eid);?></div></th>
            <td class="wide">
                <input type="text" name="eid" value="<?php @print($__Context->selected_var->eid);?>" class="inputTypeText w200" id="eid" /><p><?php @print($__Context->lang->about_extra_vars_eid_value);?></p>
            </td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->column_name);?></div></th>
            <td class="wide">
                <input type="text" name="name" value="<?php @print(htmlspecialchars($__Context->selected_var->name));?>" class="inputTypeText w200" id="name" /><a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','name'));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a> 
            </td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->column_type);?></div></th>
            <td>
                <select name="type">
                    <?php $Context->__idx[0]=0;if(count($__Context->lang->column_type_list))  foreach($__Context->lang->column_type_list as $__Context->k => $__Context->v){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                        <?php  if($__Context->key != 'kr_zip'){ ?>
                        <option value="<?php @print($__Context->k);?>" <?php  if($__Context->selected_var->type==$__Context->k){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->column_type_list[$__Context->k]);?></option>
                        <?php  } ?>
                    <?php  } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->is_required);?></div></th>
            <td><input type="checkbox" name="is_required" value="Y" <?php  if($__Context->selected_var->is_required=='Y'){ ?>checked="checked"<?php  } ?> /></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->default_value);?></div></th>
            <td><input type="text" name="default" value="<?php @print($__Context->selected_var->default);?>" class="inputTypeText w400" /><p><?php @print($__Context->lang->about_extra_vars_default_value);?></p></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->description);?></div></th>
            <td><input type="text" name="desc" value="<?php @print($__Context->selected_var->desc);?>" id="desc" class="inputTypeText w400" /><a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','desc'));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->cmd_search);?></div></th>
            <td><input type="checkbox" name="search" value="Y" <?php  if($__Context->selected_var->search=='Y'){ ?>checked="checked"<?php  } ?> /></td>
        </tr>
        <tr>
            <th colspan="2" class="button">
                <?php  if($__Context->selected_var){ ?>
                <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_modify);?>" accesskey="s" /></span>
                <?php  }else{ ?>
                <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_insert);?>" accesskey="s" /></span>
                <?php  } ?>
                <a href="<?php @print(getUrl('type','','selected_var_idx',''));?>"  class="button"><span><?php @print($__Context->lang->cmd_back);?></span></a>
            </th>
        </tr>
        </table>

    </form>
<?php  }else{ ?>

    <h4 class="xeAdmin"><?php @print($__Context->lang->extra_vars);?></h4>
    <table cellspacing="0" class="crossTable ">
    <thead>
    <tr>
        <th><div><?php @print($__Context->lang->no);?></div></th>
        <th><div><?php @print($__Context->lang->eid);?></div></th>
        <th><div><?php @print($__Context->lang->column_name);?></div></th>
        <th><div><?php @print($__Context->lang->column_type);?></div></th>
        <th><div><?php @print($__Context->lang->is_required);?></div></th>
        <th><div><?php @print($__Context->lang->cmd_search);?></div></th>
        <th><div>&nbsp;</div></th>
    </tr>
    </thead>
    <tbody>
    <?php $Context->__idx[1]=0;if(count($__Context->extra_keys))  foreach($__Context->extra_keys as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <tr>
        <td rowspan="3"><?php @print($__Context->val->idx);?></td>
        <td rowspan="3"><?php @print($__Context->val->eid);?></td>
        <td class="nowrap"><b><?php @print($__Context->val->name);?></b></td>
        <td class="nowrap"><?php @print($__Context->lang->column_type_list[$__Context->val->type]);?></td>
        <td rowspan="3"><?php  if($__Context->val->is_required=='Y'){ ?><b><?php @print($__Context->lang->is_required);?></b><?php  }else{ ?>N<?php  } ?></td>
        <td rowspan="3"><?php  if($__Context->val->search=='Y'){ ?><b><?php @print($__Context->lang->search_target);?></b><?php  }else{ ?>N<?php  } ?></td>
        <td rowspan="3" class="nowrap">
            <?php  if($__Context->val->idx>1){ ?><a href="#" onclick="moveVar('up','<?php @print($__Context->module_srl);?>','<?php @print($__Context->val->idx);?>'); return false;" class="buttonSet buttonUp"><span><?php @print($__Context->lang->cmd_modify);?></span></a><?php  } ?>
            <a href="#" onclick="moveVar('down','<?php @print($__Context->module_srl);?>','<?php @print($__Context->val->idx);?>');return false;" class="buttonSet buttonDown"><span><?php @print($__Context->lang->cmd_modify);?></a></span>
            <a href="<?php @print(getUrl('selected_var_idx',$__Context->val->idx));?>" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_modify);?></span></a>
            <a href="#" onclick="return doDeleteExtraKey('<?php @print($__Context->module_srl);?>','<?php @print($__Context->val->idx);?>');" class="buttonSet buttonDelete"><span><?php @print($__Context->lang->cmd_delete);?></span></a>
        </td>
    </tr>
    <tr>
        <td><?php @print($__Context->lang->default_value);?></td>
        <td class="wide"><?php @print($__Context->val->default);?>&nbsp;</td>
    </tr>
    <tr>
        <td><?php @print($__Context->lang->description);?></td>
        <td class="wide"><?php @print($__Context->val->desc);?>&nbsp;</td>
    </tr>
    <?php  } ?>
    <tr>
        <th colspan="9" class="button">
            <a href="<?php @print(getUrl('type','insertExtraForm','selected_var_idx',''));?>" class="button black strong"><span><?php @print($__Context->lang->cmd_insert);?></span></a>
        </th>
    </tr>
    </tbody>
    </table>
<?php  } ?>

<form id="fo_delete" name="fo_delete" method="post" action="./">
<input type="hidden" name="module_srl" value="" />
<input type="hidden" name="var_idx" value="" />
<form>
