<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/module/tpl/js/module_admin.js--><?php Context::addJsFile("modules/module/tpl/js/module_admin.js", true, ""); ?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/module/tpl/filter/","copy_module.xml");
$oXmlFilter->compile();
?>


<div id="popHeader" class="wide">
    <h3 class="xeAdmin"><?php @print($__Context->lang->module_copy);?></h3>
</div>

<form action="./" method="post" onsubmit="return procFilter(this, copy_module)" >
<input type="hidden" name="module_srl" value="<?php @print($__Context->module_info->module_srl);?>" />

<div id="popBody">

    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->module);?></div></th>
        <td class="wide"><?php @print($__Context->module_info->module);?></td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->mid);?></div></th>
        <td><?php @print($__Context->module_info->mid);?></td>
    </tr>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->browser_title);?></div></th>
        <td><?php @print($__Context->module_info->browser_title);?></td>
    </tr>
    </table>


    <table cellspacing="0" class="rowTable">
    <tr>
        <th scope="col"><div><?php @print($__Context->lang->mid);?><div></th>
        <th scope="col"><div><?php @print($__Context->lang->browser_title);?><div></th>
    </tr>
    <tr class="row2">
        <td><input type="text" name="mid_1" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_1" class="inputTypeText w200" /></td>
    </tr>
    <tr>
        <td><input type="text" name="mid_2" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_2" class="inputTypeText w200" /></td>
    </tr>
    <tr class="row2">
        <td><input type="text" name="mid_3" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_3" class="inputTypeText w200" /></td>
    </tr>
    <tr>
        <td><input type="text" name="mid_4" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_4" class="inputTypeText w200" /></td>
    </tr>
    <tr class="row2">
        <td><input type="text" name="mid_5" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_5" class="inputTypeText w200" /></td>
    </tr>
    <tr>
        <td><input type="text" name="mid_6" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_6" class="inputTypeText w200" /></td>
    </tr>
    <tr class="row2">
        <td><input type="text" name="mid_7" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_7" class="inputTypeText w200" /></td>
    </tr>
    <tr>
        <td><input type="text" name="mid_8" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_8" class="inputTypeText w200" /></td>
    </tr>
    <tr class="row2">
        <td><input type="text" name="mid_9" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_9" class="inputTypeText w200" /></td>
    </tr>
    <tr>
        <td><input type="text" name="mid_10" class="inputTypeText w200" /></td>
        <td><input type="text" name="browser_title_10" class="inputTypeText w200" /></td>
    </tr>
    </table>

</div>

<div id="popFooter">
    <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>" /></span>
</div>

</form>
