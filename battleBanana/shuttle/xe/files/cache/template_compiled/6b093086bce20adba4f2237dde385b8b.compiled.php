<?php if(!defined("__ZBXE__")) exit();?>
<div class="boardRead">

	<div class="boardReadHeader">
		
		<div class="titleArea">
			<h3 class="title"><a href="<?php @print($__Context->oDocument->getPermanentUrl());?>"><?php @print($__Context->oDocument->getTitle());?></a></h3>
			<a href="<?php @print(getUrl('category',$__Context->oDocument->get('category_srl'), 'document_srl', ''));?>" class="category"><?php @print($__Context->category_list[$__Context->oDocument->get('category_srl')]->title);?></a>
			<span class="sum">
				<span class="read"><?php @print($__Context->lang->readed_count);?> <span class="num"><?php @print($__Context->oDocument->get('readed_count'));?></span></span>
				<span class="vote"><?php @print($__Context->lang->voted_count);?> <span class="num"><?php @print($__Context->oDocument->get('voted_count'));?></span></span>
				<span class="date"><?php @print($__Context->oDocument->getRegdate('Y.m.d'));?> <?php @print($__Context->oDocument->getRegdate('H:i:s'));?></span>
			</span>
		</div>
		
		<div class="authorArea">
		<?php  if($__Context->module_info->display_author!='N'){ ?>
			<?php  if(!$__Context->oDocument->getMemberSrl()){ ?>
				<?php  if($__Context->oDocument->isExistsHomepage()){ ?>
					<a href="<?php @print($__Context->oDocument->getHomepageUrl());?>" onclick="window.open(this.href);return false;" class="author"><?php @print($__Context->oDocument->getNickName());?></a>
				<?php  }else{ ?>
					<?php @print($__Context->oDocument->getNickName());?>
				<?php  } ?>
			<?php  }else{ ?>
				<a href="#popup_menu_area" class="member_<?php @print($__Context->oDocument->get('member_srl'));?> author" onclick="return false"><?php @print($__Context->oDocument->getNickName());?></a>
			<?php  } ?>
		<?php  } ?>
			<span class="ipAddress"><?php  if($__Context->grant->manager || $__Context->module_info->display_ip_address!='N'){ ?><?php @print($__Context->oDocument->getIpaddress());?><?php  } ?></span>
			<a href="<?php @print($__Context->oDocument->getPermanentUrl());?>" class="permaLink"><?php @print($__Context->oDocument->getPermanentUrl());?></a>
		</div>

	</div>

	<?php  if($__Context->oDocument->isExtraVarsExists() && (!$__Context->oDocument->isSecret() || $__Context->oDocument->isGranted()) ){ ?>
    <table border="1" cellspacing="0" summary="Extra Form" class="extraVarsList">
    <?php $Context->__idx[0]=0;if(count($__Context->oDocument->getExtraVars()))  foreach($__Context->oDocument->getExtraVars() as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
    <tr>
        <th><?php @print($__Context->val->name);?> :</th>
        <td><?php @print($__Context->val->getValueHTML());?>&nbsp;</td>
    </tr>
    <?php  } ?>
	</table>
	<?php  } ?>

	<div class="boardReadBody">
		<?php  if($__Context->oDocument->isSecret() && !$__Context->oDocument->isGranted()){ ?>
			<form action="./" method="get" onsubmit="return procFilter(this, input_password)" class="secretMessage">
			<input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
			<input type="hidden" name="page" value="<?php @print($__Context->page);?>" />
			<input type="hidden" name="document_srl" value="<?php @print($__Context->oDocument->document_srl);?>" />

				<p>&quot;<?php @print($__Context->lang->msg_is_secret);?>&quot;</p>
				<dl>
					<dt><label for="cpw"><?php @print($__Context->lang->password);?></label> :</dt>
					<dd><input type="password" name="password" id="cpw" class="inputText" /><span class="buttonOfficial"><input type="submit" value="<?php @print($__Context->lang->cmd_input);?>" /></span></dd>
				</dl>

			</form>
		<?php  }else{ ?>
			<?php @print($__Context->oDocument->getContent());?>
		<?php  } ?>

	</div>

	<div class="boardReadFooter">
	
        <?php  if($__Context->module_info->display_sign != 'N' && ($__Context->oDocument->getProfileImage() || $__Context->oDocument->getSignature())){ ?>
			<div class="memberSignature">
			<?php  if($__Context->oDocument->getProfileImage()){ ?>
				<img src="<?php @print($__Context->oDocument->getProfileImage());?>" alt="profile" class="profile" align="left" />
			<?php  } ?>
			<?php  if($__Context->oDocument->getSignature()){ ?>
				<?php @print($__Context->oDocument->getSignature());?>
			<?php  } ?>
			</div>
		<?php  } ?>
		
		<?php @$__Context->tag_list = $__Context->oDocument->get('tag_list');?>
		<?php  if(count($__Context->tag_list)){ ?>
		<dl class="tag">
			<dt><img src="/xe/modules/board/skins/xe_official/img/common/iconTag.gif" width="27" height="11" alt="<?php @print($__Context->lang->tag);?>" /></dt>
			<?php  for($__Context->i=0;$__Context->i<count($__Context->tag_list);$__Context->i++){ ?>
				<?php @$__Context->tag = $__Context->tag_list[$__Context->i];;?>
				<dd><a href="<?php @print(getUrl('search_target','tag','search_keyword',$__Context->tag,'document_srl',''));?>" rel="tag"><?php @print(htmlspecialchars($__Context->tag));?></a></dd>
			<?php  } ?>
		</dl>
		<?php  } ?>
		
		<?php  if($__Context->oDocument->hasUploadedFiles()){ ?>
        <dl class="attachedFile">
            <dt><img src="/xe/modules/board/skins/xe_official/img/common/iconFiles.gif" width="27" height="11" alt="<?php @print($__Context->lang->uploaded_file);?>" /> <button type="button" class="fileToggle" onclick="jQuery(this).parents('dl.attachedFile').toggleClass('open');return false;"><?php @print($__Context->lang->uploaded_file);?> (<?php @print($__Context->oDocument->get('uploaded_count'));?>)</button></dt>
            <dd>
                <ul class="files">
                    <?php @$__Context->uploaded_list = $__Context->oDocument->getUploadedFiles();?>
                    <?php $Context->__idx[1]=0;if(count($__Context->uploaded_list))  foreach($__Context->uploaded_list as $__Context->key => $__Context->file){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
                    <li><a href="<?php @print(getUrl(''));?><?php @print($__Context->file->download_url);?>"><?php @print($__Context->file->source_filename);?> <span class="bubble">[File Size:<?php @print(FileHandler::filesize($__Context->file->file_size));?>/Download:<?php @print(number_format($__Context->file->download_count));?>]</span></a></li>
                    <?php  } ?>
                </ul>
            </dd>
        </dl>
		<?php  } ?>
		
        
        <?php  if(!$__Context->oDocument->getTrackbackCount()){ ?>
		<dl class="trackbackURL">
			<dt><?php @print($__Context->lang->trackback);?> : </dt>
			<dd><a href="<?php @print($__Context->oDocument->getTrackbackUrl());?>" onclick="return false;"><?php @print($__Context->oDocument->getTrackbackUrl());?></a></dd>
		</dl>
        <?php  } ?>
		
	</div>

    <div class="boardNavigation">
		<?php  if($__Context->module_info->default_style != 'blog'){ ?>
        <div class="buttonLeft">
			<a href="<?php @print(getUrl('document_srl',''));?>" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_list);?></span></a>
		</div>
        <?php  } ?>
		
        <?php  if($__Context->oDocument->isEditable()){ ?>
		<div class="buttonRight">
			<a href="<?php @print(getUrl('act','dispBoardWrite','document_srl',$__Context->oDocument->document_srl,'comment_srl',''));?>" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_modify);?></span></a>
			<a href="<?php @print(getUrl('act','dispBoardDelete','document_srl',$__Context->oDocument->document_srl,'comment_srl',''));?>" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_delete);?></span></a>
		</div>
        <?php  } ?>
    </div>

</div>

<?php  if($__Context->oDocument->allowTrackback()){ ?>
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','trackback.html');
?>

<?php  } ?>
<?php  if($__Context->oDocument->allowComment()){ ?>
    <a name="comment"></a>
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','comment.html');
?>


    <?php  if($__Context->grant->write_comment && $__Context->oDocument->isEnableComment() ){ ?>
        <form action="./" method="post" onsubmit="jQuery(this).find('input').each(function(){if(this.title==this.value)this.value='';});return procFilter(this, insert_comment)" class="boardEditor" >
        <input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
        <input type="hidden" name="document_srl" value="<?php @print($__Context->oDocument->document_srl);?>" />
        <input type="hidden" name="comment_srl" value="" />
        <input type="hidden" name="content" value="" />
            <div class="boardWrite commentEditor">
                <div class="editor"><?php @print($__Context->oDocument->getCommentEditor());?></div>

                <div class="editorOption">
                <?php  if(!$__Context->is_logged){ ?>
                   <input type="text" name="nick_name" class="inputText userName" value="<?php @print($__Context->lang->writer);?>"  title="<?php @print($__Context->lang->writer);?>" onfocus="if(this.value==this.title)this.value='';return false;" />
                   <input type="password" name="password" class="inputText userPw" value="<?php @print($__Context->lang->password);?>" title="<?php @print($__Context->lang->password);?>" onfocus="if(this.value==this.title)this.value='';return false;" />
                   <input type="text" name="email_address" class="inputText emailAddress" value="<?php @print($__Context->lang->email_address);?>" title="<?php @print($__Context->lang->email_address);?>" onfocus="if(this.value==this.title)this.value='';return false;" />
                   <input type="text" name="homepage" class="inputText homePage" value="<?php @print($__Context->lang->homepage);?>" title="<?php @print($__Context->lang->homepage);?>" onfocus="if(this.value==this.title)this.value='';return false;" />
                <?php  } ?>

				<?php  if($__Context->is_logged){ ?>
					<input type="checkbox" name="notify_message" value="Y" id="notify_message" class="inputCheck" />
					<label for="notify_message"><?php @print($__Context->lang->notify);?></label>
				<?php  } ?>
					<input type="checkbox" name="is_secret" value="Y" id="is_secret" class="inputCheck" />
					<label for="is_secret"><?php @print($__Context->lang->secret);?></label>
                </div>
        
                <div class="boardNavigation">
                    <span class="buttonOfficial"><input type="submit" value="<?php @print($__Context->lang->cmd_comment_registration);?>" accesskey="s" /></span>
                </div>

            </div>

        </form>
    <?php  } ?>
<?php  } ?>

