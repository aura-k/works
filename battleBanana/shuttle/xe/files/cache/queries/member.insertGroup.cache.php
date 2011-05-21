<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.insertGroup";
$output->action = "insert";
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
$output->columns = array ( array("name"=>"site_srl","alias"=>"","value"=>$args->site_srl?$args->site_srl:"0"),
array("name"=>"group_srl","alias"=>"","value"=>$args->group_srl?$args->group_srl:$this->getNextSequence()),
array("name"=>"title","alias"=>"","value"=>$args->title),
array("name"=>"is_default","alias"=>"","value"=>$args->is_default?$args->is_default:"N"),
array("name"=>"is_admin","alias"=>"","value"=>$args->is_admin?$args->is_admin:"N"),
array("name"=>"regdate","alias"=>"","value"=>date("YmdHis")),
array("name"=>"description","alias"=>"","value"=>$args->description?$args->description:""),
array("name"=>"image_mark","alias"=>"","value"=>$args->image_mark?$args->image_mark:""),
 );
return $output; ?>