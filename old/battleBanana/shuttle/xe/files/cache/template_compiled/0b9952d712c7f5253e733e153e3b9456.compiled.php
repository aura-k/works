<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_header.html');
?>


<form action="./" method="post" onsubmit="jQuery(this).find('input').each(function(){if(this.title==this.value)this.value='';});return procFilter(this, window.insert)" id="fo_write" class="boardWrite">
<input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
<input type="hidden" name="content" value="<?php @print($__Context->oDocument->getContentText());?>" />
<input type="hidden" name="document_srl" value="<?php @print($__Context->document_srl);?>" />

	<div class="boardWriteHeader">
	
		<?php  if($__Context->module_info->use_category=="Y"){ ?>
		<select name="category_srl" class="category">
			<option value=""><?php @print($__Context->lang->category);?></option>
			<?php $Context->__idx[0]=0;if(count($__Context->category_list))  foreach($__Context->category_list as $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
			<option <?php  if(!$__Context->val->grant){ ?>disabled="disabled"<?php  } ?> value="<?php @print($__Context->val->category_srl);?>" <?php  if($__Context->val->grant&&$__Context->val->selected||$__Context->val->category_srl==$__Context->oDocument->get('category_srl')){ ?>selected="selected"<?php  } ?>>
				<?php @print(str_repeat("&nbsp;&nbsp;",$__Context->val->depth));?> <?php @print($__Context->val->title);?> (<?php @print($__Context->val->document_count);?>)
			</option>
			<?php  } ?>
		</select>
		<?php  } ?>
		
		<?php  if($__Context->oDocument->getTitleText()){ ?>
		<input type="text" name="title" id="postTitle" class="inputText" value="<?php @print(htmlspecialchars($__Context->oDocument->getTitleText()));?>" />
		<?php  }else{ ?>
		<input type="text" name="title" id="postTitle" class="inputText" value="<?php @print($__Context->lang->title);?>" title="<?php @print($__Context->lang->title);?>" onfocus="if(this.value==this.title) this.value='';" />
		<?php  } ?>
	
        <?php  if($__Context->is_logged){ ?>
        <span class="buttonOfficial"><button type="button" onclick="doDocumentLoad(this); return false;"><?php @print($__Context->lang->cmd_load);?></button></span>
        <?php  } ?>
		
	</div>

    <?php  if(count($__Context->extra_keys)){ ?>
    <table border="1" cellspacing="0" summary="Extra Form" class="extraVarsList">
	<caption><em>*</em> : <?php @print($__Context->lang->is_required);?></caption>
    <?php $Context->__idx[1]=0;if(count($__Context->extra_keys))  foreach($__Context->extra_keys as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <tr>
        <th scope="row"><?php @print($__Context->val->name);?> <?php  if($__Context->val->is_required=='Y'){ ?><em>*</em><?php  } ?></th>
        <td><?php @print($__Context->val->getFormHTML());?></td>
    </tr>
    <?php  } ?>
    </table>
    <?php  } ?>

    <div class="editor"><?php @print($__Context->oDocument->getEditor());?></div>

    <div class="tag">
        <input type="text" name="tags" value="<?php @print(htmlspecialchars($__Context->oDocument->get('tags')));?>" class="inputText" title="Tag" />
		<p><?php @print($__Context->lang->about_tag);?></p>
    </div>

	<div class="editorOption">
		<?php  if(!$__Context->is_logged){ ?>
		   <input type="text" name="nick_name" class="inputText userName" value="<?php @print($__Context->lang->writer);?>" title="<?php @print($__Context->lang->writer);?>" onfocus="if(this.value==this.title)this.value='';return false;" />
		   <input type="password" name="password" class="inputText userPw" value="<?php @print($__Context->lang->password);?>" title="<?php @print($__Context->lang->password);?>"  onfocus="if(this.value==this.title)this.value='';return false;" />
		   <input type="text" name="email_address" class="inputText emailAddress" value="<?php @print($__Context->lang->email_address);?>" title="<?php @print($__Context->lang->email_address);?>"  onfocus="if(this.value==this.title)this.value='';return false;" />
		   <input type="text" name="homepage" class="inputText homePage" value="<?php @print($__Context->lang->homepage);?>" title="<?php @print($__Context->lang->homepage);?>"  onfocus="if(this.value==this.title)this.value='';return false;" />
		<?php  } ?>
		
        <?php  if($__Context->grant->manager){ ?>
        <?php @$__Context->_color = array('555555','222288','226622','2266EE','8866CC','88AA66','EE2222','EE6622','EEAA22','EEEE22');?>
        <select name="title_color" id="title_color" <?php  if($__Context->oDocument->get('title_color')){ ?>style="color:#<?php @print($__Context->oDocument->get('title_color'));?>;"<?php  } ?> onchange="this.style.color=this.options[this.selectedIndex].style.color;">
                <option value="" style="color:#CCCCCC;"><?php @print($__Context->lang->title_color);?></option>
                <?php $Context->__idx[2]=0;if(count($__Context->_color))  foreach($__Context->_color as $__Context->_col){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
                <option value="<?php @print($__Context->_col);?>" style="color:#<?php @print($__Context->_col);?>" <?php  if($__Context->oDocument->get('title_color')==$__Context->_col){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->title_color);?></option>
                <?php  } ?>
            </select>
            <input type="checkbox" name="title_bold" id="title_bold" value="Y" <?php  if($__Context->oDocument->get('title_bold')=='Y'){ ?>checked="checked"<?php  } ?> />
            <label for="title_bold"><?php @print($__Context->lang->title_bold);?></label>
            <input type="checkbox" name="is_notice" value="Y" <?php  if($__Context->oDocument->isNotice()){ ?>checked="checked"<?php  } ?> id="is_notice" />
            <label for="is_notice"><?php @print($__Context->lang->notice);?></label>
            <input type="checkbox" name="lock_comment" value="Y" <?php  if($__Context->oDocument->isLocked()){ ?>checked="checked"<?php  } ?> id="lock_comment" />
            <label for="lock_comment"><?php @print($__Context->lang->lock_comment);?></label>
        <?php  } ?>
        <?php  if($__Context->module_info->secret=="Y"){ ?>
            <input type="checkbox" name="is_secret" value="Y" <?php  if($__Context->oDocument->isSecret()){ ?>checked="checked"<?php  } ?> id="is_secret" />
            <label for="is_secret"><?php @print($__Context->lang->secret);?></label>
        <?php  } ?>
            <input type="checkbox" name="allow_comment" value="Y" <?php  if($__Context->oDocument->allowComment()){ ?>checked="checked"<?php  } ?> id="allow_comment" />
            <label for="allow_comment"><?php @print($__Context->lang->allow_comment);?></label>
            <input type="checkbox" name="allow_trackback" value="Y" <?php  if($__Context->oDocument->allowTrackback()){ ?>checked="checked"<?php  } ?> id="allow_trackback" />
            <label for="allow_trackback"><?php @print($__Context->lang->allow_trackback);?></label>
        <?php  if($__Context->is_logged){ ?>
            <input type="checkbox" name="notify_message" value="Y" <?php  if($__Context->oDocument->useNotify()){ ?>checked="checked"<?php  } ?> id="notify_message" />
            <label for="notify_message"><?php @print($__Context->lang->notify);?></label>
        <?php  } ?>
    </div>

	<div class="boardNavigation">
		<span class="buttonOfficial"><input type="submit" value="<?php @print($__Context->lang->cmd_registration);?>" accesskey="s" /></span>
		<span class="buttonOfficial"><button type="button" onclick="doDocumentSave(this);"><?php @print($__Context->lang->cmd_temp_save);?></button></span>
		<span class="buttonOfficial"><button type="button" onclick="doDocumentLoad(this);"><?php @print($__Context->lang->cmd_load);?></button></span>
	</div>

    </form>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_footer.html');
?>

