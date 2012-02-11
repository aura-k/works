<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.getMemberGroups";
$output->action = "select";
if(isset($args->member_srl)) { unset($_output); $_output = $this->checkFilter("member_srl",$args->member_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->member_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->member_srl?$lang->member_srl:'member_srl'));
$output->column_type["site_srl"] = "number";
$output->column_type["group_srl"] = "number";
$output->column_type["title"] = "varchar";
$output->column_type["regdate"] = "date";
$output->column_type["is_default"] = "char";
$output->column_type["is_admin"] = "char";
$output->column_type["image_mark"] = "text";
$output->column_type["description"] = "text";
$output->column_type["site_srl"] = "number";
$output->column_type["group_srl"] = "number";
$output->column_type["member_srl"] = "number";
$output->column_type["regdate"] = "date";
$output->tables = array( "a"=>"member_group","b"=>"member_group_member", );
$output->_tables = array( "a"=>"member_group","b"=>"member_group_member", );
$output->columns = array ( array("name"=>"a.title","alias"=>"title"),
array("name"=>"a.group_srl","alias"=>"group_srl"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"b.member_srl", "value"=>$args->member_srl,"pipe"=>"","operation"=>"equal",),
array("column"=>"b.group_srl", "value"=>"a.group_srl","pipe"=>"and","operation"=>"equal",),
array("column"=>"a.site_srl", "value"=>$args->site_srl,"pipe"=>"and","operation"=>"equal",),
)),
 );
return $output; ?>