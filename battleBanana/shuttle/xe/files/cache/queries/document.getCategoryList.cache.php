<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "document.getCategoryList";
$output->action = "select";
if(isset($args->module_srl)) { unset($_output); $_output = $this->checkFilter("module_srl",$args->module_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->module_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->module_srl?$lang->module_srl:'module_srl'));
$output->column_type["category_srl"] = "number";
$output->column_type["module_srl"] = "number";
$output->column_type["parent_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->column_type["expand"] = "char";
$output->column_type["document_count"] = "number";
$output->column_type["regdate"] = "date";
$output->column_type["last_update"] = "date";
$output->column_type["list_order"] = "number";
$output->column_type["group_srls"] = "text";
$output->column_type["color"] = "varchar";
$output->tables = array( "document_categories"=>"document_categories", );
$output->_tables = array( "document_categories"=>"document_categories", );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"list_order",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
return $output; ?>