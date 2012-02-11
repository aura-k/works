<?//서브페이지의 각종 액션들 스크립팅
	include "popCheckLoged.php";
	include "connect.php";
	include "define_battle.php";
	
	$sql=mysql_query("select * from BBanana_items where item_id='".$_GET['sid']."'") or die(mysql_error());
	$row=mysql_fetch_array($sql);

	$sql2=mysql_query("select * from BBanana_autobids where item_id='".$_GET['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
	$row2=mysql_fetch_array($sql2);
	
	if(!$row2) $auto_banana=0;
	else $auto_banana = $row2['auto_banana'];
?>