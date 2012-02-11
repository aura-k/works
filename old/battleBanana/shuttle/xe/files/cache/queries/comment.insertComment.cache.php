<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "comment.insertComment";
$output->action = "insert";
$output->column_type["comment_srl"] = "number";
$output->column_type["module_srl"] = "number";
$output->column_type["document_srl"] = "number";
$output->column_type["parent_srl"] = "number";
$output->column_type["is_secret"] = "char";
$output->column_type["content"] = "bigtext";
$output->column_type["voted_count"] = "number";
$output->column_type["blamed_count"] = "number";
$output->column_type["notify_message"] = "char";
$output->column_type["password"] = "varchar";
$output->column_type["user_id"] = "varchar";
$output->column_type["user_name"] = "varchar";
$output->column_type["nick_name"] = "varchar";
$output->column_type["member_srl"] = "number";
$output->column_type["email_address"] = "varchar";
$output->column_type["homepage"] = "varchar";
$output->column_type["uploaded_count"] = "number";
$output->column_type["regdate"] = "date";
$output->column_type["last_update"] = "date";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["list_order"] = "number";
$output->tables = array( "comments"=>"comments", );
$output->_tables = array( "comments"=>"comments", );
$output->columns = array ( array("name"=>"comment_srl","alias"=>"","value"=>$args->comment_srl),
array("name"=>"module_srl","alias"=>"","value"=>$args->module_srl),
array("name"=>"parent_srl","alias"=>"","value"=>$args->parent_srl?$args->parent_srl:"0"),
array("name"=>"document_srl","alias"=>"","value"=>$args->document_srl),
array("name"=>"is_secret","alias"=>"","value"=>$args->is_secret?$args->is_secret:"N"),
array("name"=>"notify_message","alias"=>"","value"=>$args->notify_message?$args->notify_message:"N"),
array("name"=>"content","alias"=>"","value"=>$args->content),
array("name"=>"voted_count","alias"=>"","value"=>$args->voted_count?$args->voted_count:"0"),
array("name"=>"blamed_count","alias"=>"","value"=>$args->blamed_count?$args->blamed_count:"0"),
array("name"=>"password","alias"=>"","value"=>$args->password),
array("name"=>"nick_name","alias"=>"","value"=>$args->nick_name),
array("name"=>"user_id","alias"=>"","value"=>$args->user_id?$args->user_id:""),
array("name"=>"user_name","alias"=>"","value"=>$args->user_name?$args->user_name:""),
array("name"=>"member_srl","alias"=>"","value"=>$args->member_srl?$args->member_srl:"0"),
array("name"=>"email_address","alias"=>"","value"=>$args->email_address),
array("name"=>"homepage","alias"=>"","value"=>$args->homepage),
array("name"=>"uploaded_count","alias"=>"","value"=>$args->uploaded_count?$args->uploaded_count:"0"),
array("name"=>"regdate","alias"=>"","value"=>$args->regdate?$args->regdate:date("YmdHis")),
array("name"=>"last_update","alias"=>"","value"=>$args->last_update?$args->last_update:date("YmdHis")),
array("name"=>"ipaddress","alias"=>"","value"=>$args->ipaddress?$args->ipaddress:$_SERVER['REMOTE_ADDR']),
array("name"=>"list_order","alias"=>"","value"=>$args->list_order?$args->list_order:"0"),
 );
return $output; ?>