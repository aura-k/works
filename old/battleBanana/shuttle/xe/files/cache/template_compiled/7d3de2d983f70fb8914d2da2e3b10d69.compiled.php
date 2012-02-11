<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/file/tpl/filter/","insert_file_module_config.xml");
$oXmlFilter->compile();
?>

<form action="./" method="get" onsubmit="return procFilter(this, insert_file_module_config)">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->module_info->module_srl?$__Context->module_info->module_srl:$__Context->module_srls);?>" />

    <h4 class="xeAdmin"><?php @print($__Context->lang->file);?></h4>
    <table cellspacing="0" class="rowTable">
    <tr class="row2">
        <th scope="col"><div><?php @print($__Context->lang->allowed_filesize);?></div></th>
        <td>
            <input type="text" name="allowed_filesize" value="<?php @print($__Context->file_config->allowed_filesize);?>" class="inputTypeText" size="3" />MB
            <p><?php @print($__Context->lang->about_allowed_filesize);?></p>
        </td>
    </tr>
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->allowed_attach_size);?></div></th>
        <td>
            <input type="text" name="allowed_attach_size" value="<?php @print($__Context->file_config->allowed_attach_size);?>" class="inputTypeText" size="3" />MB
            / <?php @print(ini_get('upload_max_filesize'));?>
            <p><?php @print($__Context->lang->about_allowed_attach_size);?></p>
        </td>
    </tr>
    <tr class="row2">
        <th scope="col"><div><?php @print($__Context->lang->allowed_filetypes);?></div></th>
        <td>
            <input type="text" name="allowed_filetypes" value="<?php @print($__Context->file_config->allowed_filetypes);?>" class="inputTypeText w100" />
            <p><?php @print($__Context->lang->about_allowed_filetypes);?></p>
        </td>
    </tr>
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->enable_download_group);?></div></th>
        <td>
            <?php $Context->__idx[14]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[15]=($__Context->__idx[15]+1)%2; $__Context->cycle_idx = $__Context->__idx[15]+1; ?>
            <input type="checkbox" class="checkbox" name="download_grant" value="<?php @print($__Context->v->group_srl);?>" id="grant_<?php @print($__Context->key);?>_<?php @print($__Context->v->group_srl);?>" <?php  if(in_array($__Context->v->group_srl, $__Context->file_config->download_grant)){ ?>checked="checked"<?php  } ?>/> 
            <label for="grant_<?php @print($__Context->key);?>_<?php @print($__Context->v->group_srl);?>"><?php @print($__Context->v->title);?></label>
            &nbsp;
            <?php  } ?>
        </td>
    </tr>
    <tr class="row2">
        <th class="button" colspan="2">
            <span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>" /></span>
        </th>
    </tr>
    </table>

</form>
