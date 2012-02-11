<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getDefaultModules";
$output->action = "select";
if(!isset($args->site_srl)) $args->site_srl = "0";
if(!isset($args->site_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->site_srl?$lang->site_srl:'site_srl'));
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
$output->column_type["module_category_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "modules"=>"modules", );
$output->_tables = array( "modules"=>"modules","module_categories"=>"module_categories", );
$output->left_tables = array( "module_categories"=>"left join", );
$output->columns = array ( array("name"=>"modules.site_srl","alias"=>""),
array("name"=>"modules.module","alias"=>""),
array("name"=>"modules.mid","alias"=>""),
array("name"=>"modules.browser_title","alias"=>""),
array("name"=>"module_categories.title","alias"=>"category"),
array("name"=>"modules.module_srl","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"modules.site_srl", "value"=>$args->site_srl?$args->site_srl:"0","pipe"=>"","operation"=>"equal",),
)),
 );
$output->left_conditions = array ( 'module_categories' => array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_categories.module_category_srl", "value"=>"modules.module_category_srl","pipe"=>"","operation"=>"equal",),
)),
),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"modules.module",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),array($args->sort_index?$args->sort_index:"module_categories.title",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),array($args->sort_index?$args->sort_index:"modules.mid",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
return $output; ?>