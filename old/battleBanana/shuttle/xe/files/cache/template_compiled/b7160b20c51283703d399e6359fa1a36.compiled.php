<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/layout/tpl/filter/","delete_layout.xml");
$oXmlFilter->compile();
?>


<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/layout/tpl/','header.html');
?>


<!-- 삭제를 위한 임시 form -->
<form id="fo_layout" action="./" method="get" onsubmit="return procFilter(this, delete_layout)">
    <input type="hidden" name="layout_srl" value="" />
</form>

<!-- 목록 -->
<table cellspacing="0" class="crossTable">
<thead>
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->no);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->layout);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->title);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->regdate);?></div></th>
        <th scope="col" colspan="3"><div>&nbsp;</div></th>
    </tr>
</thead>
<tbody>
    <?php $Context->__idx[0]=0;if(count($__Context->layout_list))  foreach($__Context->layout_list as $__Context->no => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
    <tr class="row<?php @print($__Context->cycle_idx);?>">
        <td class="number center"><?php @print($__Context->no+1);?></td>
        <td>
            <?php @print($__Context->val->layout);?>
            <?php  if($__Context->val->module_srl){ ?>
            (module) 
            <?php  } ?>
        </td>
        <td class="wide"><?php @print(htmlspecialchars($__Context->val->title));?></td>
        <td class="nowrap"><?php @print(zdate($__Context->val->regdate,"Y-m-d"));?></td>
        <td>
            <?php  if(!$__Context->val->module_srl){ ?>
                <a href="<?php @print(getUrl('act','dispLayoutAdminModify','layout_srl',$__Context->val->layout_srl));?>" title="<?php @print(htmlspecialchars($__Context->lang->cmd_layout_management));?>" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_layout_management);?></span></a>
            <?php  }else{ ?>
                &nbsp;
            <?php  } ?>
        </td>
        <td><a href="<?php @print(getUrl('act','dispLayoutAdminEdit','layout_srl',$__Context->val->layout_srl));?>" title="<?php @print(htmlspecialchars($__Context->lang->cmd_layout_edit));?>" class="buttonSet buttonLayoutEditor"><span><?php @print($__Context->lang->cmd_layout_edit);?></span></a></td>
        <td><a href="#" onclick="doDeleteLayout('<?php @print($__Context->val->layout_srl);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->cmd_delete));?>" class="buttonSet buttonDelete"><span><?php @print($__Context->lang->cmd_delete);?></span></a></td>
    </tr>
    <?php  } ?>
    <tr class="row2">
        <th colspan="7" class="button">
            <a href="<?php @print(getUrl('act','dispLayoutAdminInsert','layout_srl',''));?>" class="button black strong"><span><?php @print($__Context->lang->cmd_make);?></span></a>
        </th>
    </tr>
</tbody>
</table>
