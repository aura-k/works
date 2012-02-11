<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/opage/tpl/js/blog_admin.js--><?php Context::addJsFile("modules/opage/tpl/js/blog_admin.js", true, ""); ?>
<!--Meta:modules/opage/tpl/js/opage_admin.js--><?php Context::addJsFile("modules/opage/tpl/js/opage_admin.js", true, ""); ?>
<h3 class="xeAdmin"><?php @print($__Context->lang->opage);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>

<div class="infoText"><?php @print(nl2br($__Context->lang->about_opage));?></div>

<?php  if($__Context->module_info){ ?>
<div class="header4">
    <?php  if($__Context->module_info->mid){ ?>
    <h4 class="xeAdmin"><?php @print($__Context->module_info->mid);?> <?php  if($__Context->module_info->is_default=='Y'){ ?><span class="bracket">(<?php @print($__Context->lang->is_default);?>)</span><?php  } ?> <span class="vr">|</span> <a href="<?php @print(getSiteUrl($__Context->module_info->domain,'','mid',$__Context->module_info->mid));?>" onclick="window.open(this.href); return false;" class="view">View</a></h4>
    <?php  } ?>

    <ul class="localNavigation">
        <li><a href="<?php @print(getUrl('act','dispOpageAdminContent','module_srl',''));?>"><?php @print($__Context->lang->cmd_back);?></a></li>
        <li <?php  if($__Context->act=='dispOpageAdminInsert'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispOpageAdminInsert'));?>"><?php @print($__Context->lang->cmd_setup);?></a></li>
        <li <?php  if($__Context->act=='dispOpageAdminGrantInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispOpageAdminGrantInfo'));?>"><?php @print($__Context->lang->cmd_manage_grant);?></a></li>
    </ul>
</div>
<?php  } ?>