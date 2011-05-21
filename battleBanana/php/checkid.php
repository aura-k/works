<?
   include("../connect.php");
   mysql_query("set names utf8");
   session_cache_limiter(''); 
   session_start(); 

   if($_GET["id"] && !$_GET["email"]){
	   $sql = "select * from BBanana_users where user_id='".$_GET["id"]."'";
	   $sql_stat = mysql_query($sql) or die(mysql_error());
	   $row=mysql_fetch_array($sql_stat);
	   if(!$row)
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
	   $sql = "select * from BBanana_users where email='".$_GET["email"]."'";
	   $sql_stat = mysql_query($sql) or die(mysql_error());
	   $row=mysql_fetch_array($sql_stat);
	   if(!$row)
		  $ret = true;
	   else
		  $ret = false;

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