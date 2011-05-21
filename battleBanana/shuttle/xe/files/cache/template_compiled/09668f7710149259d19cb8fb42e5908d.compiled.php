<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/member/skins/default/','common_header.html');
?>


    <h3><?php @print($__Context->lang->cmd_view_member_info);?></h3>

    <table cellspacing="0" class="rowTable">
    <tr><th colspan="2" class="title"><div><?php @print($__Context->lang->member_default_info);?></div></th></tr>
    <tr>
        <th><div><?php @print($__Context->lang->user_name);?></div></th>
        <td class="wide"><?php @print(htmlspecialchars($__Context->member_info->user_name));?></td>
    </tr>
    <tr>
        <th><div><?php @print($__Context->lang->nick_name);?></div></th>
        <td><?php @print(htmlspecialchars($__Context->member_info->nick_name));?></td>
    </tr>
    <?php  if($__Context->member_info->profile_image->src){ ?>
    <tr>
        <th><div><?php @print($__Context->lang->profile_image);?></div></th>
        <td><img src="<?php @print($__Context->member_info->profile_image->src);?>" border="0" alt="profile_image" /></td>
    </tr>
    <?php  } ?>
    <?php  if($__Context->member_info->image_name->src){ ?>
    <tr>
        <th><div><?php @print($__Context->lang->image_name);?></div></th>
        <td><img src="<?php @print($__Context->member_info->image_name->src);?>" border="0" alt="image_name" /></td>
    </tr>
    <?php  } ?>
    <?php  if($__Context->member_info->image_mark->src){ ?>
    <tr>
        <th><div><?php @print($__Context->lang->image_mark);?></div></th>
        <td><img src="<?php @print($__Context->member_info->image_mark->src);?>" border="0" alt="image_mark" /></td>
    </tr>
    <?php  } ?>
    <tr>
        <th><div><?php @print($__Context->lang->homepage);?></div></th>
        <td><?php  if($__Context->member_info->homepage){ ?><a href="<?php @print(htmlspecialchars($__Context->member_info->homepage));?>" onclick="window.open(this.href); return false;"><?php @print(htmlspecialchars($__Context->member_info->homepage));?></a><?php  }else{ ?>&nbsp;<?php  } ?></td>
    </tr>
    <tr>
        <th><div><?php @print($__Context->lang->blog);?></div></th>
        <td><?php  if($__Context->member_info->blog){ ?><a href="<?php @print(htmlspecialchars($__Context->member_info->blog));?>" onclick="window.open(this.href); return false;"><?php @print(htmlspecialchars($__Context->member_info->blog));?></a><?php  }else{ ?>&nbsp;<?php  } ?></td>
    </tr>
    <tr>
        <th><div><?php @print($__Context->lang->birthday);?></div></th>
        <td><?php  if($__Context->member_info->birthday){ ?><?php @print(zdate($__Context->member_info->birthday,"Y-m-d"));?><?php  }else{ ?>&nbsp;<?php  } ?></td>
    </tr>
    <?php  if($__Context->member_info->signature){ ?>
    <tr>
        <th><div><?php @print($__Context->lang->signature);?></div></th>
        <td><?php @print($__Context->member_info->signature);?></td>
    </tr>
    <?php  } ?>
    <tr>
        <th><div><?php @print($__Context->lang->group);?></div></th>
        <td><?php $Context->__idx[0]=0;if(count($__Context->member_info->group_list))  foreach($__Context->member_info->group_list as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?><?php @print($__Context->val);?> <?php  } ?></td>
    </tr>
    <tr>
        <th><div><?php @print($__Context->lang->signup_date);?></div></th>
        <td><?php @print(zdate($__Context->member_info->regdate,"Y-m-d H:i"));?></td>
    </tr>

    <?php  if($__Context->member_info->member_srl == $__Context->logged_info->member_srl || $__Context->logged_info->is_admin == 'Y' ){ ?>
    <tr>
        <th><div><?php @print($__Context->lang->last_login);?></div></th>
        <td><?php @print(zdate($__Context->member_info->last_login,"Y-m-d H:i"));?></td>
    </tr>
    <?php  } ?>

    <?php  if($__Context->member_config->enable_openid=="Y"){ ?>
    <?php  if(sizeof($__Context->openids) > 0){ ?>
    <tr>
        <th colspan="2" class="title"><div><?php @print($__Context->lang->openid);?> </div></th>
    </tr>
    <?php $Context->__idx[1]=0;if(count($__Context->openids))  foreach($__Context->openids as $__Context->openid){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <tr>
        <th><div><?php @print($__Context->lang->openid);?></div></th>
        <td> <a href="<?php @print($__Context->openid->bookmarklet);?>"><?php @print($__Context->openid->openid);?></a> </td>
    </tr>
    <?php  } ?>
    <?php  } ?>
    <?php  } ?>

    <?php  if($__Context->extend_form_list){ ?>
    <tr>
        <th class="title" colspan="2"><div><?php @print($__Context->lang->member_extend_info);?></div></th>
    </tr>
    <?php @$__Context->dummy_chk = 0;?>
    <?php $Context->__idx[2]=0;if(count($__Context->extend_form_list))  foreach($__Context->extend_form_list as $__Context->key => $__Context->val){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
    <tr <?php  if($__Context->dummy_chk==0){ ?>class="first-child" <?php @$__Context->dummy_chk = 1;;?><?php  } ?>>
        <th>
            <div>
                <?php @print(htmlspecialchars($__Context->val->column_title));?>
            </div>
        </th>
        <td>
            <?php  if($__Context->val->is_private){ ?>
                <span class="privateItem"><?php @print($__Context->lang->private);?></span>
            <?php  }else{ ?> 
                <?php  if($__Context->val->column_type=='tel' && $__Context->val->value[0] && $__Context->val->value[1] && $__Context->val->value[2]){ ?>
                    <?php @print(htmlspecialchars($__Context->val->value[0]));?> 
                        <?php  if($__Context->val->value[1]){ ?>-<?php  } ?>
                    <?php @print(htmlspecialchars($__Context->val->value[1]));?> 
                        <?php  if($__Context->val->value[2]){ ?>-<?php  } ?>
                    <?php @print(htmlspecialchars($__Context->val->value[2]));?>
                <?php  }elseif($__Context->val->column_type=='kr_zip'){ ?>
                    <?php @print(htmlspecialchars($__Context->val->value[0]));?><?php  if($__Context->val->value[1]&&$__Context->val->value[0]){ ?><br /><?php  } ?><?php @print(htmlspecialchars($__Context->val->value[1]));?>
                <?php  }elseif($__Context->val->column_type=='checkbox' && is_array($__Context->val->value)){ ?>
                    <?php @print(htmlspecialchars(implode(", ",$__Context->val->value)));?>&nbsp;
                <?php  }elseif($__Context->val->column_type=='date' && $__Context->val->value){ ?>
                    <?php @print(zdate($__Context->val->value, "Y-m-d"));?>&nbsp;
                <?php  }else{ ?>
                    <?php @print(nl2br(htmlspecialchars($__Context->val->value)));?>&nbsp;
                <?php  } ?>
            <?php  } ?> 
        </td>
    </tr>
    <?php  } ?>
    <?php  } ?>

    <tr>
        <th colspan="2" class="button">
            <?php  if($__Context->member_info->member_srl == $__Context->logged_info->member_srl){ ?>
            <a href="<?php @print(getUrl('act','dispMemberModifyInfo','member_srl',''));?>" class="button black strong"><span><?php @print($__Context->lang->cmd_modify_member_info);?></span></a>
                <?php  if($__Context->logged_info->is_openid){ ?>
                    <a href="<?php @print(getUrl('act','dispMemberOpenIDLeave','member_srl',''));?>" class="button red"><span><?php @print($__Context->lang->cmd_leave);?></span></a>
                <?php  }else{ ?>
                    <a href="<?php @print(getUrl('act','dispMemberModifyPassword','member_srl',''));?>" class="button green"><span><?php @print($__Context->lang->cmd_modify_member_password);?></span></a>
                    <a href="<?php @print(getUrl('act','dispMemberLeave','member_srl',''));?>" class="button red"><span><?php @print($__Context->lang->cmd_leave);?></span></a>
                <?php  } ?>
            <?php  } ?>
            <a href="<?php @print(getUrl('act','','member_srl',''));?>" class="button"><span><?php @print($__Context->lang->cmd_back);?></span></a>
    </tr>
    </table>

<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/member/skins/default/','common_footer.html');
?>

