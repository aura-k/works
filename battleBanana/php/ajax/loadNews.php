<?
	if($_GET['type'] == 't'){
		  include "../connect.php";
		  
		  function pagecount(){
			$sql=mysql_query("select COUNT(no) as cnt from BBanana_news") or die(mysql_error());
			$row=mysql_fetch_array($sql);
		    
			return $row['cnt'];
		  }
		  
		  if($_GET['p'] == null) $_GET['p'] = 1;

			echo"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><div class=\"select\" style=\"color:#4e7b4a;text-decoration:none;\">";

			$sql=mysql_query("select * from BBanana_news order by no DESC limit ".(($_GET['p']-1)*5).", 5") or die(mysql_error()); 			
	
			while($row=mysql_fetch_array($sql)){
				echo "<p><a onclick=\"load_news(".$row['no'].")\" style='cursor:pointer'><b>".$row['news_title']."</b> / ".date('Y.m.d A h:i', $row['news_created'])."</a></p>";
			}	

            echo "<br/><p class=\"page\">";
			
			$page_cnt = ceil(pagecount()/5);
			for($i=0;$i<$page_cnt;$i++){
				if($_GET['p'] == ($i+1)){
					if($i==($page_cnt-1)) echo "<b>".($i+1)."</b>";
					else echo "<b>".($i+1)."</b>&nbsp;|&nbsp;";
				}else{
					if($i==($page_cnt-1)) echo "<a onclick=\"load_news_title(".($i+1).")\" style='cursor:pointer'>".($i+1)."</a>";
					else echo "<a onclick=\"load_news_title(".($i+1).")\" style='cursor:pointer'>".($i+1)."</a>&nbsp;|&nbsp;";
				}
			}
			
			echo "</p></div></td></tr><tr><td class=\"boundary\"></td></tr></table>";

	mysql_close($connect);
	}else if($_GET['type'] == 's'){
		include "../connect.php";
		
		if($_GET['no'] == 0) $sql=mysql_query("select * from BBanana_news order by no DESC limit 0,1") or die(mysql_error());
		else $sql=mysql_query("select * from BBanana_news where no = '".$_GET['no']."'") or die(mysql_error());

		$row=mysql_fetch_array($sql);

		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td><div class=\"title\">".$row['news_title']." / ".date('Y.m.d A h:i:s', $row['news_created'])."</div></td>
          </tr>
          <tr>
            <td class=\"content\">".$row['news_text']."</td>
          </tr>
          <tr>
            <td class=\"boundary\"></td>
          </tr>
        </table>";

		$sql2=mysql_query("update BBanana_news set news_viewed=news_viewed+1 where no = '".$_GET['no']."'") or die(mysql_error());
		$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	}
?>