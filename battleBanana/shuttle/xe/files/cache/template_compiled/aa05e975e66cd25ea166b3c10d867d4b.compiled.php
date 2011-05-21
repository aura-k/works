<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/opage/tpl/js/opage_admin.js--><?php Context::addJsFile("modules/opage/tpl/js/opage_admin.js", true, ""); ?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/opage/tpl/','header.html');
?>


<!-- 정보 -->

<form action="./" method="get" onsubmit="return doChangeCategory(this);" id="fo_list">

<!-- 목록 -->
<table cellspacing="0" class="rowTable">
<caption>Total <?php @print(number_format($__Context->total_count));?>, page <?php @print(number_format($__Context->opage));?>/<?php @print(number_format($__Context->total_opage));?></caption>
<thead>
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->no);?></div></th>
        <th scope="col"><div><input type="checkbox" onclick="XE.checkboxToggleAll(); return false;" /></div></th>
        <th scope="col">
            <div>
                <input type="hidden" name="module" value="<?php @print($__Context->module);?>" />
                <input type="hidden" name="act" value="<?php @print($__Context->act);?>" />
                <select name="module_category_srl">
                    <option value=""><?php @print($__Context->lang->module_category);?></option>
                    <option value="0" <?php  if($__Context->module_category_srl==="0"){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->not_exists);?></option>
                    <?php $Context->__idx[0]=0;if(count($__Context->module_category))  foreach($__Context->module_category as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                    <option value="<?php @print($__Context->key);?>" <?php  if($__Context->module_category_srl==$__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                    <?php  } ?>
                    <option value="">---------</option>
                    <option value="-1"><?php @print($__Context->lang->cmd_management);?></option>
                </select>
                <input type="submit" name="go_button" id="go_button" value="GO" class="buttonTypeGo" />
            </div>
        </th>
        <th scope="col" class="half_wide"><div><?php @print($__Context->lang->mid);?></div></th>
        <th scope="col" class="half_wide"><div><?php @print($__Context->lang->browser_title);?></div></th>
        <th scope="col"><div><?php @print($__Context->lang->regdate);?></div></th>
        <th scope="col" colspan="3"><div>&nbsp;</div></th>
    </tr>
</thead>

<tbody>
    <?php $Context->__idx[1]=0;if(count($__Context->opage_list))  foreach($__Context->opage_list as $__Context->no => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <tr class="row<?php @print($__Context->cycle_idx);?>">
        <td class="number center"><?php @print($__Context->no);?></td>
        <td class="center"><input type="checkbox" name="cart" value="<?php @print($__Context->val->module_srl);?>" /></td>
        <td>
            <?php  if(!$__Context->val->module_category_srl){ ?>
                <?php @print($__Context->lang->not_exists);?>
            <?php  }else{ ?>
                <?php @print($__Context->module_category[$__Context->val->module_category_srl]->title);?>
            <?php  } ?>
        </td>
        <td><?php @print(htmlspecialchars($__Context->val->mid));?></td>
        <td><a href="<?php @print(getUrl('','mid',$__Context->val->mid));?>"  onclick="window.open(this.href); return false;"><?php @print($__Context->val->browser_title);?></a></td>
        <td><?php @print(zdate($__Context->val->regdate,"Y-m-d"));?></td>
        <td><a href="<?php @print(getUrl('act','dispOpageAdminInsert','module_srl',$__Context->val->module_srl));?>" class="buttonSet buttonSetting"><span><?php @print($__Context->lang->cmd_setup);?></span></a></td>
        <td><a href="./?module=module&act=dispModuleAdminCopyModule&module_srl=<?php @print($__Context->val->module_srl);?>" onclick="popopen(this.href);return false;" class="buttonSet buttonCopy"><span><?php @print($__Context->lang->cmd_copy);?></span></a></td>
        <td><a href="<?php @print(getUrl('act','dispOpageAdminDelete','module_srl', $__Context->val->module_srl));?>" class="buttonSet buttonDelete"><span><?php @print($__Context->lang->cmd_delete);?></span></a></td>
    </tr>
    <?php  } ?>
</tbody>
</table>

<!-- 버튼 -->
<div class="clear">
    <div class="fl">
        <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminModuleSetup'));?>" onclick="doCartSetup(this.href); return false;" class="button green"><span><?php @print($__Context->lang->cmd_setup);?></span></a>
        <a href="<?php @print(getUrl('','module','module','act','dispModuleAdminModuleGrantSetup'));?>" onclick="doCartSetup(this.href); return false;" class="button blue"><span><?php @print($__Context->lang->cmd_manage_grant);?></span></a>
    </div>
    <div class="fr ">
        <a href="<?php @print(getUrl('act','dispOpageAdminInsert','module_srl',''));?>" class="button black strong"><span><?php @print($__Context->lang->cmd_make);?></span></a>
    </div>
</div>

</form>

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
