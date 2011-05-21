<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "counter.getCounterLog";
$output->action = "select";
if(!isset($args->site_srl)) $args->site_srl = "0";
if(!isset($args->regdate)) return new Object(-1, sprintf($lang->filter->isnull, $lang->regdate?$lang->regdate:'regdate'));
$output->column_type["site_srl"] = "number";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["regdate"] = "date";
$output->column_type["user_agent"] = "varchar";
$output->tables = array( "counter_log"=>"counter_log", );
$output->_tables = array( "counter_log"=>"counter_log", );
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl?$args->site_srl:"0","pipe"=>"and","operation"=>"equal",),
array("column"=>"ipaddress", "value"=>$args->ipaddress,"pipe"=>"and","operation"=>"equal",),
array("column"=>"regdate", "value"=>$args->regdate,"pipe"=>"and","operation"=>"like_prefix",),
)),
 );
return $output; ?>