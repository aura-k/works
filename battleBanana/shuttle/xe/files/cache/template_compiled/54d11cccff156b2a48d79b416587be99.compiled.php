<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/layout/tpl/filter/","update_layout_code.xml");
$oXmlFilter->compile();
?>

<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/layout/tpl/filter/","reset_layout_code.xml");
$oXmlFilter->compile();
?>


<?php
$oTemplate = &TemplateHandler::getInstance();
print $oTemplate->compile('./modules/layout/tpl/','header.html');
?>

<h3 class="xeAdmin"><?php @print($__Context->selected_layout->layout_title);?></h3>

<div class="header4">
    <ul class="localNavigation">
        <li><a href="<?php @print(getUrl('act','dispLayoutAdminModify'));?>"><?php @print($__Context->lang->cmd_layout_management);?></a></li>
        <li class="on"><a href="#" onclick="return false;"><?php @print($__Context->lang->cmd_layout_edit);?></a></li>
    </ul>
</div>

<h4 class="xeAdmin"><?php @print($__Context->selected_layout->title);?> ver <?php @print($__Context->selected_layout->version);?> (<?php @print($__Context->selected_layout->layout);?>)</h4>
<p class="summary"><?php @print(nl2br($__Context->lang->about_layout_code));?></p>

<h4 class="xeAdmin"><?php @print($__Context->lang->layout_image_repository);?></h4>
<p class="summary"><?php @print(nl2br($__Context->lang->about_layout_image_repository));?></p>
<form action="<?php @print(Context::getRequestUri());?>" target="hidden_iframe" method="post" onsubmit="return checkFile(this)" enctype="multipart/form-data">
    <input type="hidden" name="module" value="layout" />
    <input type="hidden" name="act" value="procLayoutAdminUserImageUpload" />
    <input type="hidden" name="layout_srl" value="<?php @print($__Context->layout_srl);?>" />

    <table cellspacing="0" class="crossTable">
    <tbody>
        <tr>
            <td>
                <?php $Context->__idx[0]=0;if(count($__Context->layout_image_list))  foreach($__Context->layout_image_list as $__Context->no => $__Context->file){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
                <?php @$__Context->ext=substr(strrchr($__Context->file,'.'),1);?>
                <div class="preview_image" style="width:100px;height:100px;float:left; position:relative;margin-right:10px; ">
                    <?php  if($__Context->ext=='swf'||$__Context->ext=='flv'){ ?>
                    <script type="text/javascript">//<![CDATA[
                    displayMultimedia('<?php @print(getUrl(''));?><?php @print($__Context->layout_image_path);?><?php @print($__Context->file);?>', '100%', '100%');
                    //]]></script>
                    <?php  }elseif(in_array($__Context->ext,array('gif','png','jpg','jpeg'))){ ?>
                        <img src="<?php @print(getUrl(''));?><?php @print($__Context->layout_image_path);?><?php @print($__Context->file);?>" width="100%" height="100%" />
                    <?php  } ?>
                    <a href="#" onclick="deleteFile(<?php @print($__Context->layout_srl);?>,'<?php @print($__Context->file);?>');return false" onmouseover="jQuery('div.imagePath').html('<?php @print($__Context->layout_image_path);?><?php @print($__Context->file);?>')" style="position:absolute; left:3px; top:3px;" class="small button red"><span><?php @print($__Context->lang->cmd_delete);?></span></a>
                </div>
                <?php  } ?>
                &nbsp;
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="imagePath"></div>
                <input name="user_layout_image" type="file" />
                <span class="button black strong"><button type="submit"><?php @print($__Context->lang->cmd_save);?></button></span>
                <?php @print($__Context->lang->msg_layout_image_target);?>
            </td>
        </tr>
    </tfoot>
    </table>
</form>


<?php  if($__Context->selected_layout->type=='faceoff'){ ?>
<h4 class="xeAdmin"><?php @print($__Context->lang->layout_migration);?></h4>
<p class="summary"><?php @print(nl2br($__Context->lang->about_layout_migration));?></p>
<table cellspacing="0" class="rowTable">
<tr>
    <th scope="row"><div><?php @print($__Context->lang->layout_export);?></div></th>
    <td>
        <a href="<?php @print(getUrl('','act','procLayoutAdminUserLayoutExport','layout_srl',$__Context->layout_srl));?>" class="button black strong"><span><?php @print($__Context->lang->layout_btn_export);?></span></a>
        <p><?php @print($__Context->lang->about_layout_export);?></p>
    </td>
</tr>
<tr>
    <th scope="row"><div><?php @print($__Context->lang->layout_import);?></div></th>
    <td>
        <form action="<?php @print(getUrl(''));?>" method="post" enctype="multipart/form-data" target="hidden_iframe">
            <input type="hidden" name="module" value="layout" />
            <input type="hidden" name="act" value="procLayoutAdminUserLayoutImport" />
            <input type="hidden" name="layout_srl" value="<?php @print($__Context->layout_srl);?>" />
            <input type="file" name="file" />
            <span class="button black strong"><button type="submit"><?php @print($__Context->lang->cmd_submit);?></button></span>
        </form>
        <p><?php @print($__Context->lang->about_layout_import);?></p>
    </td>
</tr>
</table>
<?php  } ?>


<form id="fo_layout" action="<?php @print(getUrl('','module','admin'));?>" method="post">
<input type="hidden" name="layout_srl" value="<?php @print($__Context->layout_srl);?>" />
<input type="hidden" name="act" value="procLayoutAdminCodeUpdate" />
<input type="hidden" name="_filter" value="update_layout_code" />
<input type="hidden" name="_return_url" value="<?php @print(htmlspecialchars($__Context->current_url));?>" />

<table cellspacing="0" class="rowTable">
<tbody>
    <tr><th class="title">HTML</th></tr>
    <tr>
        <td>
            <textarea name="code" style="width:100%;height:300px;font-size:11px;"><?php @print(htmlspecialchars($__Context->layout_code));?></textarea>
            <?php $Context->__idx[1]=0;if(count($__Context->widget_list))  foreach($__Context->widget_list as $__Context->widget){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
            <a href="<?php @print(getUrl('','module','widget','act','dispWidgetGenerateCode','selected_widget',$__Context->widget->widget,'module_srl',$__Context->module_srl));?>" onclick="popopen(this.href,'GenerateCodeInPage');return false;" class="button"><span><?php @print($__Context->widget->title);?></span></a>
            <?php  } ?>
        </td>
    </tr>
    <tr><th class="title">CSS</th></tr>
    <tr>
        <td>
            <textarea name="code_css" style="width:100%;height:300px;font-size:11px;"><?php @print(htmlspecialchars($__Context->layout_code_css));?></textarea>
        </td>
    </tr>
    <tr>
        <th class="button">
			<span class="button black strong"><button type="submit" onclick="this.form.act.value='procLayoutAdminCodeUpdate'"><?php @print($__Context->lang->cmd_save);?></button></span>
			<span class="button"><button type="button" onclick="doPreviewLayoutCode();"><?php @print($__Context->lang->cmd_preview);?></button></span>
			<span class="button red"><button type="reset" onclick="doResetLayoutCode('<?php @print($__Context->layout_srl);?>')"><?php @print($__Context->lang->cmd_reset);?></button></span>
        </th>
    </tr>
</tbody>
</table>
</form>

<iframe name="hidden_iframe" style="width:0;height:0;border:0" ></iframe>
