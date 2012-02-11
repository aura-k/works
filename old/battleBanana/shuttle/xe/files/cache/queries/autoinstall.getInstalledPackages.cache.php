<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getInstalledPackages";
$output->action = "select";
if(!isset($args->package_list)) return new Object(-1, sprintf($lang->filter->isnull, $lang->package_list?$lang->package_list:'package_list'));
$output->column_type["package_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->column_type["current_version"] = "varchar";
$output->column_type["need_update"] = "char";
$output->column_type["package_srl"] = "number";
$output->column_type["category_srl"] = "number";
$output->column_type["path"] = "varchar";
$output->column_type["updatedate"] = "date";
$output->column_type["latest_item_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->tables = array( "installed"=>"ai_installed_packages","package"=>"autoinstall_packages", );
$output->_tables = array( "installed"=>"ai_installed_packages","package"=>"autoinstall_packages", );
$output->columns = array ( array("name"=>"installed.*","alias"=>""),
array("name"=>"path","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"installed.package_srl", "value"=>$args->package_list,"pipe"=>"","operation"=>"in",),
array("column"=>"installed.package_srl", "value"=>"package.package_srl","pipe"=>"and","operation"=>"equal",),
)),
 );
return $output; ?>