<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_header.html');
?>

<?php  if($__Context->oDocument->isExists() && $__Context->module_info->default_style != 'blog'){ ?>
<div class="viewDocument">
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','view_document.html');
?>

</div>
<?php  } ?>

<?php  if($__Context->module_info->default_style == 'webzine'){ ?>
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_style.webzine.html');
?>

<?php  }elseif($__Context->module_info->default_style == 'gallery'){ ?>
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_style.gallery.html');
?>

<?php  }elseif($__Context->module_info->default_style == 'forum'){ ?>
    
<?php  }elseif($__Context->module_info->default_style == 'blog'){ ?>
    
<?php  }else{ ?>
    <?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_style.list.html');
?>

<?php  } ?>

<div class="boardNavigation">

    <div class="buttonLeft">
        <?php  if($__Context->module_info->default_style != 'blog'){ ?>
        <a href="<?php @print(getUrl('','mid',$__Context->mid,'page',$__Context->page,'document_srl','','listStyle',$__Context->listStyle));?>" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_list);?></span></a>
        <?php  } ?>
    </div>

    <div class="buttonRight">
        <a href="<?php @print(getUrl('act','dispBoardWrite','document_srl',''));?>" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_write);?></span></a>
        <?php  if($__Context->grant->manager){ ?>
            <a href="<?php @print(getUrl('','module','document','act','dispDocumentManageDocument'));?>" onclick="popopen(this.href,'manageDocument'); return false;" class="buttonOfficial"><span><?php @print($__Context->lang->cmd_manage_document);?></span></a>
        <?php  } ?>
    </div>

    <div class="pagination">
        <a href="<?php @print(getUrl('page','','document_srl','','division',$__Context->division,'last_division',$__Context->last_division));?>" class="prevEnd"><?php @print($__Context->lang->first_page);?></a> 
        <?php  while($__Context->page_no = $__Context->page_navigation->getNextPage()){ ?>
            <?php  if($__Context->page == $__Context->page_no){ ?>
                <strong><?php @print($__Context->page_no);?></strong> 
            <?php  }else{ ?>
                <a href="<?php @print(getUrl('page',$__Context->page_no,'document_srl','','division',$__Context->division,'last_division',$__Context->last_division));?>"><?php @print($__Context->page_no);?></a>
            <?php  } ?>
        <?php  } ?>
        <a href="<?php @print(getUrl('page',$__Context->page_navigation->last_page,'document_srl','','division',$__Context->division,'last_division',$__Context->last_division));?>" class="nextEnd"><?php @print($__Context->lang->last_page);?></a>
    </div>

</div>

<?php  if($__Context->grant->view && $__Context->module_info->default_style != 'blog'){ ?>
<form action="<?php @print(getUrl());?>" method="get" onsubmit="return procFilter(this, search)" id="fo_search" class="boardSearchForm">
    <fieldset>
        <legend>Board Search</legend>
        <input type="hidden" name="vid" value="<?php @print($__Context->vid);?>" />
        <input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
        <input type="hidden" name="category" value="<?php @print($__Context->category);?>" />
        <input type="text" name="search_keyword" value="<?php @print(htmlspecialchars($__Context->search_keyword));?>" class="inputText" accesskey="S" title="<?php @print($__Context->lang->cmd_search);?>" />
        <select name="search_target">
            <?php $Context->__idx[0]=0;if(count($__Context->search_option))  foreach($__Context->search_option as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <option value="<?php @print($__Context->key);?>" <?php  if($__Context->search_target==$__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val);?></option>
            <?php  } ?>
        </select>
        <?php  if($__Context->last_division){ ?>
            <a href="<?php @print(getUrl('page',1,'document_srl','','division',$__Context->last_division,'last_division',''));?>" class="button"><span><?php @print($__Context->lang->cmd_search_next);?></span></a>
        <?php  } ?>
        <span class="buttonOfficial"><button type="submit" onclick="xGetElementById('fo_search').submit();return false;"><?php @print($__Context->lang->cmd_search);?></button></span>
		<ul class="infoEtc">
			<li class="contributors"><a href="<?php @print(getUrl('','module','module','act','dispModuleSkinInfo','selected_module',$__Context->module_info->module, 'skin', $__Context->module_info->skin));?>" onclick="popopen(this.href,'skinInfo'); return false;" title="Contributors"><span>Contributors</span></a></li>
			<li class="tag"><a href="<?php @print(getUrl('act','dispBoardTagList'));?>" title="Tag List"><span>Tag List</span></a></li>
		</ul>
    </fieldset>
</form>
<?php  } ?>

<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/skins/xe_official/','_footer.html');
?>

