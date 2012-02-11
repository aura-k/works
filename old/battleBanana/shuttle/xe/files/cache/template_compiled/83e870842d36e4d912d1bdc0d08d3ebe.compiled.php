<?php if(!defined("__ZBXE__")) exit();?>
<?php $Context->__idx[0]=0;if(count($__Context->skin_info->colorset))  foreach($__Context->skin_info->colorset as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
    <?php  if($__Context->val->screenshot){ ?>
        <?php @$__Context->_img_info = getImageSize($__Context->val->screenshot); $__Context->_height = $__Context->_img_info[1]+40; $__Context->_width = $__Context->_img_info[0]+20; $__Context->_talign = "center";;?>
    <?php  }else{ ?>
        <?php @$__Context->_width = 200; $__Context->_height = 20; $__Context->_talign = "left";;?>
    <?php  } ?>
<div style="float:left;text-align:<?php @print($__Context->_talign);?>;margin-bottom:1em;width:<?php @print($__Context->_width);?>px;height:<?php @print($__Context->_height);?>px;margin-right:10px;">
    <input type="radio" name="colorset" value="<?php @print($__Context->val->name);?>" id="colorset_<?php @print($__Context->key);?>" <?php  if($__Context->communication_config->colorset==$__Context->val->name){ ?>checked="checked"<?php  } ?>/>  
    <label for="colorset_<?php @print($__Context->key);?>"><?php @print($__Context->val->title);?></label>
    <?php  if($__Context->val->screenshot){ ?>
    <br />
    <img src="<?php @print($__Context->val->screenshot);?>" alt="<?php @print($__Context->val->title);?>" style="border:1px solid #888888;padding:2px;margin:2px;"/>
    <?php  } ?>
</div>
<?php  if($__Context->key%2==1){ ?><div class="clear"></div><?php  } ?>
<?php  } ?>
