<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/board/tpl/filter/","insert_board.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/board/tpl/js/board_admin.js--><?php Context::addJsFile("modules/board/tpl/js/board_admin.js", true, ""); ?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/tpl/','header.html');
?>


<form action="./" method="post" onsubmit="return procFilter(this, insert_board)" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php @print($__Context->page);?>" />
<input type="hidden" name="module_srl" value="<?php @print($__Context->module_info->module_srl);?>" />

    <table cellspacing="0" class="rowTable">

    <?php  if($__Context->logged_info->is_admin!='Y'){ ?>
    <input type="hidden" name="mid" value="<?php @print($__Context->module_info->mid);?>" />
    <?php  }else{ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->mid);?></div></th>
        <td>
            <input type="text" name="mid" value="<?php @print($__Context->module_info->mid);?>" class="inputTypeText w200" />
            <p><?php @print($__Context->lang->about_mid);?></p>
        </td>
    </tr>
    <?php  } ?>
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
        <th scope="row"><div><?php @print($__Context->lang->browser_title);?></div></th>
        <td>
            <input type="text" name="browser_title" value="<?php @print(htmlspecialchars($__Context->module_info->browser_title));?>"  class="inputTypeText w400" id="browser_title"/>
            <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','browser_title'));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a>
            <p><?php @print($__Context->lang->about_browser_title);?></p>
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
	<tr>
		<th scope="row"><div><?php @print($__Context->lang->mobile_view);?></div></th>
		<td>
			<input type="checkbox" name="use_mobile" value="Y" <?php  if($__Context->module_info->use_mobile == "Y"){ ?>checked="checked"<?php  } ?> />
			<p><?php @print($__Context->lang->about_mobile_view);?></p>
		</td>
	</tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->mobile_layout);?></div></th>
        <td>
            <select name="mlayout_srl">
            <option value="0"><?php @print($__Context->lang->notuse);?></option>
            <?php $Context->__idx[3]=0;if(count($__Context->mlayout_list))  foreach($__Context->mlayout_list as $__Context->key => $__Context->val){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
            <option value="<?php @print($__Context->val->layout_srl);?>" <?php  if($__Context->module_info->mlayout_srl==$__Context->val->layout_srl){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?> (<?php @print($__Context->val->layout);?>)</option>
            <?php  } ?>
            </select>
            <p><?php @print($__Context->lang->about_layout);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin);?></div></th>
        <td>
            <select name="mskin">
                <?php $Context->__idx[4]=0;if(count($__Context->mskin_list))  foreach($__Context->mskin_list as $__Context->key=>$__Context->val){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
                <option value="<?php @print($__Context->key);?>" <?php  if($__Context->module_info->mskin==$__Context->key ||(!$__Context->module_info->mskin && $__Context->key=='default')){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                <?php  } ?>
            </select>
            <p><?php @print($__Context->lang->about_skin);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->use_category);?></div></th>
        <td>
            <input type="checkbox" name="use_category" value="Y" <?php  if($__Context->module_info->use_category=='Y'){ ?>checked="checked"<?php  } ?>  class="checkbox" id="fld_for_category" />
            <label for="fld_for_category"><?php @print($__Context->lang->about_use_category);?></label>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->order_target);?></div></th>
        <td>
            <select name="order_target">
                <?php $Context->__idx[5]=0;if(count($__Context->order_target))  foreach($__Context->order_target as $__Context->key => $__Context->val){$__Context->__idx[6]=($__Context->__idx[6]+1)%2; $__Context->cycle_idx = $__Context->__idx[6]+1; ?>
                <option value="<?php @print($__Context->key);?>" <?php  if($__Context->module_info->order_target == $__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val);?></option>
                <?php  } ?>
            </select>

        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->order_type);?></div></th>
        <td>
            <select name="order_type">
                <option value="asc" <?php  if($__Context->module_info->order_type != 'desc'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->order_asc);?></option>
                <option value="desc" <?php  if($__Context->module_info->order_type == 'desc'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->order_desc);?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->list_count);?></div></th>
        <td>
            <input type="text" name="list_count" value="<?php @print($__Context->module_info->list_count?$__Context->module_info->list_count:20);?>"  class="inputTypeText" />
            <p><?php @print($__Context->lang->about_list_count);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->search_list_count);?></div></th>
        <td>
            <input type="text" name="search_list_count" value="<?php @print($__Context->module_info->search_list_count?$__Context->module_info->search_list_count:20);?>"  class="inputTypeText" />
            <p><?php @print($__Context->lang->about_search_list_count);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->page_count);?></div></th>
        <td>
            <input type="text" name="page_count" value="<?php @print($__Context->module_info->page_count?$__Context->module_info->page_count:10);?>"  class="inputTypeText" />
            <p><?php @print($__Context->lang->about_page_count);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->except_notice);?></div></th>
        <td>
            <input type="checkbox" name="except_notice" value="Y" <?php  if($__Context->module_info->except_notice!='N'){ ?>checked="checked"<?php  } ?> />
            <p><?php @print($__Context->lang->about_except_notice);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->use_anonymous);?></div></th>
        <td>
            <input type="checkbox" name="use_anonymous" value="Y" <?php  if($__Context->module_info->use_anonymous=='Y'){ ?>checked="checked"<?php  } ?> />
            <p><?php @print($__Context->lang->about_use_anonymous);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->consultation);?></div></th>
        <td>
            <input type="checkbox" name="consultation" value="Y" <?php  if($__Context->module_info->consultation=='Y'){ ?>checked="checked"<?php  } ?> />
            <p><?php @print(nl2br($__Context->lang->about_consultation));?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->secret);?></div></th>
        <td>
            <input type="checkbox" name="secret" value="Y" <?php  if($__Context->module_info->secret=='Y'){ ?>checked="checked"<?php  } ?> />
            <p><?php @print(nl2br($__Context->lang->about_secret));?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->admin_mail);?></div></th>
        <td>
            <input type="text" name="admin_mail" value="<?php @print($__Context->module_info->admin_mail);?>"  class="inputTypeText w400" />
            <p><?php @print($__Context->lang->about_admin_mail);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->description);?></div></th>
        <td>
            <textarea name="description" class="inputTypeTextArea fullWidth"><?php @print(htmlspecialchars($__Context->module_info->description));?></textarea>
            <p><?php @print($__Context->lang->about_description);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->header_text);?></div></th>
        <td>
            <textarea name="header_text" class="inputTypeTextArea fullWidth" id="header_text"><?php @print(htmlspecialchars($__Context->module_info->header_text));?></textarea>
            <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','header_text'));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a>
            <p><?php @print($__Context->lang->about_header_text);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->footer_text);?></div></th>
        <td>
            <textarea name="footer_text" class="inputTypeTextArea fullWidth" id="footer_text"><?php @print(htmlspecialchars($__Context->module_info->footer_text));?></textarea>
            <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','footer_text'));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a>
            <p><?php @print($__Context->lang->about_footer_text);?></p>
        </td>
    </tr>
    <tr>
        <th colspan="2" class="button">
            <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_registration);?>" accesskey="s" /></span>
            <span class="button"><input type="button" value="<?php @print($__Context->lang->cmd_back);?>" onclick="history.back(); return false;" /></span>
        </th>
	</tr>
    </table>

</form>
