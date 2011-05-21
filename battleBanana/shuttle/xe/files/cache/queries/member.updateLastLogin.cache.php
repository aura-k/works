<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.updateLastLogin";
$output->action = "update";
if(isset($args->member_srl)) { unset($_output); $_output = $this->checkFilter("member_srl",$args->member_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(!isset($args->member_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->member_srl?$lang->member_srl:'member_srl'));
$output->column_type["member_srl"] = "number";
$output->column_type["user_id"] = "varchar";
$output->column_type["email_address"] = "varchar";
$output->column_type["password"] = "varchar";
$output->column_type["email_id"] = "varchar";
$output->column_type["email_host"] = "varchar";
$output->column_type["user_name"] = "varchar";
$output->column_type["nick_name"] = "varchar";
$output->column_type["homepage"] = "varchar";
$output->column_type["blog"] = "varchar";
$output->column_type["birthday"] = "char";
$output->column_type["allow_mailing"] = "char";
$output->column_type["allow_message"] = "char";
$output->column_type["denied"] = "char";
$output->column_type["limit_date"] = "date";
$output->column_type["regdate"] = "date";
$output->column_type["last_login"] = "date";
$output->column_type["is_admin"] = "char";
$output->column_type["description"] = "text";
$output->column_type["extra_vars"] = "text";
$output->tables = array( "member"=>"member", );
$output->_tables = array( "member"=>"member", );
$output->columns = array ( array("name"=>"member_srl","alias"=>"","value"=>$args->member_srl),
array("name"=>"last_login","alias"=>"","value"=>$args->last_login?$args->last_login:date("YmdHis")),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"member_srl", "value"=>$args->member_srl,"pipe"=>"","operation"=>"equal",),
)),
 );
return $output; ?>