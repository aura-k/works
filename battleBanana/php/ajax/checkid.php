<?
   include("../connect.php");
   session_cache_limiter(''); 
   session_start(); 

   if($_GET["id"] && !$_GET["email"]){
	   $sql = "select * from BBanana_users where user_id='".$_GET["id"]."'";
	   $sql_stat = mysql_query($sql) or die(mysql_error());
	   $row=mysql_fetch_array($sql_stat);

	   $sql2 = "select * from BBanana_drops where user_id='".$_GET["id"]."'";
	   $sql_stat2 = mysql_query($sql2) or die(mysql_error());
	   $row2=mysql_fetch_array($sql_stat2);

	   if(!$row && !$row2)
		  $ret = true;
	   else
		  $ret = false;

	   $_SESSION["access"] = $ret;
	   echo $ret;

	   return;
   }else if($_GET["name"] && $_GET["idnumber"] && $_GET["email"]){
	   $sql = "select * from BBanana_users where user_name='".$_GET["name"]."' && regi_number='".$_GET["idnumber"]."' && email='".$_GET["email"]."'";
	   $sql_stat = mysql_query($sql) or die(mysql_error());
	   $row=mysql_fetch_array($sql_stat);
	   if(!$row)
		  $ret = "failed";
	   else
		  $ret = $row[user_id];

	   $_SESSION["access"] = $ret;
	   echo $ret;

	   return;
   }else if($_GET["name"] && $_GET["idnumber"]){
	   $sql = "select * from BBanana_users where user_name='".$_GET["name"]."' && regi_number='".$_GET["idnumber"]."'";
	   $sql_stat = mysql_query($sql) or die(mysql_error());
	   $row=mysql_fetch_array($sql_stat);
	   if(!$row)
		  $ret = "failed";
	   else
		  $ret = $row[user_id];

	   $_SESSION["access"] = $ret;
	   echo $ret;

	   return;
   }else if($_GET["email"]){
	   if($_SESSION['EMAIL'] && ($_GET["email"] == $_SESSION['EMAIL'])){
			$ret = true;   
	   }else{
		   $sql = "select * from BBanana_users where email='".$_GET["email"]."'";
			$sql_stat = mysql_query($sql) or die(mysql_error());
			$row=mysql_fetch_array($sql_stat);
			if(!$row)
				$ret = true;
			else
				$ret = false;
	   }

	   $_SESSION["access"] = $ret;
	   echo $ret;

	   return;
   }else{
	   $sql = "select * from BBanana_users where regi_number='".$_GET["idnumber"]."'";
	   $sql_stat = mysql_query($sql) or die(mysql_error());
	   $row=mysql_fetch_array($sql_stat);
	   if(!$row)
		  $ret = true;
	   else
		  $ret = false;

	   $_SESSION["access"] = $ret;
	   echo $ret;

	   return;
   }
?>