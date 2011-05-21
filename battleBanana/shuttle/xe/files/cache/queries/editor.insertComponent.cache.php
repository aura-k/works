<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "editor.insertComponent";
$output->action = "insert";
$output->column_type["component_name"] = "varchar";
$output->column_type["enabled"] = "char";
$output->column_type["extra_vars"] = "text";
$output->column_type["list_order"] = "number";
$output->tables = array( "editor_components"=>"editor_components", );
$output->_tables = array( "editor_components"=>"editor_components", );
$output->columns = array ( array("name"=>"component_name","alias"=>"","value"=>$args->component_name),
array("name"=>"enabled","alias"=>"","value"=>$args->enabled?$args->enabled:"N"),
array("name"=>"list_order","alias"=>"","value"=>$args->list_order?$args->list_order:$this->getNextSequence()),
 );
return $output; ?>