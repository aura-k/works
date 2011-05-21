<?php if(!defined("__ZBXE__")) exit();?>
<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/board/tpl/','header.html');
?>


<?php @print($__Context->category_content);?>
