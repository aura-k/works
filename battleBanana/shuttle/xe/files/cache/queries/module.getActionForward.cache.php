<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getActionForward";
$output->action = "select";
$output->column_type["act"] = "varchar";
$output->column_type["module"] = "varchar";
$output->column_type["type"] = "varchar";
$output->tables = array( "action_forward"=>"action_forward", );
$output->_tables = array( "action_forward"=>"action_forward", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"act", "value"=>$args->act,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>