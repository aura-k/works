<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/rss/tpl/filter/","insert_rss_module_config.xml");
$oXmlFilter->compile();
?>


<form action="./" method="post" onsubmit="return procFilter(this, insert_rss_module_config)">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->rss_config->module_srl?$__Context->rss_config->module_srl:$__Context->module_srls);?>" />

    <h4 class="xeAdmin"><?php @print($__Context->lang->open_rss);?></h4>
    <p class="summary"><?php @print($__Context->lang->about_open_rss);?></p>
    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->open_rss);?></div></th>
        <td class="wide">
            <select name="open_rss" class="w200">
                <?php $Context->__idx[15]=0;if(count($__Context->lang->open_rss_types))  foreach($__Context->lang->open_rss_types as $__Context->key=>$__Context->val){$__Context->__idx[16]=($__Context->__idx[16]+1)%2; $__Context->cycle_idx = $__Context->__idx[16]+1; ?>
                <option value="<?php @print($__Context->key);?>" <?php  if(!$__Context->rss_config->open_rss && $__Context->key=='N'){ ?>selected="selected"<?php  }elseif($__Context->rss_config->open_rss==$__Context->key){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val);?></option>
                <?php  } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->open_feed_to_total);?></div></th>
        <td class="wide">
            <select name="open_total_feed" class="w200">
                <option value="N" <?php  if(!$__Context->rss_config->open_total_feed || $__Context->rss_config->open_total_feed == 'N'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->use);?></option>
                <option value="T_N" <?php  if($__Context->rss_config->open_total_feed == 'T_N'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->lang->notuse);?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->description);?></div></th>
        <td class="wide">
            <textarea name="feed_description" class="inputTypeTextArea"><?php @print($__Context->rss_config->feed_description);?></textarea>
            <p><?php @print($__Context->lang->about_feed_description);?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->feed_copyright);?></div></th>
        <td class="wide">
            <input type="text" class="inputTypeText" name="feed_copyright" value="<?php @print(htmlspecialchars($__Context->rss_config->feed_copyright));?>" />
            <p><?php @print($__Context->lang->about_feed_copyright);?><br /><?php @print($__Context->lang->about_part_feed_copyright);?></p>
        </td>
    </tr>
    <tr class="row2">
        <th class="button" colspan="2"><span class="button strong black"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>"/></span></th>
    </tr>
    </table>

</form>
