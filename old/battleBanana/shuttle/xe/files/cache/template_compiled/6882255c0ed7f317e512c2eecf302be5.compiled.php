<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/module/tpl/../../admin/tpl/css/admin.css--><?php Context::addCSSFile("modules/module/tpl/../../admin/tpl/css/admin.css", true, "all", ""); ?>
<div id="popHeader" class="wide">
    <h3 class="xeAdmin"><?php @print($__Context->skin_info->title);?></h3>
</div>

<div id="popBody">
    <table cellspacing="0" class="rowTable">
    <col width="100" />
    <col />
    <tr>
        <th scope="row"><label for="textfield1"><?php @print($__Context->lang->title);?></label></th>
        <td><?php @print($__Context->skin_info->title);?></td>
    </tr>
    <tr>
        <th scope="row"><label for="textfield2"><?php @print($__Context->lang->author);?></label></th>
        <td class="blue">
            <?php $Context->__idx[0]=0;if(count($__Context->skin_info->author))  foreach($__Context->skin_info->author as $__Context->author){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <?php @print($__Context->author->name);?> <?php  if($__Context->author->homepage || $__Context->author->email_address){ ?>(<?php  if($__Context->author->homepage){ ?><a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->author->homepage);?></a><?php  } ?><?php  if($__Context->author->homepage && $__Context->author->email_address){ ?>, <?php  } ?><?php  if($__Context->author->email_address){ ?><a href="mailto:<?php @print($__Context->author->email_address);?>"><?php @print($__Context->author->email_address);?></a><?php  } ?>)<?php  } ?><br />
            <?php  } ?>
        </td>
    </tr>
    <?php  if($__Context->skin_info->homepage){ ?>
    <tr>
        <th scope="row"><label for="textfield2"><?php @print($__Context->lang->homepage);?></label></th>
        <td class="blue"><a href="<?php @print($__Context->skin_info->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->skin_info->homepage);?></a></td>
    </tr>
    <?php  } ?>
    <tr>
        <th scope="row"><label for="textfield2"><?php @print($__Context->lang->regdate);?></label></th>
        <td><?php @print(zdate($__Context->skin_info->date, 'Y-m-d'));?></td>
    </tr>
    <?php  if($__Context->skin_info->license || $__Context->skin_info->license_link){ ?>
    <tr>
        <th scope="row"><?php @print($__Context->lang->skin_license);?></th>
        <td>
            <?php @print(nl2br(trim($__Context->skin_info->license)));?>
        <?php  if($__Context->skin_info->license_link){ ?>
            <p><a href="<?php @print($__Context->skin_info->license_link);?>" onclick="window.close(); return false;"><?php @print($__Context->skin_info->license_link);?></a></p>
        <?php  } ?>
        </td>
    </tr>
    <?php  } ?>
    <?php  if($__Context->skin_info->description){ ?>
    <tr>
        <th scope="row" class="borderBottomNone"><?php @print($__Context->lang->description);?></th>
        <td class="borderBottomNone"><?php @print(nl2br(trim($__Context->skin_info->description)));?></td>
    </tr>
    <?php  } ?>
    </table>
</div>

<?php  if($__Context->skin_info->history){ ?>
<div id="popHistoryHeadder">
    <h3 class="xeAdmin"><?php @print($__Context->lang->skin_history);?></h3>
</div>

<div id="popHistoryBody">
    <table cellspacing="0" class="rowTable">
    <col width="100" />
    <col />

    <?php $Context->__idx[1]=0;if(count($__Context->skin_info->history))  foreach($__Context->skin_info->history as $__Context->history){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <tr>
        <th scope="row">
            <?php @print($__Context->history->version);?><br />
            <?php @print($__Context->history->date);?>
        </th>
        <td>
            <?php $Context->__idx[2]=0;if(count($__Context->history->author))  foreach($__Context->history->author as $__Context->author){$__Context->__idx[3]=($__Context->__idx[3]+1)%2; $__Context->cycle_idx = $__Context->__idx[3]+1; ?>
            <p><?php @print($__Context->author->name);?> (<a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->author->homepage);?></a> / <a href="mailto:<?php @print($__Context->author->email_address);?>"><?php @print($__Context->author->email_address);?></a>)</p>
            <?php  } ?>
            <?php  if($__Context->history->description){ ?>
            <p><?php @print(nl2br(trim($__Context->history->description)));?></p>
            <?php  } ?>
            <?php  if($__Context->history->logs){ ?>
            <ul>
                <?php $Context->__idx[3]=0;if(count($__Context->history->logs))  foreach($__Context->history->logs as $__Context->log){$__Context->__idx[4]=($__Context->__idx[4]+1)%2; $__Context->cycle_idx = $__Context->__idx[4]+1; ?>
                <?php  if($__Context->log->link){ ?>
                <li><a href="<?php @print($__Context->log->link);?>"><?php @print($__Context->log->text);?></a></li>
                <?php  }else{ ?>
                <li><?php @print($__Context->log->text);?></li>
                <?php  } ?>
                <?php  } ?>
            </ul>
            <?php  } ?>
        </td>
    </tr>
    <?php  } ?>
    </table>
</div>
<?php  } ?>
