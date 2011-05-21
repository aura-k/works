<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getSiteModules";
$output->action = "select";
$output->column_type["site_srl"] = "number";
$output->column_type["index_module_srl"] = "number";
$output->column_type["domain"] = "varchar";
$output->column_type["default_language"] = "varchar";
$output->column_type["regdate"] = "date";
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
$output->tables = array( "sites"=>"sites","modules"=>"modules", );
$output->_tables = array( "sites"=>"sites","modules"=>"modules", );
$output->columns = array ( array("name"=>"sites.domain","alias"=>""),
array("name"=>"modules.site_srl","alias"=>""),
array("name"=>"modules.module","alias"=>""),
array("name"=>"modules.mid","alias"=>""),
array("name"=>"modules.browser_title","alias"=>""),
array("name"=>"modules.module_srl","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"sites.site_srl", "value"=>$args->site_srl,"pipe"=>"","operation"=>"equal",),
array("column"=>"sites.domain", "value"=>$args->site_keyword,"pipe"=>"and","operation"=>"equal",),
array("column"=>"sites.site_srl", "value"=>"modules.site_srl","pipe"=>"and","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"modules.module",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),array($args->sort_index?$args->sort_index:"modules.mid",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
return $output; ?>