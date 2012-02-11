<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.insertSite";
$output->action = "insert";
$output->column_type["site_srl"] = "number";
$output->column_type["index_module_srl"] = "number";
$output->column_type["domain"] = "varchar";
$output->column_type["default_language"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "sites"=>"sites", );
$output->_tables = array( "sites"=>"sites", );
$output->columns = array ( array("name"=>"site_srl","alias"=>"","value"=>$args->site_srl),
array("name"=>"domain","alias"=>"","value"=>$args->domain),
array("name"=>"index_module_srl","alias"=>"","value"=>$args->index_module_srl?$args->index_module_srl:"0"),
array("name"=>"default_language","alias"=>"","value"=>$args->default_language),
array("name"=>"regdate","alias"=>"","value"=>date("YmdHis")),
 );
return $output; ?>