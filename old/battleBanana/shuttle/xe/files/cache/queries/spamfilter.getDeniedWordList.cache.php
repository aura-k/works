<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "spamfilter.getDeniedWordList";
$output->action = "select";
$output->column_type["word"] = "varchar";
$output->column_type["hit"] = "number";
$output->column_type["latest_hit"] = "date";
$output->column_type["regdate"] = "date";
$output->tables = array( "spamfilter_denied_word"=>"spamfilter_denied_word", );
$output->_tables = array( "spamfilter_denied_word"=>"spamfilter_denied_word", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"regdate",in_array($args->desc,array("asc","desc"))?$args->desc:("desc"?"desc":"asc")),);
return $output; ?>