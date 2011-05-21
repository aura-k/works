<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:common/tpl/../../modules/admin/tpl/css/admin.css--><?php Context::addCSSFile("common/tpl/../../modules/admin/tpl/css/admin.css", true, "all", ""); ?>
<!--Meta:common/tpl/../../modules/admin/tpl/css/pagination.css--><?php Context::addCSSFile("common/tpl/../../modules/admin/tpl/css/pagination.css", true, "all", ""); ?>
<div id="xeAdmin">
<div id="popup_content">
    <?php @print($__Context->content);?>
    <button class="xButton" type="button" onclick="window.close();return false;"><span><?php @print($__Context->lang->cmd_close);?></span></button>
</div>
</div>
<script type="text/javascript">
	jQuery(window).load(setFixedPopupSize);
    var _isPoped = true;
</script>
