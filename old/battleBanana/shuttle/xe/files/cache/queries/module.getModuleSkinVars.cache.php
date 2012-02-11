<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getModuleSkinVars";
$output->action = "select";
if(isset($args->module_srl)) { unset($_output); $_output = $this->checkFilter("module_srl",$args->module_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->module_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->module_srl?$lang->module_srl:'module_srl'));
$output->column_type["module_srl"] = "number";
$output->column_type["name"] = "varchar";
$output->column_type["value"] = "text";
$output->tables = array( "module_skins"=>"module_skins", );
$output->_tables = array( "module_skins"=>"module_skins", );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"","operation"=>"in",),
)),
 );
return $output; ?>