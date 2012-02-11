<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.updateModule";
$output->action = "update";
if(isset($args->site_srl)) { unset($_output); $_output = $this->checkFilter("site_srl",$args->site_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->module_srl)) { unset($_output); $_output = $this->checkFilter("module_srl",$args->module_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->site_srl)) $args->site_srl = "0";
if(!isset($args->site_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->site_srl?$lang->site_srl:'site_srl'));
if(!isset($args->module_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->module_srl?$lang->module_srl:'module_srl'));
$output->column_type["module_srl"] = "number";
$output->column_type["module"] = "varchar";
$output->column_type["module_category_srl"] = "number";
$output->column_type["layout_srl"] = "number";
$output->column_type["use_mobile"] = "char";
$output->column_type["mlayout_srl"] = "number";
$output->column_type["menu_srl"] = "number";
$output->column_type["site_srl"] = "number";
$output->column_type["mid"] = "varchar";
$output->column_type["skin"] = "varchar";
$output->column_type["mskin"] = "varchar";
$output->column_type["browser_title"] = "varchar";
$output->column_type["description"] = "text";
$output->column_type["is_default"] = "char";
$output->column_type["content"] = "bigtext";
$output->column_type["mcontent"] = "bigtext";
$output->column_type["open_rss"] = "char";
$output->column_type["header_text"] = "text";
$output->column_type["footer_text"] = "text";
$output->column_type["regdate"] = "date";
$output->tables = array( "modules"=>"modules", );
$output->_tables = array( "modules"=>"modules", );
$output->columns = array ( array("name"=>"module","alias"=>"","value"=>$args->module),
array("name"=>"module_category_srl","alias"=>"","value"=>$args->module_category_srl),
array("name"=>"layout_srl","alias"=>"","value"=>$args->layout_srl),
array("name"=>"skin","alias"=>"","value"=>$args->skin),
array("name"=>"mskin","alias"=>"","value"=>$args->mskin),
array("name"=>"menu_srl","alias"=>"","value"=>$args->menu_srl),
array("name"=>"mid","alias"=>"","value"=>$args->mid),
array("name"=>"browser_title","alias"=>"","value"=>$args->browser_title),
array("name"=>"description","alias"=>"","value"=>$args->description?$args->description:""),
array("name"=>"is_default","alias"=>"","value"=>$args->is_default?$args->is_default:"N"),
array("name"=>"content","alias"=>"","value"=>$args->content),
array("name"=>"mcontent","alias"=>"","value"=>$args->mcontent),
array("name"=>"open_rss","alias"=>"","value"=>$args->open_rss?$args->open_rss:"Y"),
array("name"=>"header_text","alias"=>"","value"=>$args->header_text?$args->header_text:""),
array("name"=>"footer_text","alias"=>"","value"=>$args->footer_text?$args->footer_text:""),
array("name"=>"mlayout_srl","alias"=>"","value"=>$args->mlayout_srl),
array("name"=>"use_mobile","alias"=>"","value"=>$args->use_mobile?$args->use_mobile:"N"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl?$args->site_srl:"0","pipe"=>"","operation"=>"equal",),
array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"and","operation"=>"equal",),
)),
 );
return $output; ?>