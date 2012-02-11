<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getCategories";
$output->action = "select";
$output->column_type["category_srl"] = "number";
$output->column_type["parent_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->tables = array( "ai_remote_categories"=>"ai_remote_categories", );
$output->_tables = array( "ai_remote_categories"=>"ai_remote_categories", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
return $output; ?>