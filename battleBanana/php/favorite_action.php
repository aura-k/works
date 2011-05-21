<? 
session_cache_limiter(''); 
session_start();

if(!$_SESSION['ID']){
	echo("로그인하여 주세요.");
	return;
}

include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 

if($_POST['type'] == "make"){
	$str = "SELECT * FROM  `BBanana_favorites` where user_id = '".$_SESSION['ID']."' and item_id='".$_POST['sid']."'";
	$sql = mysql_query($str) or die(mysql_error()); 
	$row = mysql_fetch_array($sql);
	if($row){
		echo "이미 관심경매인 품목입니다.";
		return;
	}

	$str = "INSERT INTO `BBanana_favorites`(`user_id`, `item_id`, `created_date`) VALUES ('".$_SESSION['ID']."', '".$_POST['sid']."', '".mktime()."');";
	$sql = mysql_query($str) or die(mysql_error()); 

	if(!$sql){ 
		echo("관심경매 등록실패");
	}else{
		echo("관심경매에 등록하였습니다.");
	}
	mysql_close($connect);
	return;
}else if($_POST['type'] == "del"){
	$str = "DELETE from `BBanana_favorites` where  item_id='".$_POST['sid']."'";
	$sql = mysql_query($str) or die(mysql_error()); 

	if(!$sql){ 
		echo("관심경매 삭제실패");
	}

	mysql_close($connect);
	return;
}
?>