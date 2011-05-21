<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.isExistsSiteDomain";
$output->action = "select";
if(!isset($args->domain)) return new Object(-1, sprintf($lang->filter->isnull, $lang->domain?$lang->domain:'domain'));
$output->column_type["site_srl"] = "number";
$output->column_type["index_module_srl"] = "number";
$output->column_type["domain"] = "varchar";
$output->column_type["default_language"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "sites"=>"sites", );
$output->_tables = array( "sites"=>"sites", );
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"domain", "value"=>$args->domain,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>