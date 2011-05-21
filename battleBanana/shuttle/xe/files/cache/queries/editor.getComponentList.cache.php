<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "editor.getComponentList";
$output->action = "select";
$output->column_type["component_name"] = "varchar";
$output->column_type["enabled"] = "char";
$output->column_type["extra_vars"] = "text";
$output->column_type["list_order"] = "number";
$output->tables = array( "editor_components"=>"editor_components", );
$output->_tables = array( "editor_components"=>"editor_components", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"enabled", "value"=>$args->enabled,"pipe"=>"","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"list_order",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
return $output; ?>