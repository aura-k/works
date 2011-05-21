<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/autoinstall/tpl/','header.html');
?>

<!--Meta:modules/autoinstall/tpl/css/autoinstall.css--><?php Context::addCSSFile("modules/autoinstall/tpl/css/autoinstall.css", true, "all", ""); ?>
<!--Meta:modules/autoinstall/tpl/js/autoinstall.js--><?php Context::addJsFile("modules/autoinstall/tpl/js/autoinstall.js", true, ""); ?>
<div class="infoText">
	<p><strong><?php @print($__Context->package->title);?></strong> ver. <strong><?php @print($__Context->package->version);?></strong> ( <?php  if($__Context->package->installed){ ?><?php @print($__Context->lang->current_version);?>: <?php @print($__Context->package->cur_version);?> <?php  if($__Context->package->need_update){ ?> (<?php @print($__Context->lang->require_update);?>)<?php  } ?> <?php  }else{ ?><?php @print($__Context->lang->require_installation);?><?php  } ?> )</p>
	<?php $Context->__idx[0]=0;if(count($__Context->package->depends))  foreach($__Context->package->depends as $__Context->dep){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
	<dl>
    <dt><strong><?php @print($__Context->lang->depending_programs);?> :</strong></dt>
		<dd> <?php @print($__Context->dep->title);?> ver. <?php @print($__Context->dep->version);?> - 
			<?php  if($__Context->dep->installed){ ?><?php @print($__Context->lang->current_version);?>: <?php @print($__Context->dep->cur_version);?> <?php  if($__Context->dep->need_update){ ?> (<?php @print($__Context->lang->require_update);?>)<?php  } ?> <?php  }else{ ?><?php @print($__Context->lang->require_installation);?><?php  } ?>
            <?php  if($__Context->show_ftp_note && ($__Context->dep->need_update || !$__Context->dep->installed)){ ?><a href="http://download.xpressengine.com/?module=resourceapi&act=procResourceapiDownload&package_srl=<?php @print($__Context->dep->package_srl);?>"><?php @print($__Context->lang->cmd_download);?></a> (<?php @print($__Context->lang->path);?> : <?php @print($__Context->dep->path);?>)<?php  } ?>
		</dd>
	</dl>
	<?php  } ?>

    <?php  if(!$__Context->package->installed || $__Context->package->need_update){ ?>
    <?php  if($__Context->show_ftp_note){ ?>
    <p class="warning"><?php @print($__Context->lang->description_download);?>. (<a href="<?php @print(getUrl('','module','admin','act','dispAdminConfig'));?>#ftpSetup">FTP Setup</a>) </p>
    <p><?php @print($__Context->lang->path);?> : <?php @print($__Context->package->path);?></p>
    <p><a href="http://download.xpressengine.com/?module=resourceapi&act=procResourceapiDownload&package_srl=<?php @print($__Context->package->package_srl);?>" class="button large green strong"><span><?php @print($__Context->lang->cmd_download);?></span></a></p>
    <?php  }else{ ?>
	<p><?php @print($__Context->lang->description_install);?>. </p>
    <?php  if($__Context->need_password){ ?>
    <p><label for="ftp_password">FTP <?php @print($__Context->lang->password);?> (<?php @print($__Context->lang->about_ftp_password);?>):</label><input type="password" name="ftp_password" id="ftp_password" class="inputTypeText" /></p>
    <?php  } ?>
	<p><a href="#" onclick="doInstallPackage('<?php @print($__Context->package->package_srl);?>')" class="button large green strong"><span><?php @print($__Context->package->installed?$__Context->lang->update:$__Context->lang->install);?></span></a></p>
    <?php  } ?>
    <?php  } ?>

</div>
