<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "menu.getMenuList";
$output->action = "select";
if(isset($args->site_srl)) { unset($_output); $_output = $this->checkFilter("site_srl",$args->site_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->site_srl)) $args->site_srl = "0";
if(!isset($args->site_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->site_srl?$lang->site_srl:'site_srl'));
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
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl?$args->site_srl:"0","pipe"=>"","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"listorder",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"20");
$output->page_count = array("var"=>"page_count", "value"=>$args->page_count?$args->page_count:"20");
$output->page = array("var"=>"page", "value"=>$args->page?$args->page:"");
return $output; ?>