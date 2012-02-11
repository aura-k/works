<?session_start(); ?>
<table width="100%" border="0">
<?		
		  include "../connect.php";
			if(!$_SESSION['ID']){
				echo('로그인이 필요합니다.');
				return;
			}
		  $page_scale = 5;//한페이지당 보일 목록의 갯수
			
		  function pagecount(){
			$sql=mysql_query("select COUNT(no) as cnt from BBanana_qnas where user_id ='".$_SESSION['ID']."'") or die(mysql_error());
			$row=mysql_fetch_array($sql);
		    
			return $row['cnt'];
		  }
		  
		  if($_GET['p'] == null) $_GET['p'] = 0;

		  $sql=mysql_query("select * from BBanana_qnas where user_id = '".$_SESSION['ID']."' order by no DESC limit ".($_GET['p']*$page_scale).", ".$page_scale) or die(mysql_error()); 			
	
			$i=0;
			$cnt=0;
			while($row=mysql_fetch_array($sql)){
?>
          <tr>
            <td>
                <div class="title"><?=date('Y.m.d A h:i:s', $row['qna_created'])?> / <?=$row['qna_title']?>&nbsp;&nbsp;&nbsp;<a onclick="del_customer('<?=$row['no']?>')" style="cursor:pointer;">삭제</a></div>            </td>
          </tr>
          <tr>
            <td class="content">
            <div class="cus_q">
            <?=$row['qna_text']?>
            </div>
				<p>&nbsp;</p>
                <?
				if($row['qna_answer'] != ""){
				?>
				<div class="cus_a">
                <p><b>안녕하세요. 배틀바나나입니다.</b></p>
                <p><?=$row['qna_answer']?></p></div>
				<?
				}
				?>
				</td>
          </tr>
          <tr>
            <td class="boundary"></td>
          </tr>
<?
			}	
?>
		  <tr align="center" height="30px">
				<td>
					<table><tr>
<?
$qna_cnt = pagecount();
if ($qna_cnt%$page_scale == 0)    
      $qna_pcnt = floor($qna_cnt/$page_scale)-1;     
   else
      $qna_pcnt = floor($qna_cnt/$page_scale);

for($i=0;$i<=$qna_pcnt;$i++){
		if($_GET['p'] == $i) echo "<td width='10'><div class='sub_photo_num_".$i."'><img src='../img/btn_page_thumb_s_g.gif' border='0'/></div></td>";
		else echo "<td width='10'><div class='sub_photo_num_".$i."'><a href='#' onmousedown='load_customer(".$i.")' style='cursor:pointer'><img src='../img/btn_page_thumb.gif' name='btn_thumb".$i."' id='btn_thumb".$i."' onmouseover=javascript:btn_thumb".$i.".src='../img/btn_page_thumb_o.gif'; onmouseout=javascript:btn_thumb".$i.".src='../img/btn_page_thumb.gif'; border='0'/></a></div></td>";
	}

	mysql_close($connect);
?>
					</tr></table>
				</td>
		  </tr>
		</table>