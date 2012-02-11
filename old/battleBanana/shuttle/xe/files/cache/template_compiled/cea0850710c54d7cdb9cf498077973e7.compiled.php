<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","insert_category.xml");
$oXmlFilter->compile();
?>

<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","delete_category.xml");
$oXmlFilter->compile();
?>

<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/document/tpl/filter/","move_category.xml");
$oXmlFilter->compile();
?>


<?php Context::loadJavascriptPlugin("ui.tree"); ?>

<!--Meta:modules/document/tpl/js/document_category.js--><?php Context::addJsFile("modules/document/tpl/js/document_category.js", true, ""); ?>
<!--Meta:modules/document/tpl/css/document.css--><?php Context::addCSSFile("modules/document/tpl/css/document.css", true, "all", ""); ?>
<?php Context::loadJavascriptPlugin("ui.colorpicker"); ?>
<script type="text/javascript">
    var category_title = "<?php @print($__Context->lang->category);?>";
</script>

<span style="float:right"><a href="#"  onclick="doReloadTreeCategory('<?php @print($__Context->module_info->module_srl);?>');return false;" class="button black"><span><?php @print($__Context->lang->cmd_remake_cache);?></span></a></span>

    <div class="gap1">
        <form id="fo_category" action="./" method="get" onsubmit="return procFilter(this, insert_category)">
        <input type="hidden" name="module_srl" value="<?php @print($__Context->module_info->module_srl);?>" />
        <input type="hidden" name="xml_file" value="<?php @print($__Context->category_xml_file);?>" />
            <div id="category_info"></div>
        </form>
            <div id="menu">
                <ul class="simpleTree">
                    <li class="root" id='tree_0'><span><?php @print($__Context->lang->category);?></span></li>
                </ul>
            </div>
    </div>


<script type="text/javascript">
    var simpleTreeCollection;
    var max_menu_depth = 999;
    var lang_confirm_delete = "<?php @print($__Context->lang->confirm_delete);?>";
    var xml_url = "<?php @print($__Context->category_xml_file);?>";
    doCategoryFormMove();
    Tree(xml_url);
</script>
