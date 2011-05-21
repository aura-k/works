<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "document.getDocumentPage";
$output->action = "select";
if(isset($args->comment_count)) { unset($_output); $_output = $this->checkFilter("comment_count",$args->comment_count,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_comment_count)) { unset($_output); $_output = $this->checkFilter("rev_comment_count",$args->rev_comment_count,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->voted_count)) { unset($_output); $_output = $this->checkFilter("voted_count",$args->voted_count,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_voted_count)) { unset($_output); $_output = $this->checkFilter("rev_voted_count",$args->rev_voted_count,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->readed_count)) { unset($_output); $_output = $this->checkFilter("readed_count",$args->readed_count,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_readed_count)) { unset($_output); $_output = $this->checkFilter("rev_readed_count",$args->rev_readed_count,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->list_order)) { unset($_output); $_output = $this->checkFilter("list_order",$args->list_order,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_list_order)) { unset($_output); $_output = $this->checkFilter("rev_list_order",$args->rev_list_order,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->title)) { unset($_output); $_output = $this->checkFilter("title",$args->title,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_title)) { unset($_output); $_output = $this->checkFilter("rev_title",$args->rev_title,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->regdate)) { unset($_output); $_output = $this->checkFilter("regdate",$args->regdate,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_regdate)) { unset($_output); $_output = $this->checkFilter("rev_regdate",$args->rev_regdate,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->update_order)) { unset($_output); $_output = $this->checkFilter("update_order",$args->update_order,"number"); if(!$_output->toBool()) return $_output; } 
if(isset($args->rev_update_order)) { unset($_output); $_output = $this->checkFilter("rev_update_order",$args->rev_update_order,"number"); if(!$_output->toBool()) return $_output; } 
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
$output->columns = array ( array("name"=>"count(*)","alias"=>"count"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module_srl", "value"=>$args->module_srl,"pipe"=>"","operation"=>"equal",),
array("column"=>"comment_count", "value"=>$args->comment_count,"pipe"=>"and","operation"=>"more",),
array("column"=>"comment_count", "value"=>$args->rev_comment_count,"pipe"=>"and","operation"=>"less",),
array("column"=>"voted_count", "value"=>$args->voted_count,"pipe"=>"and","operation"=>"more",),
array("column"=>"voted_count", "value"=>$args->rev_voted_count,"pipe"=>"and","operation"=>"less",),
array("column"=>"readed_count", "value"=>$args->readed_count,"pipe"=>"and","operation"=>"more",),
array("column"=>"readed_count", "value"=>$args->rev_readed_count,"pipe"=>"and","operation"=>"less",),
array("column"=>"list_order", "value"=>$args->list_order,"pipe"=>"and","operation"=>"less",),
array("column"=>"list_order", "value"=>$args->rev_list_order,"pipe"=>"and","operation"=>"more",),
array("column"=>"title", "value"=>$args->title,"pipe"=>"and","operation"=>"more",),
array("column"=>"title", "value"=>$args->rev_title,"pipe"=>"and","operation"=>"less",),
array("column"=>"regdate", "value"=>$args->regdate,"pipe"=>"and","operation"=>"more",),
array("column"=>"regdate", "value"=>$args->rev_regdate,"pipe"=>"and","operation"=>"less",),
array("column"=>"update_order", "value"=>$args->update_order,"pipe"=>"and","operation"=>"less",),
array("column"=>"update_order", "value"=>$args->rev_update_order,"pipe"=>"and","operation"=>"more",),
)),
 );
return $output; ?>