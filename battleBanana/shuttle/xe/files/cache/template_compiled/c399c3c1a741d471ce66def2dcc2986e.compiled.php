<?php if(!defined("__ZBXE__")) exit();?>
<?php  if($__Context->oDocument->getCommentCount()){ ?>
<hr class="hr" />
<div class="feedbackList" id="reply">

	<h3 class="feedbackHeader">
		<?php  if($__Context->grant->write_comment && $__Context->oDocument->allowComment()){ ?>
			<?php @print($__Context->lang->comment);?> <em>'<?php @print($__Context->oDocument->getCommentcount());?>'</em>
		<?php  } ?>
	</h3>
	
	<div class="replyList">

		<?php @$__Context->_comment_list = $__Context->oDocument->getComments();?>
		<?php $Context->__idx[3]=0;if(count($__Context->_comment_list))  foreach($__Context->_comment_list as $__Context->key => $__Context->comment){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
				<div class="item <?php  if($__Context->comment->get('depth')){ ?>itemReply<?php  } ?>" id="comment_<?php @print($__Context->comment->comment_srl);?>">
					<div class="indent" <?php  if($__Context->comment->get('depth')){ ?> style="margin-left:<?php @print(($__Context->comment->get('depth'))*15);?>px" <?php  } ?>>
					
					<div class="itemAside">
                        <?php  if($__Context->comment->getProfileImage()){ ?>
                            <img src="<?php @print($__Context->comment->getProfileImage());?>" alt="profile" class="profile" />
                        <?php  } ?>
						<h4 class="header">
						<?php  if(!$__Context->comment->member_srl){ ?>
							<?php  if($__Context->comment->homepage){ ?>
								<a href="<?php @print($__Context->comment->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->comment->getNickName());?></a>
							<?php  }else{ ?>
								<?php @print($__Context->comment->getNickName());?>
							<?php  } ?>
						<?php  }else{ ?>
							<a href="#popup_menu_area" class="member_<?php @print($__Context->comment->member_srl);?>" onclick="return false"><?php @print($__Context->comment->getNickName());?></a>
						<?php  } ?>
						</h4>
	
						<p class="meta">
							<?php @print($__Context->comment->getRegdate('Y.m.d'));?>
							<?php @print($__Context->comment->getRegdate('H:i:s'));?>
						<?php  if($__Context->grant->manager || $__Context->module_info->display_ip_address!='N'){ ?>
							<br /><?php @print($__Context->comment->getIpaddress());?>
						<?php  } ?>
						</p>
						
						<?php  if($__Context->comment->get('voted_count')!=0 || $__Context->comment->get('blamed_count') != 0){ ?>
						<dl class="vote">
							<dt class="love"><span><?php @print($__Context->lang->cmd_vote);?></span></dt>
							<dd><?php @print($__Context->comment->get('voted_count')?$__Context->comment->get('voted_count'):0);?></dd>
							<dt class="hate"><span><?php @print($__Context->lang->cmd_vote_down);?></span></dt>
							<dd><?php @print($__Context->comment->get('blamed_count')?$__Context->comment->get('blamed_count'):0);?></dd>
						</dl>
						<?php  } ?>
						
					</div>
	
                    <div class="itemContent">
					<?php  if(!$__Context->comment->isAccessible()){ ?>
						<form action="./" method="get" onsubmit="return procFilter(this, input_password)" class="secretMessage">
						<input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
						<input type="hidden" name="page" value="<?php @print($__Context->page);?>" />
						<input type="hidden" name="document_srl" value="<?php @print($__Context->comment->get('document_srl'));?>" />
						<input type="hidden" name="comment_srl" value="<?php @print($__Context->comment->get('comment_srl'));?>" />
							<p>&quot;<?php @print($__Context->lang->msg_is_secret);?>&quot;</p>
							<dl>
								<dt><label for="cpw"><?php @print($__Context->lang->password);?></label> :</dt>
								<dd><input type="password" id="cpw" name="password" class="inputText" /><span class="buttonOfficial"><input type="submit" value="<?php @print($__Context->lang->cmd_input);?>" /></span></dd>
							</dl>
						</form>
					<?php  }else{ ?>
					<?php @print($__Context->comment->getContent(false));?>

					<?php  if($__Context->comment->hasUploadedFIles()){ ?>
					<dl class="attachedFile">
						<dt><img src="/xe/modules/board/skins/xe_official/img/common/iconFiles.gif" width="27" height="11" alt="<?php @print($__Context->lang->uploaded_file);?>" /> <button type="button" class="fileToggle" onclick="jQuery(this).parents('dl.attachedFile').toggleClass('open');return false;"><?php @print($__Context->lang->uploaded_file);?> (<?php @print($__Context->comment->get('uploaded_count'));?>)</button></dt>
						<dd>
							<ul class="files">
								<?php @$__Context->_uploaded_files = $__Context->comment->getUploadedFiles();?>
								<?php $Context->__idx[4]=0;if(count($__Context->_uploaded_files))  foreach($__Context->_uploaded_files as $__Context->key => $__Context->file){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
								<li><a href="<?php @print(getUrl(''));?><?php @print($__Context->file->download_url);?>"><?php @print($__Context->file->source_filename);?> <span class="bubble">[File Size:<?php @print(FileHandler::filesize($__Context->file->file_size));?>/Download<?php @print(number_format($__Context->file->download_count));?>]</span></a></li>
								<?php  } ?>
							</ul>
						</dd>
					</dl>
					<?php  } ?>

					<ul class="option">
					<?php  if($__Context->is_logged){ ?>
						<li class="wouldYou"><a href="#popup_menu_area" class="comment_<?php @print($__Context->comment->comment_srl);?>"><?php @print($__Context->lang->cmd_comment_do);?></a></li>
					<?php  } ?>
						<li><a href="<?php @print(getUrl('act','dispBoardReplyComment','comment_srl',$__Context->comment->comment_srl));?>"><?php @print($__Context->lang->cmd_reply);?></a></li> 
					<?php  if($__Context->comment->isGranted() || !$__Context->comment->get('member_srl')){ ?>
						<li><a href="<?php @print(getUrl('act','dispBoardModifyComment','comment_srl',$__Context->comment->comment_srl));?>"><?php @print($__Context->lang->cmd_modify);?></a></li> 
						<li><a href="<?php @print(getUrl('act','dispBoardDeleteComment','comment_srl',$__Context->comment->comment_srl));?>"><?php @print($__Context->lang->cmd_delete);?></a></li>
					<?php  } ?>
					</ul>

					<?php  } ?>

                    </div>
					
				</div>
				<?php  if($__Context->comment->get('depth')){ ?>
			<?php  } ?>
			
		</div>
		<?php  } ?>

</div>

    <?php  if($__Context->oDocument->comment_page_navigation){ ?>
    <div class="pagination">
        <a href="<?php @print(getUrl('cpage',1));?>#comment" class="prevEnd"><?php @print($__Context->lang->first_page);?></a> 
        <?php  while($__Context->page_no = $__Context->oDocument->comment_page_navigation->getNextPage()){ ?>
            <?php  if($__Context->cpage == $__Context->page_no){ ?>
                <strong><?php @print($__Context->page_no);?></strong> 
            <?php  }else{ ?>
                <a href="<?php @print(getUrl('cpage',$__Context->page_no));?>#comment"><?php @print($__Context->page_no);?></a>
            <?php  } ?>
        <?php  } ?>
        <a href="<?php @print(getUrl('cpage',$__Context->oDocument->comment_page_navigation->last_page));?>#comment" class="nextEnd"><?php @print($__Context->lang->last_page);?></a>
    </div>
    <?php  } ?>

</div>
<?php  } ?>
