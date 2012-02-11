<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getPackages";
$output->action = "select";
$output->column_type["package_srl"] = "number";
$output->column_type["category_srl"] = "number";
$output->column_type["path"] = "varchar";
$output->column_type["updatedate"] = "date";
$output->column_type["latest_item_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->tables = array( "autoinstall_packages"=>"autoinstall_packages", );
$output->_tables = array( "autoinstall_packages"=>"autoinstall_packages", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
return $output; ?>