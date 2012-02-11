<?php if(!defined("__ZBXE__")) exit();?>
<div class="aside">
    <div class="categoryBox">
        <h3 class="bottomLine"><a href="<?php @print(getUrl('act','dispAutoinstallAdminIndex','category_srl',''));?>"><?php @print($__Context->lang->view_all_package);?></a> <span>(<?php @print($__Context->tCount);?>)</span></h3>
        <?php @$__Context->_pDepth = 0;;?>

        <ul class="category">
            <?php $Context->__idx[0]=0;if(count($__Context->categories))  foreach($__Context->categories as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <?php  if($__Context->_pDepth > $__Context->val->depth){ ?>
            <?php  for($__Context->i=$__Context->val->depth; $__Context->i<$__Context->_pDepth; $__Context->i++){ ?>
        </ul>
        </li>
            <?php  } ?>
            <?php @$__Context->_pDepth = $__Context->val->depth;?>
            <?php  } ?>
            <li>
                <?php  if(count($__Context->val->children)){ ?>
                <a href="<?php @print(getUrl('','module','admin','act','dispAutoinstallAdminIndex','category_srl',$__Context->val->category_srl,'childrenList',$__Context->val->childrenList));?>"<?php  if($__Context->val->category_srl == $__Context->category_srl){ ?> class="selected"<?php  } ?>><?php @print($__Context->val->title);?></a>
                <?php  }else{ ?>
                <a href="<?php @print(getUrl('','module','admin','act','dispAutoinstallAdminIndex','category_srl',$__Context->val->category_srl,'childrenList',''));?>"<?php  if($__Context->val->category_srl == $__Context->category_srl){ ?> class="selected"<?php  } ?>><?php @print($__Context->val->title);?></a>
                <?php  } ?>
                <?php  if($__Context->val->nPackages){ ?>
                <span>(<?php @print($__Context->val->nPackages);?>)</span>
                <?php  } ?>
            <?php  if(count($__Context->val->children)){ ?>
            <?php @$__Context->_pDepth++;?>
        <ul class="category">
            <?php  }else{ ?>
            </li>
            <?php  } ?>
            <?php  } ?>
            <?php  for($__Context->i=0;$__Context->i<$__Context->_pDepth;$__Context->i++){ ?>
        </ul>
        <?php  } ?>
        </li>
        </ul>
        <div class="searchBox bottomLine">
            <form action="<?php @print(getUrl());?>" method="get">
                <input type="hidden" name="category_srl" value="<?php @print($__Context->category_srl);?>" />
                <input type="hidden" name="module" value="admin" />
                <input type="hidden" name="act" value="dispAutoinstallAdminIndex" />
                <input type="text" name="search_keyword" value="<?php @print(htmlspecialchars($__Context->search_keyword));?>" class="input" />
                <input type="image" src="/xe/modules/autoinstall/tpl/img/btn_search.gif" class="submit" />
            </form>
        </div>
        <br />
        <h3><a href="<?php @print(getUrl('','module','admin','act','dispAutoinstallAdminInstalledPackages'));?>"><?php @print($__Context->lang->view_installed_packages);?></a> <span>(<?php @print($__Context->iCount);?>)</span></h3>

    </div>

</div>
