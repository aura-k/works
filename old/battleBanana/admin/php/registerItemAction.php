<?
	include "../../php/checkAdmin.php";
	include "../../php/connect.php";
	
	if(!$_POST['item_title']){
		message("필요한목록을 모두 작성하세요!!");
		return;
	}
	
	$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
	$result = @mysql_query('BEGIN');
	$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

	$photo_path = "photo/".$_POST['sid_span']."_".$_FILES['file']["name"];
	$photo_path1 = "photo/".$_POST['sid_span']."_".$_FILES['file1']["name"];
	$photo_path2 = "photo/".$_POST['sid_span']."_".$_FILES['file2']["name"];
	$photo_path3 = "photo/".$_POST['sid_span']."_".$_FILES['file3']["name"];
	$photo_path4 = "photo/".$_POST['sid_span']."_".$_FILES['file4']["name"];
	$photo_path5 = "photo/".$_POST['sid_span']."_".$_FILES['file5']["name"];

	if($_FILES['file']["name"] == "") $photo_path = "";
	else{
	if(1) {
        if( $_FILES["file"]["error"] > 0 ){
			message("에러");
			 $okFlag = false;
        }else{
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . "Kb<br />";
            
            if( file_exists("../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]) ){
                message($_FILES["file"]["name"]."파일이 존재합니다.");
				 $okFlag = false;
            }else{
                move_uploaded_file($_FILES["file"]["tmp_name"], "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]);
                //echo "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]."에 저장 완료!";
            }
        }
	}else{
	   message("2메가 이하의 사진을 넣으세요");
	    $okFlag = false;
	}
	}

	if($_FILES['file1']["name"] == "") $photo_path1 = "";
	else{
	if(1) {
        if( $_FILES["file1"]["error"] > 0 ){
			message("에러");
			 $okFlag = false;
        }else{
            echo "Upload: " . $_FILES["file1"]["name"] . "<br />";
            echo "Type: " . $_FILES["file1"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file1"]["size"] / 1024) . "Kb<br />";
            
            if( file_exists("../../photo/".$_POST['sid_span']."_".$_FILES["file1"]["name"]) ){
                message($_FILES["file1"]["name"]."파일이 존재합니다.");
				 $okFlag = false;
            }else{
                move_uploaded_file($_FILES["file1"]["tmp_name"], "../../photo/".$_POST['sid_span']."_".$_FILES["file1"]["name"]);
                //echo "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]."에 저장 완료!";
            }
        }
	}else{
	   message("2메가 이하의 사진을 넣으세요");
	    $okFlag = false;
	}
	}

	if($_FILES['file2']["name"] == "") $photo_path2 = "";
	else{
	if(1) {
        if( $_FILES["file2"]["error"] > 0 ){
			message("에러");
			 $okFlag = false;
        }else{
            echo "Upload: " . $_FILES["file2"]["name"] . "<br />";
            echo "Type: " . $_FILES["file2"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file2"]["size"] / 1024) . "Kb<br />";
            
            if( file_exists("../../photo/".$_POST['sid_span']."_".$_FILES["file2"]["name"]) ){
                message($_FILES["file2"]["name"]."파일이 존재합니다.");
				 $okFlag = false;
            }else{
                move_uploaded_file($_FILES["file2"]["tmp_name"], "../../photo/".$_POST['sid_span']."_".$_FILES["file2"]["name"]);
                //echo "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]."에 저장 완료!";
            }
        }
	}else{
	   message("2메가 이하의 사진을 넣으세요");
	    $okFlag = false;
	}
	}

	if($_FILES['file3']["name"] == "") $photo_path3 = "";
	else{
	if(1) {
        if( $_FILES["file3"]["error"] > 0 ){
			message("에러");
			 $okFlag = false;
        }else{
            echo "Upload: " . $_FILES["file3"]["name"] . "<br />";
            echo "Type: " . $_FILES["file3"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file3"]["size"] / 1024) . "Kb<br />";
            
            if( file_exists("../../photo/".$_POST['sid_span']."_".$_FILES["file3"]["name"]) ){
                message($_FILES["file3"]["name"]."파일이 존재합니다.");
				 $okFlag = false;
            }else{
                move_uploaded_file($_FILES["file3"]["tmp_name"], "../../photo/".$_POST['sid_span']."_".$_FILES["file3"]["name"]);
                //echo "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]."에 저장 완료!";
            }
        }
	}else{
	   message("2메가 이하의 사진을 넣으세요");
	    $okFlag = false;
	}
	}

	if($_FILES['file4']["name"] == "") $photo_path4 = "";
	else{
	if(1) {
        if( $_FILES["file4"]["error"] > 0 ){
			message("에러");
			 $okFlag = false;
        }else{
            echo "Upload: " . $_FILES["file4"]["name"] . "<br />";
            echo "Type: " . $_FILES["file4"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file4"]["size"] / 1024) . "Kb<br />";
            
            if( file_exists("../../photo/".$_POST['sid_span']."_".$_FILES["file4"]["name"]) ){
                message($_FILES["file4"]["name"]."파일이 존재합니다.");
				 $okFlag = false;
            }else{
                move_uploaded_file($_FILES["file4"]["tmp_name"], "../../photo/".$_POST['sid_span']."_".$_FILES["file4"]["name"]);
                //echo "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]."에 저장 완료!";
            }
        }
	}else{
	   message("2메가 이하의 사진을 넣으세요");
	    $okFlag = false;
	}
	}

	if($_FILES['file5']["name"] == "") $photo_path5 = "";
	else{
	if(1) {
        if( $_FILES["file5"]["error"] > 0 ){
			message("에러");
			 $okFlag = false;
        }else{
            echo "Upload: " . $_FILES["file5"]["name"] . "<br />";
            echo "Type: " . $_FILES["file5"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file5"]["size"] / 1024) . "Kb<br />";
            
            if( file_exists("../../photo/".$_POST['sid_span']."_".$_FILES["file5"]["name"]) ){
                message($_FILES["file5"]["name"]."파일이 존재합니다.");
				 $okFlag = false;
            }else{
                move_uploaded_file($_FILES["file5"]["tmp_name"], "../../photo/".$_POST['sid_span']."_".$_FILES["file5"]["name"]);
                //echo "../../photo/".$_POST['sid_span']."_".$_FILES["file"]["name"]."에 저장 완료!";
            }
        }
	}else{
	   message("2메가 이하의 사진을 넣으세요");
	    $okFlag = false;
	}
	}

	$insert_date = $_POST['datepicker']." ".$_POST['hour'].":".$_POST['min'].":".$_POST['sec'];
	
	$str = "INSERT INTO `BBanana_items`(`item_id`, `item_sname`, `item_fname`, `item_img`, `item_photo1`, `item_photo2`, `item_photo3`, `item_photo4`, `item_photo5`, `item_expired`, `item_rrp`, `item_text`, `is_reward`) 
		VALUES('".$_POST['sid_span']."',
		'".$_POST['item_s_title']."',
		'".$_POST['item_title']."',
		'".$photo_path."',
		'".$photo_path1."',
		'".$photo_path2."',
		'".$photo_path3."',
		'".$photo_path4."',
		'".$photo_path5."',
		UNIX_TIMESTAMP('".$insert_date."'),
		'".$_POST['rrp']."',
		'".$_POST['ir1']."',
		'".$_POST['re']."');";

$sql = mysql_query($str) or die(mysql_error()); 
if(!$sql || @mysql_affected_rows() == 0) $okFlag = false;

if(!$okFlag){
	$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
	message("등록실패");
}else{
	$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
	 message("등록성공");
}

  ?>