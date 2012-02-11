<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.chkDeniedID";
$output->action = "select";
$output->column_type["user_id"] = "varchar";
$output->column_type["regdate"] = "date";
$output->column_type["description"] = "text";
$output->column_type["list_order"] = "number";
$output->tables = array( "member_denied_user_id"=>"member_denied_user_id", );
$output->_tables = array( "member_denied_user_id"=>"member_denied_user_id", );
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"user_id", "value"=>$args->user_id,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>