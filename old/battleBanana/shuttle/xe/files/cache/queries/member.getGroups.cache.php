<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.getGroups";
$output->action = "select";
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
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"site_srl", "value"=>$args->site_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"group_srl",in_array($args->desc,array("asc","desc"))?$args->desc:("desc"?"desc":"asc")),);
return $output; ?>