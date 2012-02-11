<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "comment.getCommentPageList";
$output->action = "select";
if(!isset($args->document_srl)) return new Object(-1, sprintf($lang->filter->isnull, $lang->document_srl?$lang->document_srl:'document_srl'));
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
$output->column_type["comment_srl"] = "number";
$output->column_type["document_srl"] = "number";
$output->column_type["head"] = "number";
$output->column_type["arrange"] = "number";
$output->column_type["module_srl"] = "number";
$output->column_type["regdate"] = "date";
$output->column_type["depth"] = "number";
$output->tables = array( "comments"=>"comments","comments_list"=>"comments_list", );
$output->_tables = array( "comments"=>"comments","comments_list"=>"comments_list", );
$output->columns = array ( array("name"=>"comments.*","alias"=>""),
array("name"=>"comments_list.depth","alias"=>"depth"),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"comments_list.document_srl", "value"=>$args->document_srl,"pipe"=>"and","operation"=>"equal",),
array("column"=>"comments_list.comment_srl", "value"=>"comments.comment_srl","pipe"=>"and","operation"=>"equal",),
array("column"=>"comments_list.head", "value"=>"0","pipe"=>"and","operation"=>"more",),
array("column"=>"comments_list.arrange", "value"=>"0","pipe"=>"and","operation"=>"more",),
)),
 );
$output->order = array(array($args->list_order?$args->list_order:"comments_list.head",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),array($args->list_order?$args->list_order:"comments_list.arrange",in_array($args->asc,array("asc","desc"))?$args->asc:("asc"?"asc":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"list_count");
$output->page_count = array("var"=>"page_count", "value"=>$args->page_count?$args->page_count:"list_count");
$output->page = array("var"=>"page", "value"=>$args->page?$args->page:"");
return $output; ?>