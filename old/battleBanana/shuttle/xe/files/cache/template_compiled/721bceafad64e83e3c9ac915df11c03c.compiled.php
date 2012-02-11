<?php if(!defined("__ZBXE__")) exit();?>
<?php @$__Context->list_count = 0;?>

<form action="./" method="get" class="boardListForm">
    <fieldset>
        <legend>List of Articles</legend>
        <table cellspacing="0" border="1" summary="List of Articles" class="boardList webZine">
			<thead>
                <tr>
					
					<?php $Context->__idx[0]=0;if(count($__Context->list_config))  foreach($__Context->list_config as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
						
						<?php  if($__Context->val->idx == -1){ ?>
	
							
							<?php  if($__Context->val->type == 'no'){ ?>
							    <?php @$__Context->list_count++;?>							
								<th scope="col"><?php @print($__Context->lang->no);?></th>
							<?php  }elseif($__Context->val->type == 'title'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col" class="title">
									<?php  if($__Context->module_info->use_category == "Y"){ ?>
									<span class="jumpTo">
										<select name="category" id="board_category">
											<option value=""><?php @print($__Context->lang->category);?></option>
											<?php $Context->__idx[1]=0;if(count($__Context->category_list))  foreach($__Context->category_list as $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
											<option value="<?php @print($__Context->val->category_srl);?>" <?php  if($__Context->category==$__Context->val->category_srl){ ?>selected="selected"<?php  } ?>><?php @print(str_repeat("&nbsp;&nbsp;",$__Context->val->depth));?> <?php @print($__Context->val->title);?> <?php  if($__Context->val->document_count){ ?>(<?php @print($__Context->val->document_count);?>)<?php  } ?></option>
											<?php  } ?>
										</select>
										<button type="button" name="go_button" id="go_button" onclick="doChangeCategory(); return false;" class="button">Go</button>
									</span>
									<?php  } ?>
									<?php @print($__Context->lang->title);?>
								</th>
							<?php  }elseif($__Context->val->type == 'regdate'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><a href="<?php @print(getUrl('sort_index','regdate','order_type',$__Context->order_type));?>"><?php @print($__Context->lang->date);?><?php  if($__Context->sort_index=='regdate'){ ?><img src="/xe/modules/board/skins/xe_official/img/common/<?php @print($__Context->order_icon);?>" alt="sort" width="5" height="3" class="sort" /><?php  } ?></a></th>
							<?php  }elseif($__Context->val->type == 'last_update'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><a href="<?php @print(getUrl('sort_index','last_update','order_type',$__Context->order_type));?>"><?php @print($__Context->lang->last_update);?><?php  if($__Context->sort_index=='last_update'){ ?><img src="/xe/modules/board/skins/xe_official/img/common/<?php @print($__Context->order_icon);?>" alt="sort" width="5" height="3" class="sort" /><?php  } ?></a></th>
							<?php  }elseif($__Context->val->type == 'nick_name'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><?php @print($__Context->lang->writer);?></th>
							<?php  }elseif($__Context->val->type == 'user_id'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><?php @print($__Context->lang->user_id);?></th>
							<?php  }elseif($__Context->val->type == 'user_name'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><?php @print($__Context->lang->user_name);?></th>
							<?php  }elseif($__Context->val->type == 'readed_count'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><a href="<?php @print(getUrl('sort_index','readed_count','order_type',$__Context->order_type));?>"><?php @print($__Context->lang->readed_count);?><?php  if($__Context->sort_index=='readed_count'){ ?><img src="/xe/modules/board/skins/xe_official/img/common/<?php @print($__Context->order_icon);?>" alt="sort" width="5" height="3" class="sort" /><?php  } ?></a></th>
							<?php  }elseif($__Context->val->type == 'voted_count'){ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><a href="<?php @print(getUrl('sort_index','voted_count','order_type',$__Context->order_type));?>"><?php @print($__Context->lang->voted_count);?><?php  if($__Context->sort_index=='voted_count'){ ?><img src="/xe/modules/board/skins/xe_official/img/common/<?php @print($__Context->order_icon);?>" alt="sort" width="5" height="3" class="sort" /><?php  } ?></a></th>
							<?php  }elseif($__Context->val->type == 'last_post'){ ?>
							    <?php @$__Context->list_count++;?>														
                                <th scope="col"><a href="<?php @print(getUrl('sort_index','last_update','order_type',$__Context->order_type));?>"><?php @print($__Context->lang->last_post);?><?php  if($__Context->sort_index=='last_update'){ ?><img src="/xe/modules/board/skins/xe_official/img/common/<?php @print($__Context->order_icon);?>" alt="sort" width="5" height="3" class="sort" /><?php  } ?></a></th>
							<?php  } ?>
							
							<?php  }else{ ?>
							    <?php @$__Context->list_count++;?>														
								<th scope="col"><?php @print($__Context->val->name);?></th>
							<?php  } ?>
						<?php  } ?>
						<?php  if($__Context->grant->manager){ ?><th scope="col"><input type="checkbox" onclick="XE.checkboxToggleAll({ doClick:true }); return false;" title="Check All" /></th><?php  } ?>
                    </tr>
			</thead>

			<tbody>
	
				<?php  if(!$__Context->document_list && !$__Context->notice_list){ ?>
				<tr>
					<td colspan="<?php @print($__Context->_col_count);?>">
						<?php @print($__Context->lang->no_documents);?>
					</td>
				</tr>
				<?php  }else{ ?>
			
				<?php $Context->__idx[2]=0;if(count($__Context->notice_list))  foreach($__Context->notice_list as $__Context->no => $__Context->document){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
				<tr class="notice">
					
					<?php $Context->__idx[3]=0;if(count($__Context->list_config))  foreach($__Context->list_config as $__Context->key => $__Context->val){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
	
						
						<?php  if($__Context->val->idx == -1){ ?>
	
							
							<?php  if($__Context->val->type == 'no'){ ?>
								<td class="notice"><?php  if($__Context->document_srl == $__Context->document->document_srl){ ?>&raquo;<?php  }else{ ?><?php @print($__Context->lang->notice);?><?php  } ?></td>
							<?php  }elseif($__Context->val->type == 'title'){ ?>
								<td class="title">
									
									<?php  if($__Context->module_info->use_category == "Y" && $__Context->document->get('category_srl')){ ?>
									<strong class="category"><?php @print($__Context->category_list[$__Context->document->get('category_srl')]->title);?></strong>
									<?php  } ?>
	
									<a href="<?php @print(getUrl('document_srl',$__Context->document->document_srl, 'listStyle', $__Context->listStyle, 'cpage',''));?>"><?php @print($__Context->document->getTitle($__Context->module_info->subject_cut_size));?></a>
									<?php @print($__Context->document->printExtraImages(60*60*$__Context->module_info->duration_new));?>
									
									<?php  if($__Context->document->getCommentCount()){ ?>
										<a href="<?php @print(getUrl('document_srl', $__Context->document->document_srl));?>#comment"><span class="replyNum" title="Replies">[<?php @print($__Context->document->getCommentCount());?>]</span></a>
									<?php  } ?>
	
									<?php  if($__Context->document->getTrackbackCount()){ ?>
										<a href="<?php @print(getUrl('document_srl', $__Context->document->document_srl));?>#trackback"><span class="trackbackNum" title="Trackbacks">[<?php @print($__Context->document->getTrackbackCount());?>]</span></a>
									<?php  } ?>
	
								</td>
							<?php  }elseif($__Context->val->type == 'regdate'){ ?>
								<td class="date"><?php @print($__Context->document->getRegdate('Y-m-d'));?></td>
							<?php  }elseif($__Context->val->type == 'last_update'){ ?>
								<td class="date"><?php @print(zdate($__Context->document->get('last_update'),'Y-m-d H:i'));?></td>
							<?php  }elseif($__Context->val->type == 'nick_name'){ ?>
								<td class="author"><a href="#popup_menu_area" class="member_<?php @print($__Context->document->get('member_srl'));?>" onclick="return false"><?php @print($__Context->document->getNickName());?></a></td>
							<?php  }elseif($__Context->val->type == 'user_id'){ ?>
								<td class="author"><?php @print($__Context->document->getUserID());?></a></td>
							<?php  }elseif($__Context->val->type == 'user_name'){ ?>
								<td class="author"><?php @print($__Context->document->getUserName());?></a></td>
							<?php  }elseif($__Context->val->type == 'readed_count'){ ?>
								<td class="reading"><?php @print($__Context->document->get('readed_count')>0?$__Context->document->get('readed_count'):'&nbsp;');?></td>
							<?php  }elseif($__Context->val->type == 'voted_count'){ ?>
								<td class="recommend"><?php @print($__Context->document->get('voted_count')!=0?$__Context->document->get('voted_count'):'&nbsp;');?></td>
							<?php  }elseif($__Context->val->type == 'last_post'){ ?>
                                <td class="lastReply">
                                <?php  if((int)($__Context->document->get('comment_count'))>0){ ?>
                                    <a href="<?php @print($__Context->document->getPermanentUrl());?>#comment" class="replyAnchor"><?php @print(zdate($__Context->document->get('last_update'),'Y-m-d'));?> <?php @print(zdate($__Context->document->get('last_update'),'H:i'));?></a>
                                    <?php  if($__Context->document->get('last_updater')){ ?>
                                        <sub class="by">by</sub>
                                        <?php @print(htmlspecialchars($__Context->document->get('last_updater')));?>
                                    <?php  } ?>
                                <?php  }else{ ?>
                                    &nbsp;
                                <?php  } ?>
                                </td>
							<?php  } ?>
	
						
						<?php  }else{ ?>
								<td><?php @print($__Context->document->getExtraValueHTML($__Context->val->idx));?>&nbsp;</td>
						<?php  } ?>
					<?php  } ?>
					<?php  if($__Context->grant->manager){ ?>
						<td class="check"><input type="checkbox" name="cart" value="<?php @print($__Context->document->document_srl);?>" title="Check this" onclick="doAddDocumentCart(this)" <?php  if($__Context->document->isCarted()){ ?>checked="checked"<?php  } ?> /></td>
					<?php  } ?>
				</tr>
				<?php  } ?>
	
				
				<?php $Context->__idx[4]=0;if(count($__Context->document_list))  foreach($__Context->document_list as $__Context->no => $__Context->document){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
				<tr class="bg<?php @print(($__Context->no+1)%2+1);?>">
					<td class="title" colspan="<?php @print($__Context->list_count);?>">
						<?php  if($__Context->list_config['thumbnail'] && $__Context->document->thumbnailExists($__Context->module_info->thumbnail_width, $__Context->module_info->thumbnail_height, $__Context->module_info->thumbnail_type)){ ?>
						<a href="<?php @print(getUrl('document_srl',$__Context->document->document_srl,'listStyle',$__Context->listStyle, 'cpage',''));?>" class="thumb"><img src="<?php @print($__Context->document->getThumbnail($__Context->module_info->thumbnail_width, $__Context->module_info->thumbnail_height, $__Context->module_info->thumbnail_type));?>" alt="" /></a>
						<?php  } ?>

                        <?php @$__Context->_meta_display = false;?>
                        <?php $Context->__idx[5]=0;if(count($__Context->list_config))  foreach($__Context->list_config as $__Context->key => $__Context->val){$__Context->__idx[6]=($__Context->__idx[6]+1)%2; $__Context->cycle_idx = $__Context->__idx[6]+1; ?>
        
                            <?php  if($__Context->val->idx == -1){ ?>
                                <?php  if($__Context->val->type == 'title'){ ?>
                                    <?php  if($__Context->_meta_display){ ?></ul><?php @$__Context->_meta_display = false;?><?php  } ?>
                                    <p class="title">
                                        <?php  if($__Context->module_info->use_category == "Y" && $__Context->document->get('category_srl')){ ?><span class="category"><?php @print($__Context->category_list[$__Context->document->get('category_srl')]->title);?></span><?php  } ?>
                                        <a href="<?php @print(getUrl('document_srl',$__Context->document->document_srl, 'listStyle', $__Context->listStyle, 'cpage',''));?>" class="title"><?php @print($__Context->document->getTitle($__Context->module_info->subject_cut_size));?></a>
										<?php @print($__Context->document->printExtraImages(60*60*$__Context->module_info->duration_new));?>
                                        <?php  if($__Context->document->getCommentCount()){ ?>
                                            <a href="<?php @print(getUrl('document_srl', $__Context->document->document_srl));?>#comment"><span class="replyNum" title="Replies">[<?php @print($__Context->document->getCommentCount());?>]</span></a>
                                        <?php  } ?>
                                        <?php  if($__Context->document->getTrackbackCount()){ ?>
                                            <a href="<?php @print(getUrl('document_srl', $__Context->document->document_srl));?>#trackback"><span class="trackbackNum" title="Trackbacks">[<?php @print($__Context->document->getTrackbackCount());?>]</span></a>
                                        <?php  } ?>
                                    </p>
                                <?php  }elseif($__Context->val->type == 'last_post' && $__Context->document->get('comment_count')>0){ ?>
                                    <?php  if($__Context->_meta_display){ ?></ul><?php @$__Context->_meta_display = false;?><?php  } ?>
                                    <p class="title">
                                        <a href="<?php @print($__Context->document->getPermanentUrl());?>#comment" class="replyAnchor"><?php @print(zdate($__Context->document->get('last_update'),'Y-m-d'));?> <?php @print(zdate($__Context->document->get('last_update'),'H:i'));?></a>
                                        <?php  if($__Context->document->get('last_updater')){ ?>
                                            <sub class="by">by</sub>
                                            <?php @print(htmlspecialchars($__Context->document->get('last_updater')));?>
                                        <?php  } ?>
                                    </p>
                                <?php  }elseif($__Context->val->type=='summary'){ ?>
                                    <?php  if($__Context->_meta_display){ ?></ul><?php @$__Context->_meta_display = false;?><?php  } ?>
                                    <p class="summary"><a href="<?php @print(getUrl('document_srl',$__Context->document->document_srl, 'listStyle', $__Context->listStyle, 'cpage',''));?>"><?php @print($__Context->document->getSummary($__Context->module_info->content_cut_size));?></a></p>
                                <?php  }elseif(in_array($__Context->val->type,array('regdate','last_update', 'nick_name','user_id','user_name','readed_count','voted_count'))){ ?>
                                    <?php  if(!$__Context->_meta_display){ ?><ul class="meta"><?php @$__Context->_meta_display = true;?><?php  } ?>
                                    <?php  if($__Context->val->type == 'regdate'){ ?>
                                        <li class="date"><?php @print($__Context->document->getRegdate('Y-m-d'));?></li>
                                    <?php  }elseif($__Context->val->type == 'last_update'){ ?>
                                        <li class="date"><?php @print(zdate($__Context->document->get('last_update'),'Y-m-d H:i'));?></li>
                                    <?php  }elseif($__Context->val->type == 'nick_name'){ ?>
                                        <li class="author"><a href="#popup_menu_area" class="member_<?php @print($__Context->document->get('member_srl'));?>" onclick="return false"><?php @print($__Context->document->getNickName());?></a></li>
                                    <?php  }elseif($__Context->val->type == 'user_id'){ ?>
                                        <li class="author"><?php @print($__Context->document->getUserID());?></a></li>
                                    <?php  }elseif($__Context->val->type == 'user_name'){ ?>
                                        <li class="author"><?php @print($__Context->document->getUserName());?></a></li>
                                    <?php  }elseif($__Context->val->type == 'readed_count'){ ?>
                                        <li class="reading"><?php @print($__Context->lang->readed_count);?> <?php @print($__Context->document->get('readed_count')>0?$__Context->document->get('readed_count'):'0');?></li>
                                    <?php  }elseif($__Context->val->type == 'voted_count'){ ?>
                                        <li class="recommend"><?php @print($__Context->lang->voted_count);?> <?php @print($__Context->document->get('voted_count')!=0?$__Context->document->get('voted_count'):'0');?></li>
                                    <?php  } ?>
                                <?php  } ?>
                            <?php  }else{ ?>
                                <?php  if($__Context->_meta_display){ ?></ul><?php @$__Context->_meta_display = false;?><?php  } ?>
								<p class="title"><span class="category"><?php @print($__Context->val->name);?></span> <?php @print($__Context->document->getExtraValueHTML($__Context->val->idx));?>&nbsp;</p>
                            <?php  } ?>
                        <?php  } ?>
                        <?php  if($__Context->_meta_display){ ?></ul><?php @$__Context->_meta_display = false;?><?php  } ?>
					</td>
					<?php  if($__Context->grant->manager){ ?><td class="check"><input type="checkbox" name="cart" value="<?php @print($__Context->document->document_srl);?>" title="Check this" onclick="doAddDocumentCart(this)" <?php  if($__Context->document->isCarted()){ ?>checked="checked"<?php  } ?> /></td><?php  } ?>
				</tr>
				<?php  } ?>
	
			<?php  } ?>
			</tbody>
        </table>
		
    </fieldset>
</form>
