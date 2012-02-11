<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/page/tpl/js/page_admin.js--><?php Context::addJsFile("modules/page/tpl/js/page_admin.js", true, ""); ?>
<h3 class="xeAdmin"><?php @print($__Context->lang->page);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>

<div class="infoText"><?php @print(nl2br($__Context->lang->about_page));?></div>

<?php  if($__Context->module_info){ ?>
<div class="header4">
    <?php  if($__Context->module_info->mid){ ?>
    <h4 class="xeAdmin"><?php @print($__Context->module_info->mid);?> <?php  if($__Context->module_info->is_default=='Y'){ ?><span class="bracket">(<?php @print($__Context->lang->is_default);?>)</span><?php  } ?> <span class="vr">|</span> <a href="<?php @print(getSiteUrl($__Context->module_info->domain,'','mid',$__Context->module_info->mid));?>" onclick="window.open(this.href); return false;" class="view">View</a></h4>
    <?php  } ?>

    <ul class="localNavigation">
        <?php  if($__Context->module=='admin'){ ?>
        <li><a href="<?php @print(getUrl('act','dispPageAdminContent','module_srl',''));?>"><?php @print($__Context->lang->cmd_list);?></a></li>
        <?php  }else{ ?>
        <li><a href="<?php @print(getUrl('act',''));?>"><?php @print($__Context->lang->cmd_back);?></a></li>
        <?php  } ?>
        <li <?php  if($__Context->act=='dispPageAdminInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispPageAdminInfo'));?>"><?php @print($__Context->lang->module_info);?></a></li>
        <li <?php  if($__Context->act=='dispPageAdminPageAdditionSetup'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispPageAdminPageAdditionSetup'));?>"><?php @print($__Context->lang->cmd_addition_setup);?></a></li>
        <li <?php  if($__Context->act=='dispPageAdminGrantInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispPageAdminGrantInfo'));?>"><?php @print($__Context->lang->cmd_manage_grant);?></a></li>
    </ul>
</div>
<?php  } ?>

