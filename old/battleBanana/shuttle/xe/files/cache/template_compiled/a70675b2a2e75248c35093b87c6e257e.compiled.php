<?php if(!defined("__ZBXE__")) exit();?>
<form action="<?php @print(Context::getRequestUri());?>" method="post" enctype="multipart/form-data" target="hidden_iframe">
<input type="hidden" name="module" value="module" />
<input type="hidden" name="vid" value="<?php @print($__Context->vid);?>" />
<input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
<input type="hidden" name="act" value="procModuleAdminUpdateSkinInfo" />
<input type="hidden" name="module_srl" value="<?php @print($__Context->module_info->module_srl);?>" />
<input type="hidden" name="page" value="<?php @print($__Context->page);?>" />

    <h4 class="xeAdmin"><?php @print($__Context->lang->skin_default_info);?></h4>
    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin);?></div></th>
        <td class="wide" ><?php @print($__Context->skin_info->title);?></td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin_author);?></div></th>
        <td>
            <?php $Context->__idx[0]=0;if(count($__Context->skin_info->author))  foreach($__Context->skin_info->author as $__Context->author){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <?php @print($__Context->author->name);?> <?php  if($__Context->author->homepage || $__Context->author->email_address){ ?>(<?php  if($__Context->author->homepage){ ?><a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->author->homepage);?></a><?php  } ?><?php  if($__Context->author->homepage && $__Context->author->email_address){ ?>, <?php  } ?><?php  if($__Context->author->email_address){ ?><a href="mailto:<?php @print($__Context->author->email_address);?>"><?php @print($__Context->author->email_address);?></a><?php  } ?>)<?php  } ?><br />
            <?php  } ?>
        </td>
    </tr>
<?php  if($__Context->skin_info->homepage){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->homepage);?></div></th>
        <td><a href="<?php @print($__Context->skin_info->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->skin_info->homepage);?></a></td>
    </tr><?php  } ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->date);?></div></th>
        <td><?php @print(zdate($__Context->skin_info->date, 'Y-m-d'));?>&nbsp;</td>
    </tr>
<?php  if($__Context->skin_info->license || $__Context->skin_info->license_link){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->skin_license);?></div></th>
        <td>
            <?php @print(nl2br(trim($__Context->skin_info->license)));?>
        <?php  if($__Context->skin_info->license_link){ ?>
            <p><a href="<?php @print($__Context->skin_info->license_link);?>" onclick="window.close(); return false;"><?php @print($__Context->skin_info->license_link);?></a></p>
        <?php  } ?>
        </td>
    </tr><?php  } ?>
<?php  if($__Context->skin_info->description){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->description);?></div></th>
        <td><?php @print(nl2br(trim($__Context->skin_info->description)));?></td>
    </tr><?php  } ?>
    </table>

    <h4 class="xeAdmin"><?php @print($__Context->lang->extra_vars);?></h4>
    <table cellspacing="0" class="rowTable">

    <tr valign="top">
        <th scope="row"><div><?php @print($__Context->lang->colorset);?></div></th>
        <td class="wide">
            <?php $Context->__idx[1]=0;if(count($__Context->skin_info->colorset))  foreach($__Context->skin_info->colorset as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
            <?php  if($__Context->val->screenshot){ ?>
            <?php @$__Context->_img_info = getImageSize($__Context->val->screenshot); $__Context->_height = $__Context->_img_info[1]+40; $__Context->_width = $__Context->_img_info[0]+20; $__Context->_talign = "center";;?>
            <?php  }else{ ?>
            <?php @$__Context->_width = 200; $__Context->_height = 20; $__Context->_talign = "left";;?>
            <?php  } ?>
            <div style="float:left;text-align:<?php @print($__Context->_talign);?>;margin-bottom:1em;width:<?php @print($__Context->_width);?>px;height:<?php @print($__Context->_height);?>px;margin-right:10px;">
            <input type="radio" name="colorset" value="<?php @print($__Context->val->name);?>" id="colorset_<?php @print($__Context->key);?>" <?php  if($__Context->skin_vars['colorset']->value==$__Context->val->name){ ?>checked="checked"<?php  } ?>/>
            <label for="colorset_<?php @print($__Context->key);?>"><?php @print($__Context->val->title);?></label>
            <?php  if($__Context->val->screenshot){ ?>
            <br />
            <img src="/xe/<?php @print($__Context->val->screenshot);?>" alt="<?php @print($__Context->val->title);?>" style="border:1px solid #888888;padding:2px;margin:2px;"/>
            <?php  } ?>
            </div>
            <?php  } ?>
        </td>
    </tr>


    <?php $Context->__idx[2]=0;if(count($__Context->skin_info->extra_vars))  foreach($__Context->skin_info->extra_vars as $__Context->key => $__Context->val){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>

    <?php  if($__Context->val->group && ((!$__Context->group) || $__Context->group != $__Context->val->group)){ ?>
    <?php @$__Context->group = $__Context->val->group;?>
    </table>
    <h4 class="xeAdmin"><?php @print($__Context->group);?></h4>
    <table cellspacing="0" class="rowTable">
    <?php  } ?>

    <tr>
        <th scope="row"><div><?php @print($__Context->val->title);?></div></th>
        <td class="wide">
            <?php  if($__Context->val->type=="text"){ ?>
                <input type="text" name="<?php @print($__Context->val->name);?>" value="<?php @print(htmlspecialchars($__Context->val->value));?>" id="target<?php @print($__Context->val->name);?>" class="inputTypeText w400" />
                <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','target'.$__Context->val->name));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a>

            <?php  }elseif($__Context->val->type=="textarea"){ ?>
                <textarea name="<?php @print($__Context->val->name);?>" class="inputTypeTextArea w400" id="target<?php @print($__Context->val->name);?>"><?php @print(htmlspecialchars($__Context->val->value));?></textarea>
                <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminLangcode','target','target'.$__Context->val->name));?>" onclick="popopen(this.href);return false;" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_find_langcode);?></span></a>

            <?php  }elseif($__Context->val->type=="select"){ ?>
                <select name="<?php @print($__Context->val->name);?>">
                    <?php $Context->__idx[3]=0;if(count($__Context->val->options))  foreach($__Context->val->options as $__Context->k=>$__Context->v){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
                    <option value="<?php @print($__Context->v->value);?>" <?php  if($__Context->v->value == $__Context->val->value){ ?>selected="selected"<?php  } ?>><?php @print($__Context->v->title);?></option>
                    <?php  } ?>
                </select>

            <?php  }elseif($__Context->val->type=="checkbox"){ ?>
                <?php $Context->__idx[4]=0;if(count($__Context->val->default))  foreach($__Context->val->default as $__Context->k=>$__Context->v){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
                <span>
                    <input type="checkbox" name="<?php @print($__Context->val->name);?>[]" value="<?php @print($__Context->v);?>" id="ch_<?php @print($__Context->key);?>_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->v, $__Context->val->value)){ ?>checked="checked"<?php  } ?> class="checkbox" /> 
                    <label for="ch_<?php @print($__Context->key);?>_<?php @print($__Context->k);?>"><?php @print($__Context->v);?></label>
                </span>
                <?php  } ?>

            <?php  }elseif($__Context->val->type=="radio"){ ?>
                <?php $Context->__idx[5]=0;if(count($__Context->val->default))  foreach($__Context->val->default as $__Context->k=>$__Context->v){$__Context->__idx[6]=($__Context->__idx[6]+1)%2; $__Context->cycle_idx = $__Context->__idx[6]+1; ?>
                <span>
                    <input type="radio" name="<?php @print($__Context->val->name);?>" value="<?php @print($__Context->v);?>" id="ch_<?php @print($__Context->key);?>_<?php @print($__Context->k);?>" <?php  if($__Context->v==$__Context->val->value){ ?>checked="checked"<?php  } ?>/> 
                    <label for="ch_<?php @print($__Context->key);?>_<?php @print($__Context->k);?>"><?php @print($__Context->v);?></label>
                </span>
                <?php  } ?>

            <?php  }elseif($__Context->val->type=="image"){ ?>
                <?php  if($__Context->val->value){ ?>
                <div>
                    <img src="<?php @print($__Context->val->value);?>" /><br />
                    <input type="checkbox" name="del_<?php @print($__Context->val->name);?>" value="Y" id="del_<?php @print($__Context->val->name);?>" class="checkbox" />
                    <label for="del_<?php @print($__Context->val->name);?>"><?php @print($__Context->lang->cmd_delete);?></label>
                </div>
                <?php  } ?>

                <input type="file" name="<?php @print($__Context->val->name);?>" value="" />
            <?php  } ?>

            <?php  if($__Context->val->description){ ?>
            <p><?php @print(nl2br(trim($__Context->val->description)));?></p>
            <?php  } ?>
        </td>
    </tr>
    <?php  } ?>

    <?php  if($__Context->group){ ?>
    </table>
    <table cellspacing="0" class="rowTable">
    <?php  } ?>

    <tr>
        <th colspan="2" class="button">
            <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_registration);?>" accesskey="s" /></span>
        </th>
    </tr>
    </table>

</form>

<iframe name="hidden_iframe" frameborder="0" style="display:none"></iframe>
