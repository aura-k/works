<?	
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";

	if($_POST['category']){
 		$sql=mysql_query("SELECT item_id FROM `BBanana_items` WHERE item_id like '".$_POST['category']."%' order by item_id DESC") or die(mysql_error());
		$row=mysql_fetch_array($sql);
		
		if($row['item_id'] == null){
			echo $_POST['category']."00001";
			return;
		}else{
			echo intval($row['item_id']) + 1;
			return;
		}
	}
?>