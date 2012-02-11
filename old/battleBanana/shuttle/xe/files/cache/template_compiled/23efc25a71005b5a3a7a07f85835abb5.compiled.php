<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/menu/tpl/filter/","delete_menu.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/menu/tpl/js/menu_admin.js--><?php Context::addJsFile("modules/menu/tpl/js/menu_admin.js", true, ""); ?>

<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/menu/tpl/','header.html');
?>


<!-- 삭제를 위한 임시 form -->
<form id="fo_menu" action="./" method="get">
    <input type="hidden" name="menu_srl" value="" />
</form>

<!-- 목록 -->
<table cellspacing="0" class="crossTable">
<caption>Total <?php @print(number_format($__Context->total_count));?>, Page <?php @print(number_format($__Context->page));?>/<?php @print(number_format($__Context->total_page));?></caption>
<thead>
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->no);?></div></th>
        <th scope="col" class="wide"><div><?php @print($__Context->lang->title);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->regdate);?></div></th>
        <th scope="col" colspan="2"><div>&nbsp;</div></th>
    </tr>
</thead>
<tbody>
    <?php $Context->__idx[0]=0;if(count($__Context->menu_list))  foreach($__Context->menu_list as $__Context->no => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
    <tr class="row<?php @print($__Context->cycle_idx);?>">
        <td class="number center"><?php @print($__Context->no);?></td>
        <td class="wide"><?php @print(htmlspecialchars($__Context->val->title));?></td>
        <td class="nowrap"><?php @print(zdate($__Context->val->regdate,"Y-m-d"));?></td>
        <td><a href="<?php @print(getUrl('act','dispMenuAdminManagement','menu_srl',$__Context->val->menu_srl));?>" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_setup);?></span></a></td>
        <td><a href="#" onclick="doDeleteMenu('<?php @print($__Context->val->menu_srl);?>');return false;" title="<?php @print(htmlspecialchars($__Context->lang->cmd_delete));?>" class="buttonSet buttonDelete"><span><?php @print($__Context->lang->cmd_delete);?></span></a></td>
    </tr>
    <?php  } ?>
    <tr>
        <th colspan="5" class="button">
            <a href="<?php @print(getUrl('act','dispMenuAdminInsert','module_srl',''));?>" class="button black strong"><span><?php @print($__Context->lang->cmd_make);?></span></a>
        </th>
    </tr>
</tbody>
</table>

<!-- 페이지 네비게이션 -->
<div class="pagination a1">
    <a href="<?php @print(getUrl('page','','module_srl',''));?>" class="prevEnd"><?php @print($__Context->lang->first_page);?></a> 
    <?php  while($__Context->page_no = $__Context->page_navigation->getNextPage()){ ?>
        <?php  if($__Context->page == $__Context->page_no){ ?>
            <strong><?php @print($__Context->page_no);?></strong> 
        <?php  }else{ ?>
            <a href="<?php @print(getUrl('page',$__Context->page_no,'module_srl',''));?>"><?php @print($__Context->page_no);?></a> 
        <?php  } ?>
    <?php  } ?>
    <a href="<?php @print(getUrl('page',$__Context->page_navigation->last_page,'module_srl',''));?>" class="nextEnd"><?php @print($__Context->lang->last_page);?></a>
</div>
