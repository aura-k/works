<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.insertInstalledPackage";
$output->action = "insert";
$output->column_type["package_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->column_type["current_version"] = "varchar";
$output->column_type["need_update"] = "char";
$output->tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->_tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->columns = array ( array("name"=>"package_srl","alias"=>"","value"=>$args->package_srl),
array("name"=>"version","alias"=>"","value"=>$args->version),
array("name"=>"current_version","alias"=>"","value"=>$args->current_version),
array("name"=>"need_update","alias"=>"","value"=>$args->need_update),
 );
return $output; ?>