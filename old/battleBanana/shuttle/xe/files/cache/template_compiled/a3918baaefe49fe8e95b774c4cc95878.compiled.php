<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/module/tpl/./filter/","insert_module_setup.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/module/tpl/./js/module_admin.js--><?php Context::addJsFile("modules/module/tpl/./js/module_admin.js", true, ""); ?>

<div id="popHeader" class="wide">
    <h3 class="xeAdmin"><?php @print($__Context->lang->bundle_setup);?></h3>
</div>

<form action="./" method="post" onsubmit="return procFilter(this, insert_module_setup)" enctype="multipart/form-data">
<input type="hidden" name="module_srls" value="<?php @print($__Context->module_srls);?>" />
<div id="popBody">

    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->module_category);?></div></th>
        <td>
            <select name="module_category_srl">
                <option value="0"><?php @print($__Context->lang->notuse);?></option>
                <?php $Context->__idx[0]=0;if(count($__Context->module_category))  foreach($__Context->module_category as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                <option value="<?php @print($__Context->key);?>" <?php  if($__Context->module_info->module_category_srl==$__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                <?php  } ?>
            </select>
            <p><?php @print($__Context->lang->about_module_category);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->layout);?></div></th>
        <td>
            <select name="layout_srl">
            <option value="0"><?php @print($__Context->lang->notuse);?></option>
            <?php $Context->__idx[1]=0;if(count($__Context->layout_list))  foreach($__Context->layout_list as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
            <option value="<?php @print($__Context->val->layout_srl);?>" <?php  if($__Context->module_info->layout_srl==$__Context->val->layout_srl){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?> (<?php @print($__Context->val->layout);?>)</option>
            <?php  } ?>
            </select>
            <p><?php @print($__Context->lang->about_layout);?></p>
        </td>
    </tr>
    <?php  if(count($__Context->skin_list)){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin);?></div></th>
        <td>
            <select name="skin">
                <?php $Context->__idx[2]=0;if(count($__Context->skin_list))  foreach($__Context->skin_list as $__Context->key=>$__Context->val){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
                <option value="<?php @print($__Context->key);?>" <?php  if($__Context->module_info->skin==$__Context->key ||(!$__Context->module_info->skin && $__Context->key=='xe_board')){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                <?php  } ?>
            </select>
            <p><?php @print($__Context->lang->about_skin);?></p>
        </td>
    </tr>
    <?php  } ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->description);?></div></th>
        <td>
            <textarea name="description" class="inputTypeTextArea fixWidth"><?php @print(htmlspecialchars($__Context->module_info->description));?></textarea>
            <p><?php @print($__Context->lang->about_description);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->header_text);?></div></th>
        <td>
            <textarea name="header_text" class="inputTypeTextArea fixWidth"><?php @print(htmlspecialchars($__Context->module_info->header_text));?></textarea>
            <p><?php @print($__Context->lang->about_header_text);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->footer_text);?></div></th>
        <td>
            <textarea name="footer_text" class="inputTypeTextArea fixWidth"><?php @print(htmlspecialchars($__Context->module_info->footer_text));?></textarea>
            <p><?php @print($__Context->lang->about_footer_text);?></p>
        </td>
    </tr>
    </table>
</div>

<div id="popFooter" class="tCenter gap1">
    <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_registration);?>" /></span>
</div>

</form>
