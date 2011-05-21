<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "comment.insertCommentList";
$output->action = "insert";
$output->column_type["comment_srl"] = "number";
$output->column_type["document_srl"] = "number";
$output->column_type["head"] = "number";
$output->column_type["arrange"] = "number";
$output->column_type["module_srl"] = "number";
$output->column_type["regdate"] = "date";
$output->column_type["depth"] = "number";
$output->tables = array( "comments_list"=>"comments_list", );
$output->_tables = array( "comments_list"=>"comments_list", );
$output->columns = array ( array("name"=>"comment_srl","alias"=>"","value"=>$args->comment_srl),
array("name"=>"document_srl","alias"=>"","value"=>$args->document_srl),
array("name"=>"head","alias"=>"","value"=>$args->head),
array("name"=>"arrange","alias"=>"","value"=>$args->arrange),
array("name"=>"module_srl","alias"=>"","value"=>$args->module_srl),
array("name"=>"regdate","alias"=>"","value"=>$args->regdate),
array("name"=>"depth","alias"=>"","value"=>$args->depth),
 );
return $output; ?>