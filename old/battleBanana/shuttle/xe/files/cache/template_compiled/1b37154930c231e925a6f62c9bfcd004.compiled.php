<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/member/skins/default/js/member.js--><?php Context::addJsFile("modules/member/skins/default/js/member.js", true, ""); ?>
<!--Meta:modules/member/skins/default/css/default.css--><?php Context::addCSSFile("modules/member/skins/default/css/default.css", true, "all", ""); ?>

<div id="memberModule">

    <?php  if($__Context->is_logged && $__Context->logged_info->menu_list && (!$__Context->member_srl || $__Context->member_srl == $__Context->logged_info->member_srl) ){ ?>
    <ul class="localNavigation">
        <?php $Context->__idx[3]=0;if(count($__Context->logged_info->menu_list))  foreach($__Context->logged_info->menu_list as $__Context->key => $__Context->val){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
        <li <?php  if($__Context->key == $__Context->act){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act',$__Context->key));?>"><?php @print(Context::getLang($__Context->val));?></a></li>
        <?php  } ?>
    </ul>
    <?php  } ?>
