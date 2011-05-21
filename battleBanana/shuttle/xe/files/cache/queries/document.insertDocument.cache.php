<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "document.insertDocument";
$output->action = "insert";
$output->column_type["document_srl"] = "number";
$output->column_type["module_srl"] = "number";
$output->column_type["category_srl"] = "number";
$output->column_type["lang_code"] = "varchar";
$output->column_type["is_notice"] = "char";
$output->column_type["is_secret"] = "char";
$output->column_type["title"] = "varchar";
$output->column_type["title_bold"] = "char";
$output->column_type["title_color"] = "varchar";
$output->column_type["content"] = "bigtext";
$output->column_type["readed_count"] = "number";
$output->column_type["voted_count"] = "number";
$output->column_type["blamed_count"] = "number";
$output->column_type["comment_count"] = "number";
$output->column_type["trackback_count"] = "number";
$output->column_type["uploaded_count"] = "number";
$output->column_type["password"] = "varchar";
$output->column_type["user_id"] = "varchar";
$output->column_type["user_name"] = "varchar";
$output->column_type["nick_name"] = "varchar";
$output->column_type["member_srl"] = "number";
$output->column_type["email_address"] = "varchar";
$output->column_type["homepage"] = "varchar";
$output->column_type["tags"] = "text";
$output->column_type["extra_vars"] = "text";
$output->column_type["regdate"] = "date";
$output->column_type["last_update"] = "date";
$output->column_type["last_updater"] = "varchar";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["list_order"] = "number";
$output->column_type["update_order"] = "number";
$output->column_type["allow_comment"] = "char";
$output->column_type["lock_comment"] = "char";
$output->column_type["allow_trackback"] = "char";
$output->column_type["notify_message"] = "char";
$output->tables = array( "documents"=>"documents", );
$output->_tables = array( "documents"=>"documents", );
$output->columns = array ( array("name"=>"document_srl","alias"=>"","value"=>$args->document_srl),
array("name"=>"module_srl","alias"=>"","value"=>$args->module_srl?$args->module_srl:"0"),
array("name"=>"category_srl","alias"=>"","value"=>$args->category_srl?$args->category_srl:"0"),
array("name"=>"lang_code","alias"=>"","value"=>$args->lang_code?$args->lang_code:""),
array("name"=>"is_notice","alias"=>"","value"=>$args->is_notice?$args->is_notice:"N"),
array("name"=>"is_secret","alias"=>"","value"=>$args->is_secret?$args->is_secret:"N"),
array("name"=>"title","alias"=>"","value"=>$args->title),
array("name"=>"title_bold","alias"=>"","value"=>$args->title_bold?$args->title_bold:"N"),
array("name"=>"title_color","alias"=>"","value"=>$args->title_color?$args->title_color:"N"),
array("name"=>"content","alias"=>"","value"=>$args->content),
array("name"=>"readed_count","alias"=>"","value"=>$args->readed_count?$args->readed_count:"0"),
array("name"=>"blamed_count","alias"=>"","value"=>$args->blamed_count?$args->blamed_count:"0"),
array("name"=>"voted_count","alias"=>"","value"=>$args->voted_count?$args->voted_count:"0"),
array("name"=>"comment_count","alias"=>"","value"=>$args->comment_count?$args->comment_count:"0"),
array("name"=>"trackback_count","alias"=>"","value"=>$args->trackback_count?$args->trackback_count:"0"),
array("name"=>"uploaded_count","alias"=>"","value"=>$args->uploaded_count?$args->uploaded_count:"0"),
array("name"=>"password","alias"=>"","value"=>$args->password),
array("name"=>"nick_name","alias"=>"","value"=>$args->nick_name),
array("name"=>"member_srl","alias"=>"","value"=>$args->member_srl?$args->member_srl:"0"),
array("name"=>"user_id","alias"=>"","value"=>$args->user_id?$args->user_id:""),
array("name"=>"user_name","alias"=>"","value"=>$args->user_name?$args->user_name:""),
array("name"=>"email_address","alias"=>"","value"=>$args->email_address),
array("name"=>"homepage","alias"=>"","value"=>$args->homepage),
array("name"=>"tags","alias"=>"","value"=>$args->tags),
array("name"=>"extra_vars","alias"=>"","value"=>$args->extra_vars),
array("name"=>"regdate","alias"=>"","value"=>$args->regdate?$args->regdate:date("YmdHis")),
array("name"=>"last_update","alias"=>"","value"=>$args->last_update?$args->last_update:date("YmdHis")),
array("name"=>"ipaddress","alias"=>"","value"=>$args->ipaddress?$args->ipaddress:$_SERVER['REMOTE_ADDR']),
array("name"=>"list_order","alias"=>"","value"=>$args->list_order?$args->list_order:"0"),
array("name"=>"update_order","alias"=>"","value"=>$args->update_order?$args->update_order:"0"),
array("name"=>"allow_comment","alias"=>"","value"=>$args->allow_comment?$args->allow_comment:"Y"),
array("name"=>"lock_comment","alias"=>"","value"=>$args->lock_comment?$args->lock_comment:"N"),
array("name"=>"allow_trackback","alias"=>"","value"=>$args->allow_trackback?$args->allow_trackback:"Y"),
array("name"=>"notify_message","alias"=>"","value"=>$args->notify_message?$args->notify_message:"N"),
 );
return $output; ?>