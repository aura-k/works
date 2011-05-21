<?php if(!defined("__ZBXE__")) exit();?>

<!--Meta:layouts/xe_official/js/xe_official.js--><?php Context::addJsFile("layouts/xe_official/js/xe_official.js", true, ""); ?>

<?php  if($__Context->layout_info->colorset == "white"){ ?>
    <!--Meta:layouts/xe_official/css/white.css--><?php Context::addCSSFile("layouts/xe_official/css/white.css", true, "all", ""); ?>
<?php  }elseif($__Context->layout_info->colorset == "black"){ ?>
    <!--Meta:layouts/xe_official/css/black.css--><?php Context::addCSSFile("layouts/xe_official/css/black.css", true, "all", ""); ?>
<?php  }else{ ?>
    <!--Meta:layouts/xe_official/css/default.css--><?php Context::addCSSFile("layouts/xe_official/css/default.css", true, "all", ""); ?>
<?php  } ?>

<?php  if($__Context->layout_info->background_image){ ?>
<style type="text/css">
    body {  background:#FFFFFF url(<?php @print(getUrl());?><?php @print($__Context->layout_info->background_image);?>) repeat-x left top; }
</style>
<?php  } ?>

<?php  if(!$__Context->layout_info->colorset){ ?>
    <?php @$__Context->layout_info->colorset = "default";?>
<?php  } ?>
<div id="bodyWrap">
    <div id="header">
        <h1><?php  if($__Context->layout_info->logo_image){ ?><a href="<?php @print($__Context->layout_info->index_url);?>"><img src="<?php @print($__Context->layout_info->logo_image);?>" alt="logo" border="0" class="iePngFix" /></a><?php  }else{ ?>&nbsp;<?php  } ?></h1>

        <div id="language">
            <strong title="<?php @print($__Context->lang_type);?>"><?php @print($__Context->lang_supported[$__Context->lang_type]);?></strong> <a href="#selectLang" onclick="showHide('selectLang');return false;"><img src="/xe/layouts/xe_official/images/<?php @print($__Context->layout_info->colorset);?>/buttonLang.gif" alt="Select Language" width="87" height="15" /></a>
            <ul id="selectLang">
                <?php $Context->__idx[7]=0;if(count($__Context->lang_supported))  foreach($__Context->lang_supported as $__Context->key => $__Context->val){$__Context->__idx[8]=($__Context->__idx[8]+1)%2; $__Context->cycle_idx = $__Context->__idx[8]+1; ?><?php  if($__Context->key!= $__Context->lang_type){ ?>
                <li><a href="#" onclick="doChangeLangType('<?php @print($__Context->key);?>');return false;"><?php @print($__Context->val);?></a></li>
                <?php  } ?><?php  } ?>
            </ul>
        </div>

        <!-- GNB -->
        <ul id="gnb">
            <!-- main_menu 1차 시작 -->
            <?php $Context->__idx[8]=0;if(count($__Context->main_menu->list))  foreach($__Context->main_menu->list as $__Context->key => $__Context->val){$__Context->__idx[9]=($__Context->__idx[9]+1)%2; $__Context->cycle_idx = $__Context->__idx[9]+1; ?><?php  if($__Context->val['link']){ ?>
                <?php  if($__Context->val['selected']){ ?>
                    <?php @$__Context->menu_1st = $__Context->val;?>
                <?php  } ?>

                <li <?php  if($__Context->val['selected']){ ?>class="on"<?php  } ?>><a href="<?php @print($__Context->val['href']);?>" <?php  if($__Context->val['open_window']=='Y'){ ?>onclick="window.open(this.href);return false;"<?php  } ?>><?php @print($__Context->val['link']);?></a></li>

            <?php  } ?><?php  } ?>
        </ul>

        <form action="<?php @print(getUrl());?>" method="post" id="isSearch">
            <?php  if($__Context->vid){ ?>
            <input type="hidden" name="vid" value="<?php @print($__Context->vid);?>" />
            <?php  } ?>
            <input type="hidden" name="mid" value="<?php @print($__Context->mid);?>" />
            <input type="hidden" name="act" value="IS" />
            <input type="hidden" name="search_target" value="title_content" />
            <input name="is_keyword" type="text" class="inputText" title="keyword" />

            <input type="image" src="/xe/layouts/xe_official/images/<?php @print($__Context->layout_info->colorset);?>/buttonSearch.gif" alt="<?php @print($__Context->lang->cmd_search);?>" class="submit" />
        </form>

    </div>
    <div id="contentBody">
        <div id="columnLeft">

            <!-- 로그인 위젯 -->
            <img src="/xe/layouts/xe_official/images/blank.gif" class="zbxe_widget_output" widget="login_info" skin="xe_official" colorset="<?php @print($__Context->layout_info->colorset);?>" />

            <!-- 왼쪽 2차 메뉴 -->
            <img src="/xe/layouts/xe_official/images/blank.gif" alt="" class="mask" />
			
            <?php  if($__Context->menu_1st){ ?>
            <ol id="lnb">
                <?php @$__Context->idx = 1;?>
                <?php $Context->__idx[9]=0;if(count($__Context->menu_1st['list']))  foreach($__Context->menu_1st['list'] as $__Context->key => $__Context->val){$__Context->__idx[10]=($__Context->__idx[10]+1)%2; $__Context->cycle_idx = $__Context->__idx[10]+1; ?><?php  if($__Context->val['link']){ ?>
                <li <?php  if($__Context->val['selected']){ ?>class="on"<?php  } ?>><a href="<?php @print($__Context->val['href']);?>" <?php  if($__Context->val['open_window']=='Y'){ ?>onclick="window.open(this.href);return false;"<?php  } ?>><?php @print($__Context->val['link']);?></a>

                    <!-- main_menu 3차 시작 -->
                    <?php  if($__Context->val['list'] && ($__Context->val['expand']=='Y'||$__Context->val['selected']) ){ ?>
                    <ul>
                    <?php $Context->__idx[10]=0;if(count($__Context->val['list']))  foreach($__Context->val['list'] as $__Context->k => $__Context->v){$__Context->__idx[11]=($__Context->__idx[11]+1)%2; $__Context->cycle_idx = $__Context->__idx[11]+1; ?><?php  if($__Context->v['link']){ ?>
                        <li <?php  if($__Context->v['selected']){ ?>class="on"<?php  } ?>><a href="<?php @print($__Context->v['href']);?>" <?php  if($__Context->v['open_window']=='Y'){ ?>onclick="window.open(this.href);return false;"<?php  } ?>><?php @print($__Context->v['link']);?></a></li>
                    <?php  } ?><?php  } ?>
                    </ul>
                    <?php  } ?>
                </li>
                <?php @$__Context->idx++;?>
                <?php  } ?><?php  } ?>
            </ol>
            <?php  } ?>

        </div>
        <div id="columnRight">
            <!-- 컨텐츠 시작 -->
            <?php @print($__Context->content);?>

        </div>
    </div>
    <ul id="footer">
        <li class="first-child">
            <address>
            <a href="http://www.xpressengine.com" onclick="window.open(this.href);return false;"><img src="/xe/layouts/xe_official/images/powerdByXE.gif" alt="Powered By XpressEngine" width="70" height="5" /></a>
            </address>

        </li>

        <?php $Context->__idx[11]=0;if(count($__Context->bottom_menu->list))  foreach($__Context->bottom_menu->list as $__Context->key => $__Context->val){$__Context->__idx[12]=($__Context->__idx[12]+1)%2; $__Context->cycle_idx = $__Context->__idx[12]+1; ?>
        <li><a href="<?php @print($__Context->val['href']);?>" <?php  if($__Context->val['open_window']=='Y'){ ?>onclick="window.open(this.href);return false;"<?php  } ?>><?php @print($__Context->val['link']);?></a></li>
        <?php  } ?>
    </ul>
</div>
