<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "module.getLangList";
$output->action = "select";
if(isset($args->site_srl)) { unset($_output); $_output = $this->checkFilter("site_srl",$args->site_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->site_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->site_srl?$lang->site_srl:'site_srl'));
$output->column_type["site_srl"] = "number";
$output->column_type["name"] = "varchar";
$output->column_type["lang_code"] = "varchar";
$output->column_type["value"] = "text";
$output->tables = array( "lang"=>"lang", );
$output->_tables = array( "lang"=>"lang", );
$output->columns = array ( array("name"=>"name","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"list_order",in_array($args->order_type,array("asc","desc"))?$args->order_type:("order_type"?"order_type":"asc")),);
$output->groups = array("name");
return $output; ?>