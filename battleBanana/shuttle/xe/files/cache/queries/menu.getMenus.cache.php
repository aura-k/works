<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "menu.getMenus";
$output->action = "select";
if(isset($args->site_srl)) { unset($_output); $_output = $this->checkFilter("site_srl",$args->site_srl,"number"); if(!$_output->toBool()) return $_output; } 
$output->column_type["menu_srl"] = "number";
$output->column_type["site_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->column_type["listorder"] = "number";
$output->column_type["regdate"] = "date";
$output->tables = array( "menu"=>"menu", );
$output->_tables = array( "menu"=>"menu", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"listorder",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
return $output; ?>