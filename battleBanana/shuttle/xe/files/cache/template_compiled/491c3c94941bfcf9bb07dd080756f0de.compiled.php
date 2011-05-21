<?php if(!defined("__ZBXE__")) exit();?>
<?php  if($__Context->oDocument->getTrackbackCount()){ ?>
<hr class="hr" />
<div class="feedbackList" id="trackback">

	<h3 class="feedbackHeader">
		<?php  if($__Context->oDocument->allowTrackback() && $__Context->oDocument->getTrackbackCount() ){ ?>
			<?php @print($__Context->lang->trackback);?> <em>'<?php @print($__Context->oDocument->getTrackbackCount());?>'</em>
		<?php  } ?>
	</h3>
    <p class="trackbackURL"><a href="<?php @print($__Context->oDocument->getTrackbackUrl());?>" onclick="return false;"><?php @print($__Context->oDocument->getTrackbackUrl());?></a></p>

	<div class="trackbackList">
	
		<?php  if($__Context->oDocument->getTrackbackCount()){ ?>
			<?php $Context->__idx[2]=0;if(count($__Context->oDocument->getTrackbacks()))  foreach($__Context->oDocument->getTrackbacks() as $__Context->key => $__Context->val){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
			<div class="item" id="trackback_<?php @print($__Context->val->trackback_srl);?>">
				<div class="itemAside">
					<p class="meta">
						<?php @print(zdate($__Context->val->regdate, "Y.m.d H:i"));?>
						<?php  if($__Context->grant->manager){ ?>
						<br /><?php @print($__Context->val->ipaddress);?>
						<?php  } ?>
					</p>
				</div>
				<div class="itemContent">
					<h4 class="header"><a href="<?php @print($__Context->val->url);?>" onclick="winopen(this.href);return false;"><?php @print(htmlspecialchars($__Context->val->title));?> - <?php @print(htmlspecialchars($__Context->val->blog_name));?></a></h4>
					<p><?php @print($__Context->val->excerpt);?> <?php  if($__Context->grant->manager){ ?><a href="<?php @print(getUrl('act','dispBoardDeleteTrackback','trackback_srl',$__Context->val->trackback_srl));?>" class="delete"><span><?php @print($__Context->lang->cmd_delete);?></span></a><?php  } ?></p>
				</div>
			</div>
			<?php  } ?>
		<?php  } ?>
	
	</div>
	
</div>
<?php  } ?>
