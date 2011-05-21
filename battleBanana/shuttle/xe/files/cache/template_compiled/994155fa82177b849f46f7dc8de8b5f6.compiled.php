<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/module/tpl/filter/","insert_grant.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/module/tpl/js/module_admin.js--><?php Context::addJsFile("modules/module/tpl/js/module_admin.js", true, ""); ?>

<script type="text/javascript">
    jQuery( function() { jQuery('.grant_default').change( function(event) { doShowGrantZone(); } ); doShowGrantZone() } );
</script>

<form action="./" method="post" onsubmit="return procFilter(this, insert_grant)" id="fo_obj">
<input type="hidden" name="module_srl" value="<?php @print($__Context->module_srl);?>" />
<input type="hidden" name="admin_member" value="<?php $Context->__idx[0]=0;if(count($__Context->admin_member))  foreach($__Context->admin_member as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?><?php @print($__Context->val->user_id);?>,<?php  } ?>" />

<h4 class="xeAdmin"><?php @print($__Context->lang->about_admin_id);?></h4>
<table cellspacing="0" class="rowTable">
<tr>
    <th scope="row" rowspan="2"><div><?php @print($__Context->lang->admin_id);?></div></th>
    <td class="wide">
        <select name="_admin_member" multiple="multiple" size="<?php @print(count($__Context->admin_member)?count($__Context->admin_member):1);?>" class="w200">
        <?php $Context->__idx[1]=0;if(count($__Context->admin_member))  foreach($__Context->admin_member as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
            <option value="<?php @print($__Context->val->user_id);?>"><?php @print($__Context->val->nick_name);?> (<?php @print($__Context->val->user_id);?>)</option>
        <?php  } ?>
        </select>
    </td>
</tr>
<tr>
    <th class="wide">
        <input type="text" name="admin_id" class="inputTypeText w100" />
        <span class="button black strong"><button type="button" onclick="doInsertAdmin()"><?php @print($__Context->lang->cmd_insert);?></button></span>
        <span class="button"><button type="button" onclick="doDeleteAdmin()"><?php @print($__Context->lang->cmd_delete);?></button></span>
    </th>
</tr>
</table>

<h4 class="xeAdmin"><?php @print($__Context->lang->about_grant);?></h4>
<p class="summary"><?php @print($__Context->lang->about_grant_deatil);?></p>
<table cellspacing="0" class="crossTable">
<thead>
<tr>
    <th scope="col"><div><?php @print($__Context->lang->grant);?></div></th>
    <th scope="col" colspan="3"><div><?php @print($__Context->lang->target);?></div></th>
</tr>
</thead>
<tbody>
    <?php $Context->__idx[2]=0;if(count($__Context->grant_list))  foreach($__Context->grant_list as $__Context->grant_name => $__Context->grant_item){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
    <tr class="row<?php @print($__Context->cycle_idx);?>">
        <th scope="row"><div><?php @print($__Context->grant_item->title);?></div></th>
        <td class="wide">
            <select name="<?php @print($__Context->grant_name);?>_default" class="grant_default">
                <?php  if($__Context->grant_item->default == 'guest'){ ?><option value="0" <?php  if($__Context->default_grant[$__Context->grant_name]=='all'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->grant_to_all);?></option><?php  } ?>
                <?php  if($__Context->grant_item->default != 'manager'){ ?><option value="-1" <?php  if($__Context->default_grant[$__Context->grant_name]=='member'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->grant_to_login_user);?></option><?php  } ?>
                <?php  if($__Context->grant_item->default != 'manager'){ ?><option value="-2" <?php  if($__Context->default_grant[$__Context->grant_name]=='site'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->grant_to_site_user);?></option><?php  } ?>
                <option value="" <?php  if($__Context->default_grant[$__Context->grant_name]=='group'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->grant_to_group);?></option>
            </select>

            <div id="zone_<?php @print($__Context->grant_name);?>" style="display:none">
                <?php $Context->__idx[3]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->group_srl => $__Context->group_item){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
                <input type="checkbox" class="checkbox" name="<?php @print($__Context->grant_name);?>" value="<?php @print($__Context->group_item->group_srl);?>" id="grant_<?php @print($__Context->grant_name);?>_<?php @print($__Context->group_srl);?>" <?php  if(is_array($__Context->selected_group[$__Context->grant_name])&&in_array($__Context->group_srl,$__Context->selected_group[$__Context->grant_name])){ ?>checked="checked"<?php  } ?>/> 
                <label for="grant_<?php @print($__Context->grant_name);?>_<?php @print($__Context->group_srl);?>"><?php @print($__Context->group_item->title);?></label>
                <?php  } ?>
            </div>

        </td>
    </tr>
    <?php  } ?>
    <tr>
        <th class="button" colspan="2">
            <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>" accesskey="s" /></span>
            <span class="button"><input type="button" value="<?php @print($__Context->lang->cmd_back);?>" onclick="history.back(); return false;" /></span>
        </th>
    </tr>
</tbody>
</table>

</form>
