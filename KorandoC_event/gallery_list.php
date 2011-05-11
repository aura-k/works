<?
	$page = $_GET['page'];
	$paging = null;
	
	if($_GET['page'] == "" || $_GET['page'] == null){
	 $page = 1;
	}


	 for($i = 0; $i < 9; $i++){
		 if($page == 6 && $i == 4) break;
		 echo '<div class="img_bg"><a href="photos/big/'.(($i+1)+(($page-1)*9)).'_big.png" class="lightboxView" rel="group1" title="IMAGE'.(($i+1)+(($page-1)*9)).'"><img src="photos/small/'.(($i+1)+(($page-1)*9)).'_small.png" width="124" height="80"></a></div>';
	 }

	 $paging = '<div style="clear: both; text-align:center; width:460px">';
	 for($i = 1; $i < 7; $i++){
		 if($i == $page){
			$paging .= '&nbsp<span style="color:#000; font-weight: bold">'.$i.'</span>&nbsp';
		 }else{
			$paging .= '&nbsp<a style="color:#999;cursor:pointer;" onclick="go_page('.$i.')">'.$i.'</a>&nbsp';
		 }
	 }
	  $paging .= '</div>';

	  echo $paging;
?>