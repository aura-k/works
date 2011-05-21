<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getInstalledPackageCount";
$output->action = "select";
$output->column_type["package_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->column_type["current_version"] = "varchar";
$output->column_type["need_update"] = "char";
$output->tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->_tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
return $output; ?>