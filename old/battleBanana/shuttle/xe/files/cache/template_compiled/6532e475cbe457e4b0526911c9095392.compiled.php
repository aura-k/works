<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/layout/tpl/js/layout_admin.js--><?php Context::addJsFile("modules/layout/tpl/js/layout_admin.js", true, ""); ?>

<h3 class="xeAdmin"><?php @print($__Context->lang->layout);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>

<div class="infoText"><?php @print(nl2br($__Context->lang->about_layout));?></div>

<!-- 관리자 페이지용 메뉴 -->
<?php  if($__Context->module == 'admin'){ ?>
<div class="header4">
    <ul class="localNavigation">
        <li <?php  if($__Context->act=='dispLayoutAdminContent'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispLayoutAdminContent','layout_type',''));?>"><?php @print($__Context->lang->layout_list);?></a></li>
        <li <?php  if($__Context->act=='dispLayoutAdminDownloadedList'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispLayoutAdminDownloadedList','layout_type',''));?>"><?php @print($__Context->lang->downloaded_list);?></a></li>
        <li <?php  if($__Context->act=='dispLayoutAdminMobileContent'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispLayoutAdminMobileContent','layout_type',''));?>"><?php @print($__Context->lang->mobile_layout_list);?></a></li>
        <li <?php  if($__Context->act=='dispLayoutAdminDownloadedMobileList'){ ?>class="on"<?php  } ?>><a href="<?php @print(getUrl('act','dispLayoutAdminDownloadedMobileList','layout_type',''));?>"><?php @print($__Context->lang->mobile_downloaded_list);?></a></li>
    </ul>
</div>
<?php  } ?>
