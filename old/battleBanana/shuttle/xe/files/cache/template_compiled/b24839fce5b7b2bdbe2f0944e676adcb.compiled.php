<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/module/tpl/./filter/","insert_lang.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/module/tpl/./js/module_admin.js--><?php Context::addJsFile("modules/module/tpl/./js/module_admin.js", true, ""); ?>
<!--Meta:modules/module/tpl/../../common/css/popup.css--><?php Context::addCSSFile("modules/module/tpl/../../common/css/popup.css", true, "all", ""); ?>

<div id="popHeader">
    <h3 class="xeAdmin"><?php @print($__Context->lang->lang_code);?></h3>
</div>

<div id="popBody">
    <table cellspacing="0" class="colTable">
    <col width="50%"/>
    <col width="50%"/>
    <tr>
        <td>
            <table cellspacing="0" class="rowTable">
            <tbody>
            <?php $Context->__idx[0]=0;if(count($__Context->lang_list))  foreach($__Context->lang_list as $__Context->key => $__Context->val){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <tr>
                <td>
                    <div class="fl"><a href="#" onclick="doInsertLangCode('<?php @print($__Context->val->name);?>','<?php @print($__Context->target);?>'); return false;"><?php @print($__Context->val->name);?></a></div>
                    <div class="fr">
                        <a href="<?php @print(getUrl('name',$__Context->val->name));?>" class="buttonSet buttonActive"><span><?php @print($__Context->lang->cmd_select);?></span></a>
                        <a href="#" onclick="if(confirm('<?php @print($__Context->lang->confirm_delete);?>')) doDeleteLang('<?php @print($__Context->val->name);?>','<?php @print($__Context->target);?>'); return false;" class="buttonSet buttonDelete"><span><?php @print($__Context->lang->cmd_select);?></span></a>
                    </div>
                </td>
            </tr>
            <?php  } ?>
            </tbody>
            </table>
        </td>
        <td>
            <form action="./" method="post" onsubmit="return procFilter(this, insert_lang)" id="menu_fo">
                <input type="hidden" name="target" value="<?php @print($__Context->target);?>" />
                <table cellspacing="0" class="rowTable">
                <tbody>
                <tr>
                    <th scope="row"><div><?php @print($__Context->lang->lang_code);?></div></th>
                    <td>
                        <input type="text" name="lang_code" value="<?php @print($__Context->name);?>" class="inputTypeText w200" />
                    </td>
                </tr>
                <?php $Context->__idx[1]=0;if(count($__Context->lang_supported))  foreach($__Context->lang_supported as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
                <tr>
                    <th scope="row"><div><?php @print($__Context->val);?></div></th>
                    <td>
                        <textarea name="<?php @print($__Context->key);?>" class="inputTypeTextArea" style="height:40px; width:90%;"><?php @print($__Context->selected_lang[$__Context->key]);?></textarea>
                    </td>
                </tr>
                <?php  } ?>
                <tr>
                    <th class="button" colspan="2">
                        <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>"></span>
                    </th>
                </tr>
                </tbody>
                </table>
            </form>
        </td>
    </tr>
    </table>
</div>

<script type="text/javascript">
	jQuery(function(){ doFillLangName() });
</script>
