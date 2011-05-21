<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/layout/tpl/filter/","insert_layout.xml");
$oXmlFilter->compile();
?>


<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/layout/tpl/','header.html');
?>


<form action="./" method="get" onsubmit="return procFilter(this, insert_layout)">
	<input type="hidden" name="layout_type" value="<?php @print($__Context->layout_type);?>" />

    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->layout_name);?></div></th>
        <td>
            <select name="layout">
                <option value="faceoff">faceoff</option>

                <optgroup label="<?php @print($__Context->lang->downloaded_list);?>">
                <?php $Context->__idx[0]=0;if(count($__Context->layout_list))  foreach($__Context->layout_list as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                <option value="<?php @print($__Context->val->layout);?>" <?php  if($__Context->layout == $__Context->val->layout){ ?>selected="selected"<?php  } ?>> <?php  if($__Context->val->title){ ?><?php @print($__Context->val->title);?> (<?php @print($__Context->val->layout);?>)<?php  }else{ ?><?php @print($__Context->val->layout);?><?php  } ?></option>
                <?php  } ?>
                </optgroup>

            </select>
        </td>
    </tr>
    <tr class="row2">
        <th scope="row"><div><?php @print($__Context->lang->title);?></div></th>
        <td>
            <input type="text" name="title" value="<?php @print($__Context->info->title);?>" class="inputTypeText w400" />
            <p><?php @print($__Context->lang->about_title);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row" colspan="2" class="button">
            <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_next);?>" accesskey="s" /></span>
        </th>
    </tr>
    </table>

</form>
