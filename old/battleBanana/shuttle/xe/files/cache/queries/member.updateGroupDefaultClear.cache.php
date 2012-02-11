<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.updateGroupDefaultClear";
$output->action = "update";
if(!isset($args->site_srl)) $args->site_srl = "0";
if(!isset($args->site_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->site_srl?$lang->site_srl:'site_srl'));
$output->column_type["site_srl"] = "number";
$output->column_type["group_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->column_type["regdate"] = "date";
$output->column_type["is_default"] = "char";
$output->column_type["is_admin"] = "char";
$output->column_type["image_mark"] = "text";
$output->column_type["description"] = "text";
$output->tables = array( "member_group"=>"member_group", );
$output->_tables = array( "member_group"=>"member_group", );
$output->columns = array ( array("name"=>"is_default","alias"=>"","value"=>"N"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl?$args->site_srl:"0","pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>