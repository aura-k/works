<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_header.html');
?>


<div class="tagCloud">
    <!--<h3 class="tagHeader"><?php @print($__Context->lang->tag);?> (<strong><?php @print(count($__Context->tag_list));?></strong>)</h3>-->
    <ul class="tags">
        <?php $Context->__idx[0]=0;if(count($__Context->tag_list))  foreach($__Context->tag_list as $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>

            <?php  if($__Context->val->count>5){ ?>
                <?php @$__Context->tag_class = "rank1";?>
            <?php  }elseif($__Context->val->count>3){ ?>
                <?php @$__Context->tag_class = "rank2";?>
            <?php  }elseif($__Context->val->count>2){ ?>
                <?php @$__Context->tag_class = "rank3";?>
            <?php  }elseif($__Context->val->count>1){ ?>
                <?php @$__Context->tag_class = "rank4";?>
            <?php  }else{ ?>
                <?php @$__Context->tag_class = "rank5";?>
            <?php  } ?>

            <li <?php  if($__Context->tag_class){ ?>class="<?php @print($__Context->tag_class);?>"<?php  } ?> >
                <?php  if($__Context->layout_info->mid){ ?>
                    <a href="<?php @print(getUrl('','mid',$__Context->layout_info->mid,'search_target','tag','search_keyword',$__Context->val->tag));?>"><?php @print(htmlspecialchars($__Context->val->tag));?></a>
                <?php  }else{ ?>
                    <a href="<?php @print(getUrl('','mid',$__Context->mid,'search_target','tag','search_keyword',$__Context->val->tag));?>"><?php @print(htmlspecialchars($__Context->val->tag));?></a>
                <?php  } ?>
            </li>
        <?php  } ?>
		</ul>
</div>

<div class="boardNavigation">
    <a href="<?php @print(getUrl('act',''));?>" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_back);?></span></a>
</div>

<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_footer.html');
?>

