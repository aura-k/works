<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "editor.getSavedDocument";
$output->action = "select";
$output->column_type["member_srl"] = "number";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["module_srl"] = "number";
$output->column_type["document_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->column_type["content"] = "bigtext";
$output->column_type["regdate"] = "date";
$output->tables = array( "editor_autosave"=>"editor_autosave", );
$output->_tables = array( "editor_autosave"=>"editor_autosave", );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"","operation"=>"equal",),
array("column"=>"member_srl", "value"=>$args->member_srl,"pipe"=>"and","operation"=>"equal",),
array("column"=>"ipaddress", "value"=>$args->ipaddress,"pipe"=>"and","operation"=>"equal",),
)),
 );
return $output; ?>