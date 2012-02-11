<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "spamfilter.getDeniedIPList";
$output->action = "select";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "spamfilter_denied_ip"=>"spamfilter_denied_ip", );
$output->_tables = array( "spamfilter_denied_ip"=>"spamfilter_denied_ip", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"regdate",in_array($args->desc,array("asc","desc"))?$args->desc:("desc"?"desc":"asc")),);
return $output; ?>