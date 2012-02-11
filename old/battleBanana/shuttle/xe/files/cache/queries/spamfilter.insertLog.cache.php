<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "spamfilter.insertLog";
$output->action = "insert";
$output->column_type["spamfilter_log_srl"] = "number";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "spamfilter_log"=>"spamfilter_log", );
$output->_tables = array( "spamfilter_log"=>"spamfilter_log", );
$output->columns = array ( array("name"=>"spamfilter_log_srl","alias"=>"","value"=>$this->getNextSequence()),
array("name"=>"ipaddress","alias"=>"","value"=>$_SERVER['REMOTE_ADDR']),
array("name"=>"regdate","alias"=>"","value"=>$args->regdate?$args->regdate:date("YmdHis")),
 );
return $output; ?>