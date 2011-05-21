<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.insertCategory";
$output->action = "insert";
$output->column_type["category_srl"] = "number";
$output->column_type["parent_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->tables = array( "ai_remote_categories"=>"ai_remote_categories", );
$output->_tables = array( "ai_remote_categories"=>"ai_remote_categories", );
$output->columns = array ( array("name"=>"category_srl","alias"=>"","value"=>$args->category_srl),
array("name"=>"parent_srl","alias"=>"","value"=>$args->parent_srl),
array("name"=>"title","alias"=>"","value"=>$args->title),
 );
return $output; ?>