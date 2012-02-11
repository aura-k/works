<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getModulePartConfig";
$output->action = "select";
if(!isset($args->module)) return new Object(-1, sprintf($lang->filter->isnull, $lang->module?$lang->module:'module'));
if(!isset($args->module_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->module_srl?$lang->module_srl:'module_srl'));
$output->column_type["module"] = "varchar";
$output->column_type["module_srl"] = "number";
$output->column_type["config"] = "text";
$output->column_type["regdate"] = "date";
$output->tables = array( "module_part_config"=>"module_part_config", );
$output->_tables = array( "module_part_config"=>"module_part_config", );
$output->columns = array ( array("name"=>"config","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module", "value"=>$args->module,"pipe"=>"","operation"=>"equal",),
array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"and","operation"=>"equal",),
)),
 );
return $output; ?>