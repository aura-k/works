<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","manage_checked_document.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/document/tpl/js/document_admin.js--><?php Context::addJsFile("modules/document/tpl/js/document_admin.js", true, ""); ?>
<!--Meta:modules/document/tpl/css/document.css--><?php Context::addCSSFile("modules/document/tpl/css/document.css", true, "all", ""); ?>
<div id="popHeader" class="wide">
    <h3 class="xeAdmin"><?php @print($__Context->lang->cmd_manage_document);?></h3>
</div>

<form action="./" method="get" id="fo_management">
<input type="hidden" name="type" value="" />

<div id="popBody">
    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><label for="textfield1"><?php @print($__Context->lang->checked_count);?> (<?php @print(count($__Context->document_list));?>)</label></div></th>
        <td>
            <?php  if(count($__Context->document_list)){ ?>
            <input type="checkbox" onclick="XE.checkboxToggleAll()" checked="checked"/> <?php @print($__Context->lang->cmd_select);?>
            <ul class="document_list_box">
                <?php $Context->__idx[0]=0;if(count($__Context->document_list))  foreach($__Context->document_list as $__Context->key => $__Context->document){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                <li class="document_list"><input type="checkbox" checked="checked" name="cart" value="<?php @print($__Context->document->document_srl);?>" onclick="doAddDocumentCart(this);"/> <address><?php @print($__Context->document->getNickName());?></address> <span class="document_title"><?php @print($__Context->document->getTitle());?></span></li>
                <?php  } ?>
            </ul>
            <?php  }else{ ?>
                &nbsp;
            <?php  } ?>
        </td>
    </tr>
    <?php  if(count($__Context->document_list)){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->move_target_module);?></div></th>
        <td>
            <input type="hidden" name="target_module" id="target_module" value="" />
            <input type="text" name="_target_module" id="_target_module" class="inputTypeText w300" value="" readonly="readonly" /><a href="<?php @print(getUrl('','module','module','act','dispModuleSelectList','id','target_module','type','single'));?>" onclick="popopen(this.href,'ModuleSelect');return false;" class="button green"><span><?php @print($__Context->lang->cmd_select);?></span></a>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->category);?></div></th>
        <td>
          <select id="target_category" name="target_category" class="w400">
          </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->cmd_send_message);?></div></th>
        <td>
            <textarea name="message_content" class="inputTypeTextArea w400" cols="45" rows="5"></textarea>
        </td>
    </tr>
    <?php  } ?>
    </table>
</div>

<?php  if(count($__Context->document_list)){ ?>
<div id="popFooter">
    <a href="#" onclick="doManageDocument('trash');return false;" class="button red"><span><?php @print($__Context->lang->cmd_trash);?></span></a>
    <a href="#" onclick="doManageDocument('delete');return false;" class="button black strong"><span><?php @print($__Context->lang->cmd_delete);?></span></a>
    <a href="#" onclick="doManageDocument('move');return false;" class="button blue"><span><?php @print($__Context->lang->cmd_move);?></span></a>
    <a href="#" onclick="doManageDocument('copy');return false;" class="button green"><span><?php @print($__Context->lang->cmd_copy);?></span></a>
</div>
<?php  } ?>

<script type="text/javascript">
    jQuery(function() { doGetCategoryFromModule(jQuery('#target_module').get(0)); } );
</script>

</form>
