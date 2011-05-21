<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.deleteInstalledPackage";
$output->action = "delete";
if(isset($args->package_srl)) { unset($_output); $_output = $this->checkFilter("package_srl",$args->package_srl,"number"); if(!$_output->toBool()) return $_output; } 
$output->column_type["package_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->column_type["current_version"] = "varchar";
$output->column_type["need_update"] = "char";
$output->tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->_tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"package_srl", "value"=>$args->package_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>