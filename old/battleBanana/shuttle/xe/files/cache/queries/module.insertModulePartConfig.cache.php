<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.insertModulePartConfig";
$output->action = "insert";
$output->column_type["module"] = "varchar";
$output->column_type["module_srl"] = "number";
$output->column_type["config"] = "text";
$output->column_type["regdate"] = "date";
$output->tables = array( "module_part_config"=>"module_part_config", );
$output->_tables = array( "module_part_config"=>"module_part_config", );
$output->columns = array ( array("name"=>"module","alias"=>"","value"=>$args->module),
array("name"=>"module_srl","alias"=>"","value"=>$args->module_srl),
array("name"=>"config","alias"=>"","value"=>$args->config),
array("name"=>"regdate","alias"=>"","value"=>date("YmdHis")),
 );
return $output; ?>