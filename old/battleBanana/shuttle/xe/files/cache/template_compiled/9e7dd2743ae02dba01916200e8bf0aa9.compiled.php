<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/module/tpl/./js/module_admin.js--><?php Context::addJsFile("modules/module/tpl/./js/module_admin.js", true, ""); ?>
<!--Meta:modules/module/tpl/../../common/css/popup.css--><?php Context::addCSSFile("modules/module/tpl/../../common/css/popup.css", true, "all", ""); ?>

<div id="popHeader">
    <h3 class="xeAdmin"><?php @print($__Context->lang->module_selector);?></h3>
</div>

<div id="popBody">
    <form action="./" method="post">
        <input type="hidden" name="module" value="module" />
        <input type="hidden" name="act" value="dispModuleSelectList" />
        <input type="hidden" name="id" value="<?php @print($__Context->id);?>" />
        <input type="hidden" name="type" value="<?php @print($__Context->type);?>" />
        <input type="hidden" name="vid" value="<?php @print($__Context->vid);?>" />
        <table class="rowTable" cellspacing="0">
        <tbody>
            <?php  if($__Context->site_count && $__Context->logged_info->is_admin == 'Y'){ ?>
            <tr>
                <th><div><?php @print($__Context->lang->virtual_site);?></div></th>
                <td>
                    <input type="text" name="site_keyword" value="<?php @print($__Context->site_keyword);?>" class="inputTypeText w200" /> <span class="button blue"><input type="submit" value="<?php @print($__Context->lang->cmd_search);?>" /></span>
                    <p><?php @print($__Context->lang->about_search_virtual_site);?></p>
                </td>
            </tr>
            <?php  } ?>
            <tr>
                <th><div><?php @print($__Context->lang->module);?></div></th>
                <td>
                    <select name="selected_module">
                    <?php $Context->__idx[0]=0;if(count($__Context->mid_list))  foreach($__Context->mid_list as $__Context->key=>$__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                        <option value="<?php @print($__Context->key);?>" <?php  if($__Context->selected_module == $__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                    <?php  } ?>
                    </select><span class="button blue"><input type="submit" value="<?php @print($__Context->lang->cmd_search);?>" /></span>
                </td>
            </tr>
        </tbody>
        </table>
        <table class="rowTable" cellspacing="0">
        <thead>
            <tr>
                <?php  if($__Context->module_category_exists){ ?><th><div><?php @print($__Context->lang->module_category);?></div></th><?php  } ?>
                <th><div><?php @print($__Context->lang->mid);?></div></th>
                <th class="wide"><div><?php @print($__Context->lang->browser_title);?></div></th>
                <th><div><?php @print($__Context->type=='single'?$__Context->lang->cmd_select:$__Context->lang->cmd_insert);?></div></th>
            <tr>
        </thead>
        <tbody>
            <?php  if($__Context->module_category_exists){ ?>
                <?php $Context->__idx[1]=0;if(count($__Context->selected_mids))  foreach($__Context->selected_mids as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
                <tr>
                    <td rowspan="<?php @print(count($__Context->val));?>"><?php @print($__Context->key);?>&nbsp;</td>
                    <?php @$__Context->_idx =0;;?>
                    <?php $Context->__idx[2]=0;if(count($__Context->val))  foreach($__Context->val as $__Context->k => $__Context->v){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
                    <?php  if($__Context->_idx >0){ ?><tr><?php  } ?>
					<?php @$__Context->browser_title = str_replace("'", "\\'", htmlspecialchars($__Context->v->browser_title));;?>
                    <td><?php @print($__Context->k);?></td>
                    <td><?php @print($__Context->v->browser_title);?></td>
                    <td><a href="#" onclick="insertModule('<?php @print($__Context->id);?>', <?php @print($__Context->v->module_srl);?>, '<?php @print($__Context->k);?>', '<?php @print($__Context->browser_title);?>',<?php @print($__Context->type=='single'?'false':'true');?>); return false;" class="button green"><span><?php @print($__Context->type=='single'?$__Context->lang->cmd_select:$__Context->lang->cmd_insert);?></span></a></td>
                    <?php  if($__Context->_idx <count($__Context->val)){ ?></tr><?php  } ?>
                    <?php @$__Context->_idx ++;;?>
                    <?php  } ?>
                </tr>
                <?php  } ?>
            <?php  }else{ ?>
                <?php $Context->__idx[3]=0;if(count($__Context->selected_mids))  foreach($__Context->selected_mids as $__Context->key => $__Context->val){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
                <?php $Context->__idx[4]=0;if(count($__Context->val))  foreach($__Context->val as $__Context->k => $__Context->v){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
                <tr>
                    <td><?php @print($__Context->k);?></td>
                    <td><?php @print($__Context->v->browser_title);?></td>
                    <td><a href="#" onclick="insertModule('<?php @print($__Context->id);?>', <?php @print($__Context->v->module_srl);?>, '<?php @print($__Context->k);?>', '<?php @print(str_replace("'","\\'",$__Context->v->browser_title));?>',<?php @print($__Context->type=='single'?'false':'true');?>); return false;" class="button green"><span><?php @print($__Context->type=='single'?$__Context->lang->cmd_select:$__Context->lang->cmd_insert);?></span></a></td>
                </tr>
                <?php  } ?>
                <?php  } ?>
            <?php  } ?>
        </tbody>
        </table>
    </form>
</div>