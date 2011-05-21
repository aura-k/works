<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "session.gcSession";
$output->action = "delete";
$output->column_type["session_key"] = "varchar";
$output->column_type["member_srl"] = "number";
$output->column_type["expired"] = "date";
$output->column_type["val"] = "bigtext";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["last_update"] = "date";
$output->column_type["cur_mid"] = "varchar";
$output->tables = array( "session"=>"session", );
$output->_tables = array( "session"=>"session", );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"expired", "value"=>date("YmdHis"),"pipe"=>"","operation"=>"less",),
)),
 );
return $output; ?>