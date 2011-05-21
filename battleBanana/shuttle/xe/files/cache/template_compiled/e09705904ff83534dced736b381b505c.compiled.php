<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/admin/tpl/','_header.html');
?>


<?php Context::loadLang("modules/admin/tpl/../../install/lang"); ?>
<!--Meta:modules/admin/tpl/../../module/tpl/js/module_admin.js--><?php Context::addJsFile("modules/admin/tpl/../../module/tpl/js/module_admin.js", true, ""); ?>
<!--Meta:modules/admin/tpl/../../session/tpl/js/session.js--><?php Context::addJsFile("modules/admin/tpl/../../session/tpl/js/session.js", true, ""); ?>
<!--Meta:modules/admin/tpl/../../addon/tpl/js/addon.js--><?php Context::addJsFile("modules/admin/tpl/../../addon/tpl/js/addon.js", true, ""); ?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/admin/tpl/../../addon/tpl/filter/","toggle_activate_addon.xml");
$oXmlFilter->compile();
?>


<div class="content">
    <?php  if($__Context->logged_info->is_admin == 'Y'){ ?>
        <p class="path">
            <a href="<?php @print(getUrl('','module','admin'));?>"><?php @print($__Context->lang->control_panel);?></a> 
            &gt; <a href="<?php @print(getUrl('','mid',$__Context->mid,'module',$__Context->module,'act',$__Context->act));?>"><?php @print($__Context->lang->admin_index);?></a>
        </p>
    <?php  } ?>

    <ul class="localNavigation">
        <li class="on" id="moduleOn"><a href="#" onclick="toggleModuleAddon('module');return false;"><?php @print($__Context->lang->module);?></a></li>
        <li id="addonOn"><a href="#" onclick="toggleModuleAddon('addon');return false;"><?php @print($__Context->lang->addon);?></a></li>
    </ul>

    <div id="xeModules">
        <table cellspacing="0" class="rowTable">
        <thead>
            <tr>
                <th><div><?php @print($__Context->lang->module_name);?></div></th>
                <th><div><?php @print($__Context->lang->version);?></div></th>
                <th><div><?php @print($__Context->lang->author);?></div></th>
                <th><div><?php @print($__Context->lang->table_count);?></div></th>
                <th><div><?php @print($__Context->lang->module_action);?></div></th>
                <th><div>&nbsp;</div></th>
            </tr>
        </thead>
        <tbody>
        <?php $Context->__idx[0]=0;if(count($__Context->module_list))  foreach($__Context->module_list as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <?php  if($__Context->val->need_install || $__Context->val->need_update){ ?>
            <tr>
                <td><a href="<?php @print(getUrl('','module','admin','act',$__Context->val->admin_index_act));?>" title="<?php @print(trim(htmlspecialchars($__Context->val->description)));?>"><?php @print($__Context->val->title);?></a> (<?php @print($__Context->val->module);?>)</td>
                <td><?php @print($__Context->val->version);?></td>
                <td>
                    <?php $Context->__idx[1]=0;if(count($__Context->val->author))  foreach($__Context->val->author as $__Context->author){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
                    <?php  if($__Context->author->homepage){ ?><a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php  } ?><?php @print($__Context->author->name);?><?php  if($__Context->author->homepage){ ?></a><?php  } ?>
                    <?php  } ?>
                </td>
                <td <?php  if($__Context->val->created_table_count != $__Context->val->table_count){ ?>class="alert"<?php  } ?>>
                    <?php @print($__Context->val->created_table_count);?>/<?php @print($__Context->val->table_count);?>
                </td>
                <td class="alert">
                    <?php  if($__Context->val->need_install){ ?>
                        <a href="#" onclick="doInstallModule('<?php @print($__Context->val->module);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->cmd_install));?>"><?php @print($__Context->lang->cmd_install);?></a>
                    <?php  }elseif($__Context->val->need_update){ ?>
                        <a href="#" onclick="doUpdateModule('<?php @print($__Context->val->module);?>'); return false;" title="<?php @print(htmlspecialchars($__Context->lang->cmd_update));?>"><?php @print($__Context->lang->cmd_update);?></a>
                    <?php  } ?>
                </td>
                <td><a href="<?php @print(getUrl('','module','module','act','dispModuleAdminInfo','selected_module',$__Context->val->module));?>" onclick="popopen(this.href,'module_info');return false" title="<?php @print(htmlspecialchars($__Context->lang->module_info));?>" class="buttonSet buttonInfo"><span><?php @print($__Context->lang->module_info);?></span></a></td>
            </tr>
            <?php  } ?>
        <?php  } ?>

        <?php $Context->__idx[2]=0;if(count($__Context->module_list))  foreach($__Context->module_list as $__Context->key => $__Context->val){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
            <?php  if(!$__Context->val->need_install && !$__Context->val->need_update){ ?>
            <tr>
                <td><a href="<?php @print(getUrl('','module','admin','act',$__Context->val->admin_index_act));?>" title="<?php @print(trim(htmlspecialchars($__Context->val->description)));?>"><?php @print($__Context->val->title);?></a> (<?php @print($__Context->val->module);?>)</td>
                <td><?php @print($__Context->val->version);?></td>
                <td>
                    <?php $Context->__idx[3]=0;if(count($__Context->val->author))  foreach($__Context->val->author as $__Context->author){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
                    <?php  if($__Context->author->homepage){ ?><a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php  } ?><?php @print($__Context->author->name);?><?php  if($__Context->author->homepage){ ?></a><?php  } ?>
                    <?php  } ?>
                </td>
                <td <?php  if($__Context->val->created_table_count != $__Context->val->table_count){ ?>class="alert"<?php  } ?>>
                    <?php @print($__Context->val->created_table_count);?>/<?php @print($__Context->val->table_count);?>
                </td>
                <td> - </td>
                <td><a href="<?php @print(getUrl('','module','module','act','dispModuleAdminInfo','selected_module',$__Context->val->module));?>" onclick="popopen(this.href,'module_info');return false" title="<?php @print(htmlspecialchars($__Context->lang->module_info));?>" class="buttonSet buttonInfo"><span><?php @print($__Context->lang->module_info);?></span></a></td>
            </tr>
            <?php  } ?>
        <?php  } ?>
        </tbody>
        </table>
    </div>

    <div id="xeAddons" style="display:none;">

        <form id="fo_addon" action="./" method="get">
            <input type="hidden" name="addon" value="" />
        </form>
        <table cellspacing="0" class="rowTable">
        <thead>
            <tr>
                <th><div><?php @print($__Context->lang->addon);?></div></th>
                <th><div><?php @print($__Context->lang->cmd_setup);?></div></th>
                <th><div>PC</div></th>
                <th><div>Mobile</div></th>
            </tr>
        </thead>
        <tbody>
        <?php $Context->__idx[4]=0;if(count($__Context->addon_list))  foreach($__Context->addon_list as $__Context->key => $__Context->val){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
        <tr>
            <td class="wide"><a href="<?php @print(getUrl('','module','addon','act','dispAddonAdminInfo','selected_addon',$__Context->val->addon));?>" onclick="popopen(this.href,'addon_info');return false"><?php @print($__Context->val->title);?></a></td>
            <td><a href="<?php @print(getUrl('','module','addon','act','dispAddonAdminSetup','selected_addon',$__Context->val->addon));?>" onclick="popopen(this.href,'addon_info');return false" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_setup);?></span></a></td>
            <td>
                <?php  if($__Context->val->activated){ ?>
                <a href="#" onclick="doToggleAddonInAdmin(this, '<?php @print($__Context->val->addon);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->use));?>" class="buttonSet buttonActive"><span><?php @print($__Context->lang->use);?></span></a>
                <?php  }else{ ?>
                <a href="#" onclick="doToggleAddonInAdmin(this, '<?php @print($__Context->val->addon);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->notuse));?>" class="buttonSet buttonDisable"><span><?php @print($__Context->lang->notuse);?></span></a>
                <?php  } ?>
            </td>
			<td>
                <?php  if($__Context->val->mactivated){ ?>
                <a href="#" onclick="doToggleAddonInAdmin(this, '<?php @print($__Context->val->addon);?>', 'mobile');return false;" title="<?php @print(htmlspecialchars($__Context->lang->use));?>" class="buttonSet buttonActive"><span><?php @print($__Context->lang->use);?></span></a>
                <?php  }else{ ?>
                <a href="#" onclick="doToggleAddonInAdmin(this, '<?php @print($__Context->val->addon);?>', 'mobile');return false;" title="<?php @print(htmlspecialchars($__Context->lang->notuse));?>" class="buttonSet buttonDisable"><span><?php @print($__Context->lang->notuse);?></span></a>
                <?php  } ?>
			</td>
        </tr>
        <?php  } ?>
        </tbody>
        </table>
    </div>
</div>

<div class="extension e2">
    <div class="section">
        <h4 class="xeAdmin"><?php @print($__Context->lang->status);?> <span class="date"><?php @print(zdate(date("Ymd"),"Y.m.d"));?></h4>
        <table cellspacing="0" class="crossTable">
        <thead>
        <tr>
            <th class="wide"><div>&nbsp;</div></th>
            <th><div><?php @print($__Context->lang->yesterday);?></div></th>
            <th><div><?php @print($__Context->lang->today);?></div></th>
            <th><div><?php @print($__Context->lang->total);?></div></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispMemberAdminList'));?>"><?php @print($__Context->lang->member);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->member->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->member->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->member->total));?></td>
        </tr>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispDocumentAdminList'));?>"><?php @print($__Context->lang->document);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->document->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->document->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->document->total));?></td>
        </tr>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispCommentAdminList'));?>"><?php @print($__Context->lang->comment);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->comment->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->comment->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->comment->total));?></td>
        </tr>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispTrackbackAdminList'));?>"><?php @print($__Context->lang->trackback);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->trackback->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->trackback->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->trackback->total));?></td>
        </tr>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispFileAdminList'));?>"><?php @print($__Context->lang->file);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->file->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->file->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->file->total));?></td>
        </tr>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispDocumentAdminDeclared'));?>"><?php @print($__Context->lang->document.' '.$__Context->lang->cmd_declare);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->documentDeclared->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->documentDeclared->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->documentDeclared->total));?></td>
        </tr>
        <tr>
            <th><a href="<?php @print(getUrl('act','dispCommentAdminDeclared'));?>"><?php @print($__Context->lang->comment.' '.$__Context->lang->cmd_declare);?></a></th>
            <td class="number center"><?php @print(number_format($__Context->status->commentDeclared->yesterday));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->commentDeclared->today));?></td>
            <td class="number center"><?php @print(number_format($__Context->status->commentDeclared->total));?></td>
        </tr>
        </tbody>
        </table>


        <h4 class="xeAdmin"><?php @print($__Context->lang->env_information);?></h4>
        <?php  if($__Context->current_version < $__Context->released_version){ ?>
        <p class="summary red"><?php @print(nl2br($__Context->lang->about_download_link));?> [<a href="<?php @print($__Context->download_link);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->lang->cmd_download);?></a>]</p>
        <?php  } ?>
        <table cellspacing="0" class="rowTable">
        <tbody>
        <tr>
            <th><div><?php @print($__Context->lang->current_version);?></div></th>
            <td class="wide">
                <strong><?php @print($__Context->current_version);?></strong><?php  if($__Context->current_version == $__Context->released_version){ ?> [<a href="<?php @print($__Context->download_link);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->lang->cmd_view);?></a>]<?php  } ?>
            </td>
        </tr>
        <tr>
            <th colspan="2"><div><?php @print($__Context->lang->current_path);?></div></th>
        </tr>
        <tr>
            <td colspan="2"><?php @print($__Context->installed_path);?>/</td>
        </tr>
        <tr>
            <th colspan="2"><div><?php @print($__Context->lang->start_module);?></div></th>
        </tr>
        <Tr>
            <td colspan="2"><a href="<?php @print(getSiteUrl('','','mid',$__Context->start_module->mid));?>" onclick="window.open(this.href);return false;"><?php @print($__Context->start_module->browser_title);?></a></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->time_zone);?></div></th>
            <td><?php $Context->__idx[5]=0;if(count($__Context->time_zone_list))  foreach($__Context->time_zone_list as $__Context->key => $__Context->val){$__Context->__idx[6]=($__Context->__idx[6]+1)%2; $__Context->cycle_idx = $__Context->__idx[6]+1; ?><?php  if($__Context->time_zone==$__Context->key){ ?><?php @print(substr($__Context->val,1,10));?><?php  } ?><?php  } ?></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->use_rewrite);?></div></th>
            <td><?php  if($__Context->use_rewrite=='Y'){ ?><?php @print($__Context->lang->use);?><?php  }else{ ?><?php @print($__Context->lang->notuse);?><?php  } ?></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->use_optimizer);?></div></th>
            <td><?php  if($__Context->use_optimizer=='Y'){ ?><?php @print($__Context->lang->use);?><?php  }else{ ?><?php @print($__Context->lang->notuse);?><?php  } ?></td>
        </tr>
        <tr>
            <th><div>Language</div></th>
            <td><?php $Context->__idx[6]=0;if(count($__Context->lang_supported))  foreach($__Context->lang_supported as $__Context->key => $__Context->val){$__Context->__idx[7]=($__Context->__idx[7]+1)%2; $__Context->cycle_idx = $__Context->__idx[7]+1; ?><?php  if($__Context->key == $__Context->selected_lang){ ?><?php @print($__Context->val);?><?php  } ?><?php  } ?></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->qmail_compatibility);?></div></th>
            <td><?php  if($__Context->qmail_compatibility=='Y'){ ?><?php @print($__Context->lang->use);?><?php  }else{ ?><?php @print($__Context->lang->notuse);?><?php  } ?></td>
        </tr>
        <tr>
            <th><div><?php @print($__Context->lang->use_db_session);?></div></th>
            <td><?php  if($__Context->use_db_session =='Y'){ ?><?php @print($__Context->lang->use);?><?php  }else{ ?><?php @print($__Context->lang->notuse);?><?php  } ?></td>
        </tr>
        </tbody>
        </table>

        <h4 class="xeAdmin"><?php @print($__Context->lang->cmd_remake_cache);?></h4>
        <table cellspacing="0" class="rowTable">
        <tbody>
        <tr>
            <td>
                <span class="button black strong"><input type="button" value="<?php @print($__Context->lang->cmd_remake_cache);?>" onclick="doRecompileCacheFile(); return false;"/></span>
            </td>
            <td>
                <span class="button black strong"><input type="button" value="<?php @print($__Context->lang->cmd_clear_session);?>" onclick="doClearSession(); return false; "/></span>
            </td>
        </tr>
        </tbody>
        </table>

        <?php  if($__Context->news){ ?>
        <h4 class="xeAdmin"><?php @print($__Context->lang->newest_news);?></h4>
        <table cellspacing="0" class="rowTable">
        <tbody>
        <?php $Context->__idx[7]=0;if(count($__Context->news))  foreach($__Context->news as $__Context->key => $__Context->val){$__Context->__idx[8]=($__Context->__idx[8]+1)%2; $__Context->cycle_idx = $__Context->__idx[8]+1; ?>
        <tr>
            <td>
                <a href="<?php @print($__Context->val->url);?>" onclick="window.open(this.href);return false;" class="fl"><?php @print($__Context->val->title);?></a>
                <span class="date fr"><?php @print(zdate($__Context->val->date,"Y-m-d"));?></span> 
            </td>
        </tr>
        <?php  } ?>
        </tbody>
        </table>
        <?php  } ?>
    </div>
</div>

<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/admin/tpl/','_footer.html');
?>

