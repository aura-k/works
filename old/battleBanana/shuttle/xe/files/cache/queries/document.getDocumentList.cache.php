<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "document.getDocumentList";
$output->action = "select";
if(isset($args->module_srl)) { unset($_output); $_output = $this->checkFilter("module_srl",$args->module_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->exclude_module_srl)) { unset($_output); $_output = $this->checkFilter("exclude_module_srl",$args->exclude_module_srl,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->member_srl)) { unset($_output); $_output = $this->checkFilter("member_srl",$args->member_srl,"number"); if(!$_output->toBool()) return $_output; } 
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
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"","operation"=>"in",),
array("column"=>"module_srl", "value"=>$args->exclude_module_srl,"pipe"=>"and","operation"=>"notin",),
array("column"=>"category_srl", "value"=>$args->category_srl,"pipe"=>"and","operation"=>"in",),
array("column"=>"is_notice", "value"=>$args->s_is_notice,"pipe"=>"and","operation"=>"equal",),
array("column"=>"member_srl", "value"=>$args->member_srl,"pipe"=>"and","operation"=>"equal",),
)),
array("pipe"=>"and",
"condition"=>array(array("column"=>"list_order", "value"=>$args->division,"pipe"=>"and","operation"=>"more",),
array("column"=>"list_order", "value"=>$args->last_division,"pipe"=>"and","operation"=>"below",),
)),
array("pipe"=>"and",
"condition"=>array(array("column"=>"title", "value"=>$args->s_title,"pipe"=>"","operation"=>"like",),
array("column"=>"content", "value"=>$args->s_content,"pipe"=>"or","operation"=>"like",),
array("column"=>"user_name", "value"=>$args->s_user_name,"pipe"=>"or","operation"=>"like",),
array("column"=>"user_id", "value"=>$args->s_user_id,"pipe"=>"or","operation"=>"like",),
array("column"=>"nick_name", "value"=>$args->s_nick_name,"pipe"=>"or","operation"=>"like",),
array("column"=>"email_address", "value"=>$args->s_email_addres,"pipe"=>"or","operation"=>"like",),
array("column"=>"homepage", "value"=>$args->s_homepage,"pipe"=>"or","operation"=>"like",),
array("column"=>"tags", "value"=>$args->s_tags,"pipe"=>"or","operation"=>"like",),
array("column"=>"is_secret", "value"=>$args->s_is_secret,"pipe"=>"or","operation"=>"equal",),
array("column"=>"member_srl", "value"=>$args->s_member_srl,"pipe"=>"or","operation"=>"equal",),
array("column"=>"readed_count", "value"=>$args->s_readed_count,"pipe"=>"or","operation"=>"more",),
array("column"=>"voted_count", "value"=>$args->s_voted_count,"pipe"=>"or","operation"=>"more",),
array("column"=>"comment_count", "value"=>$args->s_comment_count,"pipe"=>"or","operation"=>"more",),
array("column"=>"trackback_count", "value"=>$args->s_trackback_count,"pipe"=>"or","operation"=>"more",),
array("column"=>"uploaded_count", "value"=>$args->s_uploaded_count,"pipe"=>"or","operation"=>"more",),
array("column"=>"regdate", "value"=>$args->s_regdate,"pipe"=>"or","operation"=>"like_prefix",),
array("column"=>"last_update", "value"=>$args->s_last_update,"pipe"=>"or","operation"=>"like_prefix",),
array("column"=>"ipaddress", "value"=>$args->s_ipaddress,"pipe"=>"or","operation"=>"like_prefix",),
)),
array("pipe"=>"and",
"condition"=>array(array("column"=>"last_update", "value"=>$args->start_date,"pipe"=>"and","operation"=>"more",),
array("column"=>"last_update", "value"=>$args->end_date,"pipe"=>"and","operation"=>"less",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"list_order",in_array($args->order_type,array("asc","desc"))?$args->order_type:("order_type"?"order_type":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"20");
$output->page_count = array("var"=>"page_count", "value"=>$args->page_count?$args->page_count:"20");
$output->page = array("var"=>"page", "value"=>$args->page?$args->page:"");
return $output; ?>