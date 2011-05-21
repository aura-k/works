<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getTriggers";
$output->action = "select";
$output->column_type["trigger_name"] = "varchar";
$output->column_type["called_position"] = "varchar";
$output->column_type["module"] = "varchar";
$output->column_type["type"] = "varchar";
$output->column_type["called_method"] = "varchar";
$output->tables = array( "module_trigger"=>"module_trigger", );
$output->_tables = array( "module_trigger"=>"module_trigger", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"trigger_name", "value"=>$args->trigger_name,"pipe"=>"","operation"=>"equal",),
array("column"=>"called_position", "value"=>$args->called_position,"pipe"=>"and","operation"=>"equal",),
)),
 );
return $output; ?>