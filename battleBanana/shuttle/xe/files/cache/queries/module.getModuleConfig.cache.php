<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getModuleConfig";
$output->action = "select";
$output->column_type["module"] = "varchar";
$output->column_type["config"] = "text";
$output->column_type["regdate"] = "date";
$output->tables = array( "module_config"=>"module_config", );
$output->_tables = array( "module_config"=>"module_config", );
$output->columns = array ( array("name"=>"config","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module", "value"=>$args->module,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>