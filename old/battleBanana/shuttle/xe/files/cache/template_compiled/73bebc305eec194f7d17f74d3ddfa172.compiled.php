<?php if(!defined("__ZBXE__")) exit();?>
<div class="content">
    <?php  if($__Context->act == "dispAutoinstallAdminIndex"){ ?>
    <ul class="listOrder <?php @print($__Context->order_type);?>">
        <?php  if($__Context->order_target=='newest'){ ?>
            <?php  if($__Context->order_type == 'desc'){ ?><?php @$__Context->_order_type = 'asc';?><?php  }else{ ?><?php @$__Context->_order_type = 'desc';?><?php  } ?>
        <?php  }else{ ?>
            <?php @$__Context->_order_type = 'desc';?>
        <?php  } ?>
        <li <?php  if($__Context->order_target=='newest'){ ?>class="arrow"<?php  } ?>><a href="<?php @print(getUrl('order_target','newest','order_type',$__Context->_order_type));?>"><?php @print($__Context->lang->order_newest);?></a></li>
        <?php  if($__Context->order_target=='download'){ ?>
            <?php  if($__Context->order_type == 'desc'){ ?><?php @$__Context->_order_type = 'asc';?><?php  }else{ ?><?php @$__Context->_order_type = 'desc';?><?php  } ?>
        <?php  }else{ ?>
            <?php @$__Context->_order_type = 'desc';?>
        <?php  } ?>
        <li <?php  if($__Context->order_target=='download'){ ?>class="arrow"<?php  } ?>><a href="<?php @print(getUrl('order_target','download','order_type',$__Context->_order_type));?>"><?php @print($__Context->lang->order_download);?></a></li>
        <?php  if($__Context->order_target=='popular'){ ?>
            <?php  if($__Context->order_type == 'desc'){ ?><?php @$__Context->_order_type = 'asc';?><?php  }else{ ?><?php @$__Context->_order_type = 'desc';?><?php  } ?>
        <?php  }else{ ?>
            <?php @$__Context->_order_type = 'desc';?>
        <?php  } ?>
        <li <?php  if($__Context->order_target=='popular'){ ?>class="arrow"<?php  } ?>><a href="<?php @print(getUrl('order_target','popular','order_type',$__Context->_order_type));?>"><?php @print($__Context->lang->order_popular);?></a></li>
    </ul>
    <?php  } ?>

    <table class="updateList" border="1" cellspacing="0">
    <col width="120" /><col />
    <?php $Context->__idx[0]=0;if(count($__Context->item_list))  foreach($__Context->item_list as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
    <tr>    
        <?php @$__Context->target_url = $__Context->original_site."?mid=download&package_srl=".$__Context->val->package_srl;;?>
        <th><a href="<?php @print($__Context->target_url);?>"><img src="<?php @print(str_replace('./', $__Context->uri, $__Context->val->item_screenshot_url));?>" width="100" height="100" alt="" /></a></th>
        <td>
			<div class="title">
				<h3>
					<?php  if($__Context->val->category_srl){ ?>
					<a href="<?php @print(getUrl('category_srl',$__Context->val->category_srl));?>">[<?php @print($__Context->categories[$__Context->val->category_srl]->title);?>]</a>
					<?php  } ?>
					<a href="<?php @print($__Context->target_url);?>"><?php @print(htmlspecialchars($__Context->val->title));?> ver. <?php @print(htmlspecialchars($__Context->val->item_version));?></a>
				</h3>
					<?php  if($__Context->val->current_version){ ?>
					<p><?php @print($__Context->lang->current_version);?> : <?php @print($__Context->val->current_version);?> 
						<?php  if($__Context->val->deps){ ?>
					<br />	
						<?php @print($__Context->lang->dependant_list);?>	:
						<?php $Context->__idx[1]=0;if(count($__Context->val->deps))  foreach($__Context->val->deps as $__Context->package_srl){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
						<?php @print($__Context->installed[$__Context->package_srl]->title);?>. 
						<?php  } ?>
						<?php  } ?>
					</p>
						<div class="buttons">
						<?php  if($__Context->val->avail_remove){ ?>
						<a href="<?php @print(getUrl('act','dispAutoinstallAdminUninstall','package_srl',$__Context->val->package_srl));?>" class="button red strong"><span><?php @print($__Context->lang->cmd_delete);?></span></a>
						<?php  } ?>
						<?php  if($__Context->val->need_update == 'Y'){ ?>
						<a href="<?php @print(getUrl('act','dispAutoinstallAdminInstall','package_srl',$__Context->val->package_srl));?>" class="button"><span><?php @print($__Context->lang->update);?></span></a>
						<?php  } ?>
						</div>
					<?php  }else{ ?>
					<div class="buttons">
					<a href="<?php @print(getUrl('act','dispAutoinstallAdminInstall','package_srl',$__Context->val->package_srl));?>" class="button"><span><?php @print($__Context->lang->install);?></span></a>
					</div>
					<?php  } ?>
			</div>
			<div class="info">
				<p class="desc"><?php @print(cut_str(htmlspecialchars($__Context->val->package_description),200));?></p>
				<p class="meta">
					<span class="reputation">
						<?php  for($__Context->i=0;$__Context->i<5;$__Context->i++){ ?>
							<?php  if($__Context->i<$__Context->val->package_star){ ?>
							<img src="/xe/modules/autoinstall/tpl/img/starOn.gif" alt="" />
							<?php  }else{ ?>
							<img src="/xe/modules/autoinstall/tpl/img/starOff.gif" alt="" />
							<?php  } ?>
						<?php  } ?>
						<span><?php @print(sprintf("%0.1f",$__Context->val->package_voted/$__Context->val->package_voter*2));?>/<?php @print(number_format($__Context->val->package_voter));?></span>
					</span>
					<span class="lastUpdate"><?php @print($__Context->lang->package_update);?> <?php @print(zdate($__Context->val->item_regdate, "Y-m-d H:i"));?></span>
					<span class="download"><?php @print($__Context->lang->package_downloaded_count);?> : <?php @print(number_format($__Context->val->package_downloaded));?></span>
				</p>
			</div>
        </td>
    </tr>
    <?php  } ?>
    </table>

    <div class="pagination a1">
        <a href="<?php @print(getUrl('page',''));?>" class="prevEnd"><?php @print($__Context->lang->first_page);?></a> 
        <?php  while($__Context->page_no = $__Context->page_navigation->getNextPage()){ ?>
            <?php  if($__Context->page == $__Context->page_no){ ?>
                <strong><?php @print($__Context->page_no);?></strong> 
            <?php  }else{ ?>
                <a href="<?php @print(getUrl('page',$__Context->page_no));?>"><?php @print($__Context->page_no);?></a>
            <?php  } ?>
        <?php  } ?>
        <a href="<?php @print(getUrl('page',$__Context->page_navigation->last_page));?>" class="nextEnd"><?php @print($__Context->lang->last_page);?></a>
    </div>
</div>
