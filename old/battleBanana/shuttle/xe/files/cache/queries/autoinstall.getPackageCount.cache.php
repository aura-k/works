<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getPackageCount";
$output->action = "select";
if(isset($args->category_srl)) { unset($_output); $_output = $this->checkFilter("category_srl",$args->category_srl,"number"); if(!$_output->toBool()) return $_output; } 
$output->column_type["package_srl"] = "number";
$output->column_type["category_srl"] = "number";
$output->column_type["path"] = "varchar";
$output->column_type["updatedate"] = "date";
$output->column_type["latest_item_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->tables = array( "autoinstall_packages"=>"autoinstall_packages", );
$output->_tables = array( "autoinstall_packages"=>"autoinstall_packages", );
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"category_srl", "value"=>$args->category_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>