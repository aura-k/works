<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.insertModuleExtraVars";
$output->action = "insert";
$output->column_type["module_srl"] = "number";
$output->column_type["name"] = "varchar";
$output->column_type["value"] = "text";
$output->tables = array( "module_extra_vars"=>"module_extra_vars", );
$output->_tables = array( "module_extra_vars"=>"module_extra_vars", );
$output->columns = array ( array("name"=>"module_srl","alias"=>"","value"=>$args->module_srl),
array("name"=>"name","alias"=>"","value"=>$args->name),
array("name"=>"value","alias"=>"","value"=>$args->value),
 );
return $output; ?>