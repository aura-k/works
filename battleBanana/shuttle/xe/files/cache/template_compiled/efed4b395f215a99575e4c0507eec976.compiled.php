<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/tpl/','header.html');
?>

<!--Meta:modules/board/tpl/css/board.css--><?php Context::addCSSFile("modules/board/tpl/css/board.css", true, "all", ""); ?>

<h4 class="xeAdmin"><?php @print($__Context->lang->cmd_list_setting);?></h4>
<p class="summary"><?php @print($__Context->lang->about_list_config);?></p>

<div class="targetItem">
    <strong><?php @print($__Context->lang->list_target_item);?></strong>
    <select size="<?php @print(count($__Context->extra_vars));?>" name="targetItem" id="targetItem" ondblclick="doInsertItem(); return false;">
    <?php $Context->__idx[0]=0;if(count($__Context->extra_vars))  foreach($__Context->extra_vars as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
    <option value="<?php @print($__Context->key);?>"><?php @print($__Context->val->name);?></option>
    <?php  } ?>
    </select>
</div>

<div class="displayButton">
    <a href="#" onclick="doInsertItem(); return false;" class="buttonSet buttonRight"><span><?php @print($__Context->lang->cmd_insert);?></span></a><br />
    <a href="#" onclick="doDeleteItem(); return false;" class="buttonSet buttonLeft"><span><?php @print($__Context->lang->cmd_delete);?></span></a><br />
    <a href="#" onclick="doMoveUpItem(); return false;" class="buttonSet buttonUp"><span><?php @print($__Context->lang->cmd_move_up);?></span></a><br />
    <a href="#" onclick="doMoveDownItem(); return false;" class="buttonSet buttonDown"><span><?php @print($__Context->lang->cmd_move_down);?></span></a>
</div>

<div class="displayItem">
    <strong><?php @print($__Context->lang->list_display_item);?></strong>
    <select size="<?php @print(count($__Context->extra_vars));?>" name="displayItem" id="displayItem" ondblclick="doDeleteItem();">
    <?php $Context->__idx[1]=0;if(count($__Context->list_config))  foreach($__Context->list_config as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <option value="<?php @print($__Context->key);?>"><?php @print($__Context->val->name);?></option>
    <?php  } ?>
    </select>

    <div class="gap1">
        <span class="button black strong"><button onclick="doSaveListConfig('<?php @print($__Context->module_srl);?>'); return false;" type="button"><?php @print($__Context->lang->cmd_save);?></button></span>
    </div>
</div>
