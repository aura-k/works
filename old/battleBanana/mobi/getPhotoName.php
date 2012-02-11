<?
	$sid = $_GET['sid'];
	$num = $_GET['num'];
	include "../php/sess_func.php";
	include "../php/connect.php";
	
	if($sid && $num){
		$sql=mysql_query("select * from BBanana_items where item_id='".$sid."';") or die(mysql_error());
		$row=mysql_fetch_array($sql);

		switch($num){
			case 1: echo $row['item_photo1'];
				break;
			case 2: echo $row['item_photo2'];
				break;
			case 3: echo $row['item_photo3'];
				break;
			case 4: echo $row['item_photo4'];
				break;
			case 5: echo $row['item_photo5'];
				break;
		}

	}

	mysql_close($connect);
?>