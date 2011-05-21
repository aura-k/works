<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/layout/tpl/filter/","update_layout_info.xml");
$oXmlFilter->compile();
?>


<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/layout/tpl/','header.html');
?>


<h3 class="xeAdmin"><?php @print($__Context->selected_layout->layout_title);?></h3>
<div class="header4">
    <ul class="localNavigation">
        <li class="on"><a href="#" onclick="return false;"><?php @print($__Context->lang->cmd_layout_management);?></a></li>
        <li><a href="<?php @print(getUrl('act','dispLayoutAdminEdit'));?>"><?php @print($__Context->lang->cmd_layout_edit);?></a></li>
    </ul>
</div>

<form id="fo_layout" action="./" method="post" enctype="multipart/form-data" target="hidden_iframe">
<input type="hidden" name="module" value="layout" />
<input type="hidden" name="act" value="procLayoutAdminUpdate" />
<input type="hidden" name="layout_srl" value="<?php @print($__Context->layout_srl);?>" />
<input type="hidden" name="layout" value="<?php @print($__Context->selected_layout->layout);?>" />


<table cellspacing="0" class="rowTable">
<tr>
    <th scope="row"><div><?php @print($__Context->lang->layout);?></div></th>
    <td class="wide"><?php @print($__Context->selected_layout->title);?> ver <?php @print($__Context->selected_layout->version);?> (<?php @print($__Context->selected_layout->layout);?>)</td>
</tr>

<?php  if($__Context->selected_layout->path){ ?>
<tr class="row2">
    <th scope="row"><div><?php @print($__Context->lang->path);?></div></th>
    <td><?php @print($__Context->selected_layout->path);?></td>
</tr>
<?php  } ?>

<?php  if($__Context->selected_layout->description){ ?>
<tr class="row2">
    <th scope="row"><div><?php @print($__Context->lang->description);?></div></th>
    <td><?php @print(nl2br(trim($__Context->selected_layout->description)));?></td>
</tr>
<?php  } ?>

<?php  if($__Context->selected_layout->author->homepage){ ?>
<tr>
    <th scope="row"><div><?php @print($__Context->lang->author);?></div></th>
    <td><a href="<?php @print($__Context->selected_layout->author->homepage);?>" onclick="window.open(this.href);return false;" class="blue"><?php @print($__Context->selected_layout->author->name);?></a></td>
</tr>
<?php  } ?>

<tr>
    <th scope="row"><div><?php @print($__Context->lang->header_script);?></div></th>
    <td>
        <textarea name="header_script" class="inputTypeTextArea w400"><?php @print(htmlspecialchars($__Context->selected_layout->header_script));?></textarea>
        <p><?php @print($__Context->lang->about_header_script);?></p>
    </td>
</tr>
<tr class="row2">
    <th scope="row"><div><?php @print($__Context->lang->title);?></div></th>
    <td>
        <input type="text" name="title" value="<?php @print(htmlspecialchars($__Context->selected_layout->layout_title));?>" class="inputTypeText w400" />
        <p><?php @print($__Context->lang->about_title);?></p>
    </td>
</tr>

<?php $Context->__idx[0]=0;if(count($__Context->selected_layout->extra_var))  foreach($__Context->selected_layout->extra_var as $__Context->name => $__Context->var){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>

<?php  if($__Context->var->group && ((!$__Context->group) || $__Context->group != $__Context->var->group)){ ?>
<?php @$__Context->group = $__Context->var->group;?>
<tr><th colspan="2" class="title"><?php @print($__Context->group);?></th></tr>
<?php  } ?>

<tr>
    <th scope="row"><div><?php @print($__Context->var->title);?></div></th>
    <td>
    <?php  if($__Context->var->type == "text"){ ?>
        <input type="text" name="<?php @print($__Context->name);?>" value="<?php @print(htmlspecialchars($__Context->var->value));?>"  class="inputTypeText w400"/>

    <?php  }elseif($__Context->var->type == "textarea"){ ?>
        <textarea name="<?php @print($__Context->name);?>" class="inputTypeTextArea w400"><?php @print(htmlspecialchars($__Context->var->value));?></textarea>

    <?php  }elseif($__Context->var->type=="image"){ ?>

      <?php  if($__Context->var->value){ ?>
      <div>
          <img src="/xe/<?php @print($__Context->var->value);?>" alt="image" /><br />
          <input type="checkbox" name="del_<?php @print($__Context->name);?>" value="Y" id="del_<?php @print($__Context->name);?>" class="checkbox" />
          <label for="del_<?php @print($__Context->name);?>"><?php @print($__Context->lang->cmd_delete);?></label>
      </div>
      <?php  } ?>

      <input type="file" name="<?php @print($__Context->name);?>" value="" />

    <?php  }elseif($__Context->var->type == "select"){ ?>
        <select name="<?php @print($__Context->name);?>">
            <?php $Context->__idx[1]=0;if(count($__Context->var->options))  foreach($__Context->var->options as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
            <option value="<?php @print($__Context->key);?>" <?php  if($__Context->key==$__Context->var->value){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val);?></option>
            <?php  } ?>
        </select>
    <?php  } ?>
        <p><?php @print($__Context->var->description);?></p>
    </td>
</tr>
<?php  } ?>

<?php  if($__Context->var->group){ ?>
<?php  } ?>

<?php $Context->__idx[2]=0;if(count($__Context->selected_layout->menu))  foreach($__Context->selected_layout->menu as $__Context->menu_name => $__Context->menu_info){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
<tr class="row<?php @print($__Context->cycle_idx);?>">
    <th scope="row"><div><?php @print($__Context->menu_info->title);?><br />(<?php @print($__Context->menu_name);?>)</div></th>
    <td class="left tahoma">
        <select name="<?php @print($__Context->menu_name);?>">
            <option value="0">------------------------</option>
            <?php $Context->__idx[3]=0;if(count($__Context->menu_list))  foreach($__Context->menu_list as $__Context->key => $__Context->val){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
            <option value="<?php @print($__Context->val->menu_srl);?>" <?php  if($__Context->val->menu_srl == $__Context->menu_info->menu_srl){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
            <?php  } ?>
        </select>
        <a href="#" onclick="doMenuManagement('<?php @print($__Context->menu_name);?>');return false;" class="button"><span><?php @print($__Context->lang->cmd_management);?></span></a>
    </td>
</tr>
<?php  } ?>
<tr>
    <th scope="row"><div><?php @print($__Context->lang->not_apply_menu);?></div></th>
    <td>
        <input type="checkbox" name="apply_layout" value="Y" />
        <?php @print($__Context->lang->about_not_apply_menu);?>
    </td>
</tr>
<?php  if($__Context->selected_layout->layout_type == "M"){ ?>
<tr>
	<th scope="row"><div><?php @print($__Context->lang->apply_mobile_view);?></div></th>
	<td>
        <input type="checkbox" name="apply_mobile_view" value="Y" />
        <?php @print($__Context->lang->about_apply_mobile_view);?>
    </td>
</tr>
<?php  } ?>
		

<tr class="row2">
    <th colspan="2" class="button">
        <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>" /></span>
        <?php  if($__Context->module=="admin"){ ?>
        <a href="<?php @print(getUrl('act','dispLayoutAdminContent'));?>" class="button"><span><?php @print($__Context->lang->cmd_list);?></span></a>
        <?php  }else{ ?>
        <a href="<?php @print(getUrl('act',''));?>" class="button"><span><?php @print($__Context->lang->cmd_back);?></span></a>
        <?php  } ?>
    </th>
</tr>
</table>
<iframe name="hidden_iframe" frameborder="0" style="display:none"></iframe>
