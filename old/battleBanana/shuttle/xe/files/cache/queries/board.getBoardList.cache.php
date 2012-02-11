<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "board.getBoardList";
$output->action = "select";
$output->column_type["module_srl"] = "number";
$output->column_type["module"] = "varchar";
$output->column_type["module_category_srl"] = "number";
$output->column_type["layout_srl"] = "number";
$output->column_type["use_mobile"] = "char";
$output->column_type["mlayout_srl"] = "number";
$output->column_type["menu_srl"] = "number";
$output->column_type["site_srl"] = "number";
$output->column_type["mid"] = "varchar";
$output->column_type["skin"] = "varchar";
$output->column_type["mskin"] = "varchar";
$output->column_type["browser_title"] = "varchar";
$output->column_type["description"] = "text";
$output->column_type["is_default"] = "char";
$output->column_type["content"] = "bigtext";
$output->column_type["mcontent"] = "bigtext";
$output->column_type["open_rss"] = "char";
$output->column_type["header_text"] = "text";
$output->column_type["footer_text"] = "text";
$output->column_type["regdate"] = "date";
$output->tables = array( "modules"=>"modules", );
$output->_tables = array( "modules"=>"modules", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->conditions = array ( array("pipe"=>"",
"condition"=>array(array("column"=>"module", "value"=>"'board','guestbook','blog'","pipe"=>"","operation"=>"in",),
)),
array("pipe"=>"and",
"condition"=>array(array("column"=>"mid", "value"=>$args->s_mid,"pipe"=>"or","operation"=>"like",),
array("column"=>"title", "value"=>$args->s_title,"pipe"=>"or","operation"=>"like",),
array("column"=>"comment", "value"=>$args->s_comment,"pipe"=>"or","operation"=>"like",),
array("column"=>"module", "value"=>$args->s_module,"pipe"=>"or","operation"=>"equal",),
array("column"=>"module_category_srl", "value"=>$args->s_module_category_srl,"pipe"=>"or","operation"=>"equal",),
)),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"module_srl",in_array($args->desc,array("asc","desc"))?$args->desc:("desc"?"desc":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"20");
$output->page_count = array("var"=>"page_count", "value"=>$args->page_count?$args->page_count:"20");
$output->page = array("var"=>"page", "value"=>$args->page?$args->page:"");
return $output; ?>