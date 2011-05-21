<?php if(!defined("__ZBXE__")) exit();?>
<!--Meta:modules/editor/tpl/css/editor.css--><?php Context::addCSSFile("modules/editor/tpl/css/editor.css", true, "all", ""); ?>
<!--Meta:modules/editor/tpl/../../../modules/admin/tpl/css/admin.css--><?php Context::addCSSFile("modules/editor/tpl/../../../modules/admin/tpl/css/admin.css", true, "all", ""); ?>

<div id="popHeader" class="wide">
    <h3 class="xeAdmin"><?php @print($__Context->component->title);?> ver. <?php @print($__Context->component->version);?></h3>
</div>

<div id="popBody">
    <table cellspacing="0" class="rowTable">
    <tr class="row2">
        <th scope="row"><div><?php @print($__Context->lang->component_author);?></div></th>
        <td>
            <?php $Context->__idx[0]=0;if(count($__Context->component->author))  foreach($__Context->component->author as $__Context->author){$__Context->__idx[1]=($__Context->__idx[1]+1)%2; $__Context->cycle_idx = $__Context->__idx[1]+1; ?>
            <?php @print($__Context->author->name);?> <?php  if($__Context->author->homepage || $__Context->author->email_address){ ?>(<?php  if($__Context->author->homepage){ ?><a href="<?php @print($__Context->author->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->author->homepage);?></a><?php  } ?><?php  if($__Context->author->homepage && $__Context->author->email_address){ ?>, <?php  } ?><?php  if($__Context->author->email_address){ ?><a href="mailto:<?php @print($__Context->author->email_address);?>"><?php @print($__Context->author->email_address);?></a><?php  } ?>)<?php  } ?><br />
            <?php  } ?>
    </tr>
<?php  if($__Context->component->homepage){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->homepage);?></div></th>
        <td class="blue"><a href="<?php @print($__Context->component->homepage);?>" onclick="window.open(this.href);return false;"><?php @print($__Context->component->homepage);?></a></td>
    </tr><?php  } ?>
    <tr class="row2">
        <th scope="row"><div><?php @print($__Context->lang->regdate);?></div></th>
        <td><?php @print(zdate(str_replace('-',"",$__Context->component->date), 'Y-m-d'));?></td>
    </tr>
<?php  if($__Context->component->license || $__Context->component->license_link){ ?>
    <tr>
        <th scope="row"><div><?php @print($__Context->lang->component_license);?></div></th>
        <td>
            <?php @print(nl2br(trim($__Context->component->license)));?>
        <?php  if($__Context->component->license_link){ ?>
            <p><a href="<?php @print($__Context->component->license_link);?>" onclick="window.close(); return false;"><?php @print($__Context->component->license_link);?></a></p>
        <?php  } ?>
        </td>
    </tr><?php  } ?>
<?php  if($__Context->component->description){ ?>
    <tr class="row2">
        <th scope="row"><div><?php @print($__Context->lang->component_description);?></div></th>
        <td><?php @print(nl2br(trim($__Context->component->description)));?></td>
    </tr><?php  } ?>
    </table>
</div>

<?php  if($__Context->component->history){ ?>
<div id="popHistoryHeadder">
    <h3 class="xeAdmin"><?php @print($__Context->lang->component_history);?></h3>
</div>

<div id="popHistoryBody">
    <table cellspacing="0" class="rowTable">
    <?php $Context->__idx[1]=0;if(count($__Context->component->history))  foreach($__Context->component->history as $__Context->history){$__Context->__idx[2]=($__Context->__idx[2]+1)%2; $__Context->cycle_idx = $__Context->__idx[2]+1; ?>
    <tr class="row<?php @print($__Context->cycle_idx);?>">
        <th scope="row"><div>
            <?php @print($__Context->history->version);?><br />
            <?php @print(zdate($__Context->history->date, 'Y-m-d'));?>
        </div></th>
        <td class="wide">
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
                    <li><a href="<?php @print($__Context->log->link);?>" onclick="window.close(); return false;"><?php @print($__Context->log->text);?></a></li>
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
