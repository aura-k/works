<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.deleteModuleConfig";
$output->action = "delete";
if(!isset($args->module)) return new Object(-1, sprintf($lang->filter->isnull, $lang->module?$lang->module:'module'));
$output->column_type["module"] = "varchar";
$output->column_type["config"] = "text";
$output->column_type["regdate"] = "date";
$output->tables = array( "module_config"=>"module_config", );
$output->_tables = array( "module_config"=>"module_config", );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module", "value"=>$args->module,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>