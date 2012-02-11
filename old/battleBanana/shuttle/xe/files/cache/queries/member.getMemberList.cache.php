<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "member.getMemberList";
$output->action = "select";
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
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"is_admin", "value"=>$args->is_admin,"pipe"=>"","operation"=>"equal",),
array("column"=>"denied", "value"=>$args->is_denied,"pipe"=>"and","operation"=>"equal",),
)),
array("pipe"=>"and",
"condition"=>array(array("column"=>"user_id", "value"=>$args->s_user_id,"pipe"=>"","operation"=>"like",),
array("column"=>"user_name", "value"=>$args->s_user_name,"pipe"=>"or","operation"=>"like",),
array("column"=>"nick_name", "value"=>$args->s_nick_name,"pipe"=>"or","operation"=>"like",),
array("column"=>"email_address", "value"=>$args->s_email_address,"pipe"=>"or","operation"=>"like",),
array("column"=>"extra_vars", "value"=>$args->s_extra_vars,"pipe"=>"or","operation"=>"like",),
array("column"=>"regdate", "value"=>$args->s_regdate,"pipe"=>"or","operation"=>"like_prefix",),
array("column"=>"last_login", "value"=>$args->s_last_login,"pipe"=>"or","operation"=>"like_prefix",),
array("column"=>"member.regdate", "value"=>$args->s_regdate_more,"pipe"=>"or","operation"=>"more",),
array("column"=>"member.regdate", "value"=>$args->s_regdate_less,"pipe"=>"or","operation"=>"less",),
array("column"=>"member.last_login", "value"=>$args->s_last_login_more,"pipe"=>"or","operation"=>"more",),
array("column"=>"member.last_login", "value"=>$args->s_last_login_less,"pipe"=>"or","operation"=>"less",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"member_srl",in_array($args->sort_order,array("asc","desc"))?$args->sort_order:("sort_order"?"sort_order":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"20");
$output->page_count = array("var"=>"page_count", "value"=>$args->page_count?$args->page_count:"20");
$output->page = array("var"=>"page", "value"=>$args->page?$args->page:"");
return $output; ?>