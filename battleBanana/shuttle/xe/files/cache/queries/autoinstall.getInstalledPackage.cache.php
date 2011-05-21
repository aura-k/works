<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getInstalledPackage";
$output->action = "select";
if(isset($args->package_srl)) { unset($_output); $_output = $this->checkFilter("package_srl",$args->package_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->package_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->package_srl?$lang->package_srl:'package_srl'));
$output->column_type["package_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->column_type["current_version"] = "varchar";
$output->column_type["need_update"] = "char";
$output->tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->_tables = array( "ai_installed_packages"=>"ai_installed_packages", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"package_srl", "value"=>$args->package_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>