<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/autoinstall/tpl/','header.html');
?>

<!--Meta:modules/autoinstall/tpl/css/autoinstall.css--><?php Context::addCSSFile("modules/autoinstall/tpl/css/autoinstall.css", true, "all", ""); ?>
<!--Meta:modules/autoinstall/tpl/js/autoinstall.js--><?php Context::addJsFile("modules/autoinstall/tpl/js/autoinstall.js", true, ""); ?>
<div class="infoText">
	<?php  if($__Context->show_ftp_note){ ?>
	<p class="warning"><?php @print($__Context->lang->description_ftp_note);?> <a href="<?php @print(getUrl('','module','admin','act','dispAdminConfig'));?>#ftpSetup">FTP Setup</a> </p>
	<?php  } ?>
	<?php  if($__Context->need_update){ ?>
	<p class="update"><?php @print($__Context->lang->need_update);?></p>
	<?php  }else{ ?>
	<p class="update"><?php @print($__Context->lang->description_update);?></p>
	<?php  } ?>
	<p><span class="button xLarge strong green"><button type="button" onclick="doUpdate()" title="update">Update</button></span></p>
</div>

<div class="install">
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/autoinstall/tpl/','leftBox.html');
?>

<?php  if($__Context->item_list){ ?>
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/autoinstall/tpl/','list.html');
?>

<?php  } ?>
</div>
