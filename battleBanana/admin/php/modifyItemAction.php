<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	
	if(!$_POST['item_title']){
		message("필요한목록을 모두 작성하세요!!");
		return;
	}

	$insert_date = $_POST['datepicker']." ".$_POST['hour'].":".$_POST['min'].":".$_POST['sec'];
	
	$str = "UPDATE `BBanana_items` SET 
	`item_sname` =  '".$_POST['item_s_title']."', 
	`item_fname` =  '".$_POST['item_title']."',
	`item_expired` = UNIX_TIMESTAMP('".$insert_date."'),
	`item_rrp` =  '".$_POST['rrp']."',
	`item_text` =  '".$_POST['ir1']."',
	`is_reward` =  '".$_POST['re']."'
	WHERE item_id =  '".$_POST['sid_span']."';";

$sql = mysql_query($str) or die(mysql_error()); 
$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
if (!$sql) echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><script>alert(\"수정실패\");window.close();</script>";
else echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><script>alert(\"수정성공\");window.close();</script>";


  ?>