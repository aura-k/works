<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "point.getPoint";
$output->action = "select";
$output->column_type["member_srl"] = "number";
$output->column_type["point"] = "number";
$output->tables = array( "point"=>"point", );
$output->_tables = array( "point"=>"point", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"member_srl", "value"=>$args->member_srl,"pipe"=>"","operation"=>"in",),
)),
 );
return $output; ?>