<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "tag.getTagList";
$output->action = "select";
if(isset($args->module_srl)) { unset($_output); $_output = $this->checkFilter("module_srl",$args->module_srl,"number"); if(!$_output->toBool()) return $_output; } 
$output->column_type["tag_srl"] = "number";
$output->column_type["module_srl"] = "number";
$output->column_type["document_srl"] = "number";
$output->column_type["tag"] = "varchar";
$output->column_type["regdate"] = "date";
$output->tables = array( "tags"=>"tags", );
$output->_tables = array( "tags"=>"tags", );
$output->columns = array ( array("name"=>"tag","alias"=>""),
array("name"=>"count(*)","alias"=>"count"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"","operation"=>"in",),
)),
 );
$output->order = array(array($args->count?$args->count:"count",in_array($args->desc,array("asc","desc"))?$args->desc:("desc"?"desc":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"20");
$output->groups = array("tag");
return $output; ?>