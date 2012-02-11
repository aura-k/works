<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getSiteCount";
$output->action = "select";
$output->column_type["site_srl"] = "number";
$output->column_type["index_module_srl"] = "number";
$output->column_type["domain"] = "varchar";
$output->column_type["default_language"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "sites"=>"sites", );
$output->_tables = array( "sites"=>"sites", );
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
return $output; ?>