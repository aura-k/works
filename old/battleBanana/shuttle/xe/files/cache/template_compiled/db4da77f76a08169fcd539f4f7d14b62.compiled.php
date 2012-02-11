<?php if(!defined("__ZBXE__")) exit();?>
<script type="text/javascript">
    <?php  if($__Context->redirect_url){ ?>
    location.href = "<?php @print($__Context->redirect_url);?>";
    <?php  }else{ ?>
    location.href = current_url.setQuery('act','');
    <?php  } ?>
</script>
