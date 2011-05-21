<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/editor/components/image_link/tpl/popup.js--><?php Context::addJsFile("modules/editor/components/image_link/tpl/popup.js", true, ""); ?>
<!--Meta:modules/editor/components/image_link/tpl/popup.css--><?php Context::addCSSFile("modules/editor/components/image_link/tpl/popup.css", true, "all", ""); ?>
<?php Context::loadLang("modules/editor/components/image_link/tpl/../lang"); ?>

<div id="popHeader">
    <h3 class="xeAdmin"><?php @print($__Context->component_info->title);?> ver. <?php @print($__Context->component_info->version);?></h3>
</div>

<form action="./" method="get" onSubmit="return false" id="fo">

    <div id="popBody">
        <table cellspacing="0" class="rowTable">
        <col width="100" />
        <col />

        <tr>
            <th scope="row"><div><?php @print($__Context->lang->image_url);?></div></th>
            <td><input type="text" id="image_url" value="<?php @print(url_decode($__Context->manual_url));?>" onblur="getImageScale();" class="inputTypeText w400" /></td>
        </tr>
        <tr>
            <th scope="row"><div><?php @print($__Context->lang->image_scale);?></div></th>
            <td>
                <ul>
                    <li><input type="text" id="width" value="0" size="4" class="inputTypeText" onblur="setScale('width');return false;" />px </li>
                    <li><input type="text" id="height" value="0" size="4" class="inputTypeText" onblur="setScale('height');return false;" />px </li>
                    <li><a href="#" onclick="getImageScale(); return false;" class="button"><span><?php @print($__Context->lang->cmd_get_scale);?></span></a></li>
                </ul>
            </td>
        </tr>
        <tr>
            <th scope="row"><div>URL</div></th>
            <td><input type="text" id="link_url" value="" class="inputTypeText w400"/></td>
        </tr>
        <tr>
            <th scope="row"><div><?php @print($__Context->lang->urllink_open_window);?></div></th>
            <td><input type="checkbox" id="open_window" value="Y" /> <?php @print($__Context->lang->about_url_link_open_window);?></td>
        </tr>
        <tr>
            <th scope="row"><div><?php @print($__Context->lang->image_alt);?></div></th>
            <td><input type="text" id="image_alt" value="" class="inputTypeText w400"/></td>
        </tr>
        <tr>
            <th scope="row"><div><?php @print($__Context->lang->image_align);?></div></th>
            <td>
                <div class="image_align">
                    <input type="radio" name="align" value="" id="align_normal" checked="checked"/>
                    <label for="align_normal">
                        <img src="/xe/modules/editor/components/image_link/tpl/images/align_normal.gif" alt="<?php @print($__Context->lang->image_align_normal);?>" />
                        <?php @print($__Context->lang->image_align_normal);?>
                    </label>
                </div>

                <div class="image_align">
                    <input type="radio" name="align" value="left" id="align_left" />
                    <label for="align_left">
                        <img src="/xe/modules/editor/components/image_link/tpl/images/align_left.gif" alt="<?php @print($__Context->lang->image_align_left);?>" />
                        <?php @print($__Context->lang->image_align_left);?>
                    </label>
                </div>

                <div class="image_align">
                    <input type="radio" name="align" value="middle" id="align_middle" />
                    <label for="align_middle">
                        <img src="/xe/modules/editor/components/image_link/tpl/images/align_middle.gif" alt="<?php @print($__Context->lang->image_align_middle);?>" />
                        <?php @print($__Context->lang->image_align_middle);?>
                    </label>
                </div>

                <div class="image_align">
                    <input type="radio" name="align" value="right" id="align_right" />
                    <label for="align_right">
                        <img src="/xe/modules/editor/components/image_link/tpl/images/align_right.gif" alt="<?php @print($__Context->lang->image_align_right);?>" />
                        <?php @print($__Context->lang->image_align_right);?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row"><div><?php @print($__Context->lang->image_border);?></div></th>
            <td><input type="text" id="image_border" value="0" size="2" class="inputTypeText" />px</td>
        </tr>
        <tr>
            <th scope="row"><div><?php @print($__Context->lang->image_margin);?></div></th>
            <td><input type="text" id="image_margin" value="0" size="2" class="inputTypeText" />px</td>
        </tr>
        </table>
    </div>
    <div id="popFooter" class="tCenter">
        <a href="#" onclick="insertImage()" class="button black strong"><span><?php @print($__Context->lang->cmd_insert);?></span></a>
        <a href="#" onclick="winopen('./?module=editor&amp;act=dispEditorComponentInfo&amp;component_name=<?php @print($__Context->component_info->component_name);?>','ComponentInfo','left=10,top=10,width=10,height=10,resizable=no,scrollbars=no,toolbars=no');return false;" class="button"><span><?php @print($__Context->lang->about_component);?></span></a>
    </div>

</form>
