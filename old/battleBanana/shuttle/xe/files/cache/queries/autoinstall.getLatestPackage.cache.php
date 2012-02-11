<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "autoinstall.getLatestPackage";
$output->action = "select";
$output->column_type["package_srl"] = "number";
$output->column_type["category_srl"] = "number";
$output->column_type["path"] = "varchar";
$output->column_type["updatedate"] = "date";
$output->column_type["latest_item_srl"] = "number";
$output->column_type["version"] = "varchar";
$output->tables = array( "packages"=>"autoinstall_packages", );
$output->_tables = array( "packages"=>"autoinstall_packages", );
$output->columns = array ( array("name"=>"*","alias"=>""),
 );
$output->order = array(array($args->sort_index?$args->sort_index:"updatedate",in_array($args->desc,array("asc","desc"))?$args->desc:("desc"?"desc":"asc")),);
$output->list_count = array("var"=>"list_count", "value"=>$args->list_count?$args->list_count:"1");
$output->page_count = array("var"=>"page_count", "value"=>$args->page_count?$args->page_count:"1");
$output->page = array("var"=>"page", "value"=>$args->page?$args->page:"");
return $output; ?>