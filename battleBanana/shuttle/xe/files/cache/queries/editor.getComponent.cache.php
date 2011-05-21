<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "editor.getComponent";
$output->action = "select";
if(!isset($args->component_name)) return new Object(-1, sprintf($lang->filter->isnull, $lang->component_name?$lang->component_name:'component_name'));
$output->column_type["component_name"] = "varchar";
$output->column_type["enabled"] = "char";
$output->column_type["extra_vars"] = "text";
$output->column_type["list_order"] = "number";
$output->tables = array( "editor_components"=>"editor_components", );
$output->_tables = array( "editor_components"=>"editor_components", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"component_name", "value"=>$args->component_name,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>