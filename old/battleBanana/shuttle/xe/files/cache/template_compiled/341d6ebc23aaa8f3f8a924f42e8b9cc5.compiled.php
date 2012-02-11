<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/addon/tpl/filter/","toggle_activate_addon.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/addon/tpl/js/addon.js--><?php Context::addJsFile("modules/addon/tpl/js/addon.js", true, ""); ?>

<h3 class="xeAdmin"><?php @print($__Context->lang->addon);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>
<div class="infoText"><?php @print(nl2br($__Context->lang->about_addon));?></div>

<!-- xml js filter를 이용하기 위한 데이터 전달용 form -->
<form id="fo_addon" action="./" method="get">
    <input type="hidden" name="addon" value="" />
</form>

<!-- 애드온의 목록 -->
<table cellspacing="0" class="crossTable">
<thead>
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->addon_name);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->version);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->author);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->date);?></div></th>
        <th scope="col" class="wide"><div><?php @print($__Context->lang->installed_path);?></div></th>
        <th scope="col" colspan="2"><div>&nbsp;</div></th>
    </tr>
</thead>

<tbody>
<?php $Context->__idx[0]=0;if(count($__Context->addon_list))  foreach($__Context->addon_list as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
<tr>
    <th scope="row" rowspan="2">
        <div>
            <a href="<?php @print(getUrl('','module','addon','act','dispAddonAdminInfo','selected_addon',$__Context->val->addon));?>" onclick="popopen(this.href,'addon_info');return false"><?php @print($__Context->val->title);?></a> <br />
            (<?php @print($__Context->val->addon);?>)
        </div>
    </th>
    <td><?php @print($__Context->val->version);?></td>
    <td>
        <?php $Context->__idx[1]=0;if(count($__Context->val->author))  foreach($__Context->val->author as $__Context->author){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
        <a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->author->name);?></a>
        <?php  } ?>
    </td>
    <td><?php @print(zdate($__Context->val->date, 'Y-m-d'));?></td>
    <td><?php @print($__Context->val->path);?></td>
    <td><a href="<?php @print(getUrl('','module','addon','act','dispAddonAdminSetup','selected_addon',$__Context->val->addon));?>" onclick="popopen(this.href,'addon_info');return false" title="<?php @print(htmlspecialchars($__Context->lang->cmd_setup));?>" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_setup);?></span></a></td>
    <td>
        <?php  if($__Context->val->activated){ ?>
        <a href="#" onclick="doToggleAddon('<?php @print($__Context->val->addon);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->use));?>" class="buttonSet buttonActive"><span><?php @print($__Context->lang->use);?></span></a>
        <?php  }else{ ?>
        <a href="#" onclick="doToggleAddon('<?php @print($__Context->val->addon);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->notuse));?>" class="buttonSet buttonDisable"><span><?php @print($__Context->lang->notuse);?></span></a>
        <?php  } ?>
    </td>
</tr>
<tr>
    <td colspan="6">
        <?php @print(nl2br($__Context->val->description));?>&nbsp;
    </td>
</tr>
<?php  } ?>
</tbody>

</table>
