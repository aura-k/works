<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/board/tpl/js/board_admin.js--><?php Context::addJsFile("modules/board/tpl/js/board_admin.js", true, ""); ?>

<h3 class="xeAdmin"><?php @print($__Context->lang->board);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>

<div class="infoText"><?php @print(nl2br($__Context->lang->about_board));?></div>

<?php  if($__Context->module_info){ ?>
<div class="header4">
    <?php  if($__Context->module_info->mid){ ?>
    <h4 class="xeAdmin"><?php @print($__Context->module_info->mid);?> <?php  if($__Context->module_info->is_default=='Y'){ ?><span class="bracket">(<?php @print($__Context->lang->is_default);?>)</span><?php  } ?> <span class="vr">|</span> <a href="<?php @print(getSiteUrl($__Context->module_info->domain,'','mid',$__Context->module_info->mid));?>" onclick="window.open(this.href); return false;" class="view">View</a></h4>
    <?php  } ?>

    <ul class="localNavigation">
        <?php  if($__Context->module=='admin'){ ?>
        <li <?php  if($__Context->act=='dispBoardAdminContent'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminContent','module_srl',''));?>"><?php @print($__Context->lang->cmd_board_list);?></a></li>
        <?php  }else{ ?>
        <li><a href="<?php @print(getUrl('act',''));?>"><?php @print($__Context->lang->cmd_back);?></a></li>
        <?php  } ?>
        <li <?php  if($__Context->act=='dispBoardAdminBoardInfo'||$__Context->act=='dispBoardAdminInsertBoard'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminBoardInfo'));?>"><?php @print($__Context->lang->cmd_view_info);?></a></li>
        <li <?php  if($__Context->act=='dispBoardAdminCategoryInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminCategoryInfo'));?>"><?php @print($__Context->lang->cmd_manage_category);?></a></li>
        <li <?php  if($__Context->act=='dispBoardAdminExtraVars'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminExtraVars'));?>"><?php @print($__Context->lang->extra_vars);?></a></li>
        <li <?php  if($__Context->act=='dispBoardAdminListSetup'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminListSetup'));?>"><?php @print($__Context->lang->cmd_list_setting);?></a></li>
        <li <?php  if($__Context->act=='dispBoardAdminGrantInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminGrantInfo'));?>"><?php @print($__Context->lang->cmd_manage_grant);?></a></li>
        <li <?php  if($__Context->act=='dispBoardAdminBoardAdditionSetup'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminBoardAdditionSetup'));?>"><?php @print($__Context->lang->cmd_addition_setup);?></a></li>
        <li <?php  if($__Context->act=='dispBoardAdminSkinInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispBoardAdminSkinInfo'));?>"><?php @print($__Context->lang->cmd_manage_skin);?></a></li>
    </ul>
</div>
<?php  } ?>

