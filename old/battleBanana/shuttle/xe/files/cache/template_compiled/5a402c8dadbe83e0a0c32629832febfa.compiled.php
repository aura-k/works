<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/session/tpl/js/session.js--><?php Context::addJsFile("modules/session/tpl/js/session.js", false, ""); ?>

<h3 class="xeAdmin"><?php @print($__Context->lang->session);?> <span class="gray"><?php @print($__Context->lang->cmd_management);?></span></h3>
<div class="infoText"><?php @print(nl2br($__Context->lang->about_session));?></div>

<form action="./" method="post" onsubmit="return false;">
<div class="fr"><span class="button black strong"><input type="button" value="<?php @print($__Context->lang->cmd_clear_session);?>" onclick="doClearSession(); return false; "/></span></div>
</form>
