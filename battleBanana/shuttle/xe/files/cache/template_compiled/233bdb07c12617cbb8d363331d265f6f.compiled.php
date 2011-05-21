<?php if(!defined("__ZBXE__")) exit();?>
<?php
require_once("./classes/xml/XmlJsFilter.class.php");
$oXmlFilter = new XmlJSFilter("modules/editor/tpl/filter/","insert_editor_module_config.xml");
$oXmlFilter->compile();
?>

<!--Meta:modules/editor/tpl/js/editor_module_config.js--><?php Context::addJsFile("modules/editor/tpl/js/editor_module_config.js", true, ""); ?>

<form action="./" method="post" onsubmit="return procFilter(this, insert_editor_module_config)">
<input type="hidden" name="target_module_srl" value="<?php @print($__Context->module_info->module_srl?$__Context->module_info->module_srl:$__Context->module_srls);?>" />
    <h4 class="xeAdmin"><?php @print($__Context->lang->editor);?></h4>
    <table cellspacing="0" class="crossTable">
    <thead>
    <tr>
        <th scope="col"><div>&nbsp;</div></th>
        <th scope="col" class="half_wide"><div><?php @print($__Context->lang->document);?></div></th>
        <th scope="col" class="half_wide"><div><?php @print($__Context->lang->comment);?></div></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->editor_skin);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_editor_skin);?></p></td>
    </tr>
    <tr>
        <td>
            <select name="editor_skin" onchange="getEditorSkinColorList(this.value, null, 'document')">
            <?php $Context->__idx[0]=0;if(count($__Context->editor_skin_list))  foreach($__Context->editor_skin_list as $__Context->editor){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <option value="<?php @print($__Context->editor);?>" <?php  if($__Context->editor==$__Context->editor_config->editor_skin){ ?>selected="selected"<?php  } ?>><?php @print($__Context->editor);?></option>
            <?php  } ?>
            </select>
            <br/>
            <select name="sel_editor_colorset" id="sel_editor_colorset"<?php  if(!count($__Context->editor_colorset_list)){ ?> style="display:none"<?php  } ?>>
                <?php $Context->__idx[1]=0;if(count($__Context->editor_colorset_list))  foreach($__Context->editor_colorset_list as $__Context->key => $__Context->val){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
                    <option value="<?php @print($__Context->val->name);?>" <?php  if($__Context->editor_config->sel_editor_colorset == $__Context->val->name){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                <?php  } ?>
            </select>
        </td>
        <td>
            <select name="comment_editor_skin" onchange="getEditorSkinColorList(this.value, null, 'comment')">
            <?php $Context->__idx[2]=0;if(count($__Context->editor_skin_list))  foreach($__Context->editor_skin_list as $__Context->editor){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
            <option value="<?php @print($__Context->editor);?>" <?php  if($__Context->editor==$__Context->editor_config->comment_editor_skin){ ?>selected="selected"<?php  } ?>><?php @print($__Context->editor);?></option>
            <?php  } ?>
            </select>
            <br/>
            <select name="sel_comment_editor_colorset" id="sel_comment_editor_colorset"<?php  if(!count($__Context->editor_comment_colorset_list)){ ?> style="display:none"<?php  } ?>>
                <?php $Context->__idx[3]=0;if(count($__Context->editor_comment_colorset_list))  foreach($__Context->editor_comment_colorset_list as $__Context->key => $__Context->val){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
                    <option value="<?php @print($__Context->val->name);?>" <?php  if($__Context->editor_config->sel_comment_editor_colorset == $__Context->val->name){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
                <?php  } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->content_style);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_content_style);?></p></td>
    </tr>
    <tr>
        <td>
            <select name="content_style">
            <?php $Context->__idx[4]=0;if(count($__Context->content_style_list))  foreach($__Context->content_style_list as $__Context->key => $__Context->val){$__Context->__idx[5]=($__Context->__idx[5]+1)%2; $__Context->cycle_idx = $__Context->__idx[5]+1; ?>
            <option value="<?php @print($__Context->key);?>" <?php  if($__Context->key==$__Context->editor_config->content_style||!$__Context->editor_config->content_style&&$__Context->key=='default'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
            <?php  } ?>
            </select>
        </td>
        <td>
            <select name="comment_content_style">
            <?php $Context->__idx[5]=0;if(count($__Context->content_style_list))  foreach($__Context->content_style_list as $__Context->key => $__Context->val){$__Context->__idx[6]=($__Context->__idx[6]+1)%2; $__Context->cycle_idx = $__Context->__idx[6]+1; ?>
            <option value="<?php @print($__Context->key);?>" <?php  if($__Context->key==$__Context->editor_config->comment_content_style||!$__Context->editor_config->comment_content_style&&$__Context->key=='default'){ ?>selected="selected"<?php  } ?>><?php @print($__Context->val->title);?></option>
            <?php  } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->content_font);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_content_font);?></p></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="text" name="content_font" value="<?php @print(str_replace(array('"','\''),'',$__Context->editor_config->content_font));?>" class="inputTypeText w400" />
        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->content_font_size);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_content_font_size);?></p></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="text" name="content_font_size" value="<?php @print($__Context->editor_config->content_font_size);?>" class="inputTypeText w80" />
        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->editor_height);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_editor_height);?></p></td>
    </tr>
    <tr>
        <td>
            <input type="text" name="editor_height" value="<?php @print($__Context->editor_config->editor_height);?>" class="inputTypeText w80" />px
        </td>
        <td>
            <input type="text" name="comment_editor_height" value="<?php @print($__Context->editor_config->comment_editor_height);?>" class="inputTypeText w80" />px
        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->enable_autosave);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_enable_autosave);?></p></td>
    </tr>
    <tr>
        <td colspan="2"><input type="checkbox" value="Y" name="enable_autosave" <?php  if($__Context->editor_config->enable_autosave=='Y'){ ?>checked="checked"<?php  } ?>/></td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->enable_html_grant);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_enable_html_grant);?></p></td>
    </tr>
    <tr>
        <td>
            <?php $Context->__idx[6]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[7]=($__Context->__idx[7]+1)%2; $__Context->cycle_idx = $__Context->__idx[7]+1; ?>
            <input type="checkbox" name="enable_html_grant" value="<?php @print($__Context->k);?>" id="enable_html_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->enable_html_grant)){ ?>checked="checked"<?php  } ?>/> <label for="enable_html_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>
            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('enable_html_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('enable_html_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>
        </td>
        <td>
            <?php $Context->__idx[7]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[8]=($__Context->__idx[8]+1)%2; $__Context->cycle_idx = $__Context->__idx[8]+1; ?>
            <input type="checkbox" name="enable_comment_html_grant" value="<?php @print($__Context->k);?>" id="enable_comment_html_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->enable_comment_html_grant)){ ?>checked="checked"<?php  } ?>/> <label for="enable_comment_html_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>
            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('enable_comment_html_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('enable_comment_html_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>
        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->upload_file_grant);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_upload_file_grant);?></p></td>
    </tr>
    <tr>
        <td>
            <?php $Context->__idx[8]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[9]=($__Context->__idx[9]+1)%2; $__Context->cycle_idx = $__Context->__idx[9]+1; ?>
            <input type="checkbox" name="upload_file_grant" value="<?php @print($__Context->k);?>" id="fileupload_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->upload_file_grant)){ ?>checked="checked"<?php  } ?>/> <label for="fileupload_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>

            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('upload_file_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('upload_file_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>

        </td>
        <td>
            <?php $Context->__idx[9]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[10]=($__Context->__idx[10]+1)%2; $__Context->cycle_idx = $__Context->__idx[10]+1; ?>
            <input type="checkbox" name="comment_upload_file_grant" value="<?php @print($__Context->k);?>" id="comment_fileupload_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->comment_upload_file_grant)){ ?>checked="checked"<?php  } ?>/> <label for="comment_fileupload_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>

            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('comment_upload_file_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('comment_upload_file_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>

        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->enable_default_component_grant);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_default_component_grant);?></p></td>
    </tr>
    <tr>
        <td>
            <?php $Context->__idx[10]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[11]=($__Context->__idx[11]+1)%2; $__Context->cycle_idx = $__Context->__idx[11]+1; ?>
            <input type="checkbox" name="enable_default_component_grant" value="<?php @print($__Context->k);?>" id="default_componen_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->enable_default_component_grant)){ ?>checked="checked"<?php  } ?>/> <label for="default_componen_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>
            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('enable_default_component_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('enable_default_component_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>
        </td>
        <td>
            <?php $Context->__idx[11]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[12]=($__Context->__idx[12]+1)%2; $__Context->cycle_idx = $__Context->__idx[12]+1; ?>
            <input type="checkbox" name="enable_comment_default_component_grant" value="<?php @print($__Context->k);?>" id="comment_default_component_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->enable_comment_default_component_grant)){ ?>checked="checked"<?php  } ?>/> <label for="comment_default_component_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>

            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('enable_comment_default_component_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('enable_comment_default_component_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>

        </td>
    </tr>
    <tr>
        <th rowspan="2"><div><?php @print($__Context->lang->enable_component_grant);?></div></th>
        <td colspan="2"><p><?php @print($__Context->lang->about_component_grant);?></p></td>
    </tr>
    <tr>
        <td>
            <?php $Context->__idx[12]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[13]=($__Context->__idx[13]+1)%2; $__Context->cycle_idx = $__Context->__idx[13]+1; ?>
            <input type="checkbox" name="enable_component_grant" value="<?php @print($__Context->k);?>" id="componen_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->enable_component_grant)){ ?>checked="checked"<?php  } ?>/> <label for="componen_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>

            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('enable_component_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('enable_component_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>

        </td>
        <td>
            <?php $Context->__idx[13]=0;if(count($__Context->group_list))  foreach($__Context->group_list as $__Context->k => $__Context->v){$__Context->__idx[14]=($__Context->__idx[14]+1)%2; $__Context->cycle_idx = $__Context->__idx[14]+1; ?>
            <input type="checkbox" name="enable_comment_component_grant" value="<?php @print($__Context->k);?>" id="comment_component_<?php @print($__Context->k);?>" <?php  if(in_array($__Context->k, $__Context->editor_config->enable_comment_component_grant)){ ?>checked="checked"<?php  } ?>/> <label for="comment_component_<?php @print($__Context->k);?>"><?php @print($__Context->v->title);?></label>
            <?php  } ?>
            <br/>

            <span class="button small green"><input type="button" onclick="XE.checkboxToggleAll('enable_comment_component_grant',{ checked:true});return false" value="<?php @print($__Context->lang->cmd_select_all);?>" /></span>
            <span class="button small red"><input type="button" onclick="XE.checkboxToggleAll('enable_comment_component_grant',{ checked:false});return false" value="<?php @print($__Context->lang->cmd_unselect_all);?>" /></span>

        </td>
    </tr>
    <tr>
        <th class="button" colspan="3">
            <span class="button black strong"><input type="submit" value="<?php @print($__Context->lang->cmd_save);?>"/></span>
        </th>
    </tr>
    </tbody>
    </table>

</form>
