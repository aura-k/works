<? 
session_cache_limiter(''); 
session_start(); 
include "m_connect.php"; //디비 정의 페이지 
include "m_sess_func.php"; //함수 정의 페이지 include 
if(!$_SESSION['ID']){
	echo("로그인 후 이용해주세요.");
	return;
}
if($_POST['sid']){
$sql=mysql_query("select * from BBanana_autobids where item_id='".$_POST['sid']."' and bider_id='".$_SESSION['ID']."'") or die(mysql_error());
$row=mysql_fetch_array($sql);

$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
$result = @mysql_query('BEGIN');
$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

if($row && $row['auto_banana'] != 0){
	$sql2=mysql_query("SELECT SUM( banana_out ) AS banana_out FROM BBanana_bananas WHERE user_id = '".$_SESSION['ID']."' and `item_id`='".$_POST['sid']."_auto' GROUP BY item_id") or die(mysql_error());
	$row2=mysql_fetch_array($sql2);

	$query = "UPDATE `BBanana_users` SET `banana`= `banana` + ".$row['auto_banana']." WHERE `user_id`='".$_SESSION['ID']."'";
	$result = mysql_query($query); 
	if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	
	if($row2['banana_out'] == 0){//해당 내용이 가비지 값이면 지우는 스크립트 실행
		$query = "DELETE from `BBanana_autobids` where item_id='".$_POST['sid']."' and bider_id='".$_SESSION['ID']."'";
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

		$query = "DELETE from `BBanana_bananas` where item_id='".$_POST['sid']."_auto' and user_id='".$_SESSION['ID']."'";
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	}else{//아니면 오토바나나에 0으로 업데이트만 해준다
		$query = "UPDATE `BBanana_autobids` SET `auto_banana` = 0 WHERE `bider_id`='".$_SESSION['ID']."' AND `item_id`='".$_POST['sid']."'";
		$result = mysql_query($query); 
		if(!$result || @mysql_affected_rows() == 0) $okFlag = false;
	}
	
}else if($row && $row['auto_banana'] == 0){
	echo ("empty");
	return;
}else{
	echo ("none");
	return;
}

if(!$okFlag){
	$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
	echo("fail");
}else{
	 $result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	echo("cancel");
}
mysql_close($connect);
}else{
	echo("fail");
}
?>