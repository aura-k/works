<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/integration_search//tpl/js/integration_search_admin.js--><?php Context::addJsFile("modules/integration_search//tpl/js/integration_search_admin.js", true, ""); ?>

<h3 class="xeAdmin"><?php @print($__Context->lang->integration_search);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>

<div class="header4 gap1">
    <ul class="localNavigation">
        <li <?php  if($__Context->act=='dispIntegration_searchAdminContent'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispIntegration_searchAdminContent'));?>"><?php @print($__Context->lang->cmd_setup);?></a></li>
        <li <?php  if($__Context->act=='dispIntegration_searchAdminSkinInfo'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispIntegration_searchAdminSkinInfo'));?>"><?php @print($__Context->lang->cmd_manage_skin);?></a></li>
        <?php  if($__Context->module!='admin'){ ?>
        <li><a href="<?php @print(getUrl('act','IS'));?>"><?php @print($__Context->lang->cmd_back);?></a></li>
        <?php  } ?>
    </ul>
</div>

